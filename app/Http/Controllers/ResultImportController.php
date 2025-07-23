<?php

namespace App\Http\Controllers;

use App\Imports\ResultsImport;
use App\Models\Classroom;
use App\Models\Result;
use App\Models\ResultAffectiveDevelopment;
use App\Models\ResultSubject;
use App\Models\SchoolSession;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ResultImportController extends Controller
{
    /**
     * Apply middleware to enforce role-based authorization.
     */
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
        $this->middleware('role:Teacher'); // Restrict access to specific roles
    }

    /**
     * Show the form for uploading an Excel file with student results
     */
    public function showUploadForm(Classroom $classroom, Subject $subject)
    {
        $authUser = Auth::user();
        $students = Student::where('class_id', $classroom->id)->get();
        $term = Term::with('SchoolSession')->where('status', 'active')->first();
        $session = SchoolSession::where('status', 'active')->first();
        // dd($term);
        if (!$term) {
            return redirect()->back()->with([
                'message' => 'No active term found.',
                'alert-type' => 'error',
            ]);
        }
        
        if (!$session) {
            return redirect()->back()->with([
                'message' => 'No active session found.',
                'alert-type' => 'error',
            ]);
        }

        return view('teacher.result.upload', compact('classroom', 'subject', 'students', 'term', 'session', 'authUser'));
    }

    /**
     * Process the uploaded Excel file and import student results
     */
    public function processUpload(Request $request, Classroom $classroom, Subject $subject)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|file|mimes:xlsx,xls,csv',
            'term_id' => 'required|exists:terms,id',
            'session_id' => 'required|exists:school_sessions,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get the uploaded file
        $file = $request->file('excel_file');
        $term = Term::find($request->term_id);
        $session = SchoolSession::find($request->session_id);
        
        try {
            // Import the Excel file using Laravel Excel
            $import = new ResultsImport($classroom, $subject, $term, $session);
            Excel::import($import, $file);
            
            $processedCount = $import->getProcessedCount();
            $errors = $import->getErrors();
            
            if (count($errors) > 0) {
                $errorMessage = "Processed {$processedCount} records with errors: " . implode(", ", array_slice($errors, 0, 3));
               
                if (count($errors) > 3) {
                    $errorMessage .= " and " . (count($errors) - 3) . " more errors.";
                }
                
                return redirect()->back()->with([
                    'message' => $errorMessage,
                    'alert-type' => 'warning',
                ]);
            }
            
            return redirect()->route('teacher.students', $classroom)->with([
                'message' => "Successfully processed {$processedCount} student results.",
                'alert-type' => 'success',
            ]);
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with([
                'message' => 'Error processing file: ' . $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }


}