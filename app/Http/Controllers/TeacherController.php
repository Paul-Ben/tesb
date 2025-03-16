<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
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

}
