<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
<<<<<<< HEAD
use App\Models\Teacher;

=======
use App\Models\Result;
use App\Models\ResultAffectiveDevelopment;
use App\Models\Student;
use Carbon\Carbon;
>>>>>>> d1ca19be4e3adf4d5dea06d0c66254316a28f13a
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserActions extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
        $this->middleware('role:User'); // Restrict access to specific roles
    }

    public function guardianForm()
    {
        $authUser = Auth::user();
        return view('users.guardian.create', compact('authUser'));
    }

    public function storeGuardian(Request $request)
    {
        $authUser = Auth::user();
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:15',
            'guardian_email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'nationality' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
            'stateoforigin' => 'nullable|string|max:255',
            'lga' => 'nullable|string|max:255',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('guardians', 'public');
        } else {
            $imagePath = null;
        }

        // Create the guardian
        Guardian::create([
            'user_id' => $authUser->id,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'guardian_email' => $request->guardian_email,
            'address' => $request->address,
            'nationality' => $request->nationality,
            'image' => $imagePath,
            'stateoforigin' => $request->stateoforigin,
            'lga' => $request->lga,
        ]);

        $notification = array(
            'message' => 'Guardian information saved successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('user.dashboard')->with($notification);
    }

<<<<<<< HEAD
    
=======
    public function getGuardianStudents()
    {
        $authUser = Auth::user();
        $guardian = Guardian::where('user_id', $authUser->id)->first();
        $students = $guardian->students;
        if ($students) {
            
            return view('users.guardian.students', compact('students', 'authUser', 'guardian'));
        } else {
            return redirect()->back()->with([
                'message' => 'No student information found.',
                'alert-type' => 'error'
            ]);
        }
    }
    public function showStudent(Student $student)
    {
        $authUser = Auth::user();
        $guardian = Guardian::where('user_id', $authUser->id)->first();
        return view('users.guardian.student', compact('student', 'authUser', 'guardian'));
    }

    public function getResults(Student $student, Result $result)
    {
        $authUser = auth()->user();
        $guardian = Guardian::where('user_id', $authUser->id)->first();
        $results = Result::where('student_id', $student->id)->get();
        if (!$results) {
            return redirect()->back()->with([
                'message' => 'No result found for this student.',
                'alert-type' => 'error',
            ]);
        }
        return view('users.result.index', compact('student', 'results', 'authUser', 'guardian'));
    }

    public function singleResultView(Student $student, Result $result)
    {
        
        $student = Student::where('id', $result->student_id)->first();
        $age = Carbon::parse($student->date_of_birth)->age;
        $affectiveDevelopment = ResultAffectiveDevelopment::where('result_id', $result->id)->get();
        $table1 = $affectiveDevelopment->take(4);
        $table2 = $affectiveDevelopment->slice(4);
        return view('users.result.show', compact('student', 'result', 'table1', 'table2', 'age'));
    }
>>>>>>> d1ca19be4e3adf4d5dea06d0c66254316a28f13a
}
