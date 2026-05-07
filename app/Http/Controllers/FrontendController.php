<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Result;
use App\Models\ResultAffectiveDevelopment;
use App\Models\SchoolSession;
use App\Models\Student;
use App\Models\Term;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index()
    {
        return view('frontend.index');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function newsletter()
    {
        $newsletterExists = file_exists(public_path('uploads/newsletter/newsletter.pdf'));

        return view('frontend.newsletter', compact('newsletterExists'));
    }

    public function resultSearch()
    {
        $sessions = SchoolSession::orderBy('sessionName', 'desc')->get();
        $terms = Term::where('status', 'active')->get();

        return view('frontend.result.search', compact('sessions', 'terms'));
    }

    public function checkResult(Request $request)
    {
        $request->validate([
            'student_number' => 'required|string',
            'session' => 'required|string',
            'term' => 'required|string',
        ]);

        $student = Student::where('std_number', $request->student_number)->first();

        if (! $student) {
            return back()->with([
                'message' => 'Student not found with this admission number.',
                'alert-type' => 'error',
            ]);
        }

        $hasPayment = Transaction::where('student_id', $student->id)
            ->where('term', $request->term)
            ->where('session', $request->session)
            ->where('paymentStatus', 'successful')
            ->exists();

        if (! $hasPayment) {
            return back()->with([
                'message' => 'School fees for this term has not been paid. Please pay your fees to access the result.',
                'alert-type' => 'error',
            ]);
        }

        $result = Result::where('student_id', $student->id)
            ->where('term', $request->term)
            ->where('session', $request->session)
            ->first();

        if (! $result) {
            return back()->with([
                'message' => 'No result found for this student in the selected term and session.',
                'alert-type' => 'error',
            ]);
        }

        $student = Student::where('id', $result->student_id)->first();
        $age = Carbon::parse($student->date_of_birth)->age;
        $affectiveDevelopment = ResultAffectiveDevelopment::where('result_id', $result->id)->get();
        $table1 = $affectiveDevelopment->take(4);
        $table2 = $affectiveDevelopment->slice(4);

        $classroom = Classroom::with('classCategory')->find($student->class_id);
        $classCategoryName = $classroom->classCategory->name;

        $positions = Result::calculatePositions($student->class_id, $result->term, $result->session);
        $position = $positions[$result->id] ?? null;

        $categoryViews = [
            'Kindergarten' => 'users.result.show',
            'Primary' => 'users.result.showPrimary',
            'Junior Secondary School' => 'users.result.showJss',
            'Senior Secondary School' => 'users.result.showSs',
        ];

        if (array_key_exists($classCategoryName, $categoryViews)) {
            return view($categoryViews[$classCategoryName], compact('student', 'result', 'table1', 'table2', 'age', 'position'));
        }

        return back()->with([
            'message' => 'Classroom category not recognized.',
            'alert-type' => 'error',
        ]);
    }
}
