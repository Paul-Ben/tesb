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
        $classStudents = $classroom->students;
        return view('teacher.classroom.students', compact('students', 'classroom', 'authUser'));
    }

    public function promoteStudents(Request $request, Classroom $classroom)
    {
        $authUser = Auth::user();
        $classrooms = Classroom::all();
        return view('teacher.classroom.promoteForm', compact('classroom', 'authUser', 'classrooms'));
    }
    public function promote(Request $request, Classroom $classroom)
    {
        $authUser = Auth::user();
        $request->validate([
            'current_class_id' => 'required|exists:classrooms,id',
            'new_class_id' => 'required|exists:classrooms,id',
        ]);
        $currentClassId = $request->input('current_class_id');
        $newClassId = $request->input('new_class_id');
        $students = Student::where('class_id', $currentClassId)->get();
        $students->each(function ($student) use ($newClassId) {
            $student->class_id = $newClassId;
            $student->save();
        });
        // Optionally, you can redirect back with a success message
        return redirect()->back()->with([
            'message' => 'Students promoted successfully.',
            'alert-type' => 'success',
        ]);
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
        $term = Term::where('status', 'active')->first();
        if (!$term) {
            return redirect()->back()->with([
                'message' => 'No active term found.',
                'alert-type' => 'error',
            ]);
        }
        $classroom = Classroom::with('classCategory')->find($student->class_id);
        if (!$classroom) {
            return redirect()->back()->with([
                'message' => 'Classroom not found.',
                'alert-type' => 'error',
            ]);
        }
        // dd($classroom->classCategory->name);
        if ($classroom->classCategory->name == 'Kindergarten') 
        {
            return view('teacher.result.create', compact('authUser', 'subjects', 'student', 'term'));
        }
        elseif ($classroom->classCategory->name == 'Primary') 
        {
            return view('teacher.result.createPrimary', compact('authUser', 'subjects', 'student', 'term'));
        }
        elseif ($classroom->classCategory->name == 'Junior Secondary School') 
        {
            return view('teacher.result.createJss', compact('authUser', 'subjects', 'student', 'term'));
        }elseif ($classroom->classCategory->name == 'Senior Secondary School') 
        {
            return view('teacher.result.createSss', compact('authUser', 'subjects', 'student', 'term'));
        }
        else
        {
            return redirect()->back()->with([
                'message' => 'Classroom category not recognized.',
                'alert-type' => 'error',
            ]);
        }
        
    }

}
