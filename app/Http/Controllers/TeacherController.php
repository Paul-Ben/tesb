<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Result;
use App\Models\SchoolSession;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
     /**
     * Apply middleware to enforce role-based authorization.
     */
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
        $this->middleware('role:Teacher'); // Restrict access to specific roles
    }

    public function teacher_classes()
    {
        $authUser = Auth::user();
        $teacher = $authUser->teacher;
        $classrooms = $teacher->classrooms;
      
        return view('teacher.classroom', compact('classrooms', 'authUser'));
    }

    public function viewClassstudents(Classroom $classroom)
    {
        $authUser = Auth::user();
        $students = Student::where('class_id', $classroom->id)->get();
        return view('teacher.classroom.students', compact('students', 'classroom', 'authUser'));
    }

    public function showStudent(Student $student)
    {
        $authUser = Auth::user();
        return view('teacher.classroom.show', compact('student', 'authUser'));
    }

    public function resultIndex(Request $request)
    {
        $authUser = Auth::user();

        return view('teacher.result.index', compact('authUser'));
    }
    public function searchStudentForResult(Request $request)
    {
        $authUser = Auth::user();
        $query = $request->input('query');

        // Search for students where student_number is similar to the query
        $students = Student::where('std_number', 'LIKE', "%{$query}%")
                            ->orWhere('first_name', 'LIKE', "%{$query}%") // Optional: Search by name too
                            ->get();

        return view('teacher.result.searchResult', compact('authUser', 'students'));// Return the same view
    }

    public function createResult(Student $student)
    {
        $authUser = Auth::user();
        $subjects = Subject::where('classroom_id', $student->class_id)->get();
    //    $schoolSession = SchoolSession::where('status', 'active')->first();
        $term = Term::where('status', 'active')->first();
        if (!$term) {
            return redirect()->back()->with([
                'message' => 'No active term found.',
                'alert-type' => 'error',
            ]);
        }
        return view('teacher.result.create', compact('authUser', 'subjects', 'student', 'term'));
    }

}
