<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\SchoolSession;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Apply middleware to enforce role-based authorization.
     */
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
        $this->middleware('role:Super Admin,Admin,User,Teacher'); // Restrict access to specific roles
    }

    public function superAdmin()
    {
        $authUser = Auth::user();
        return view('dashboards.superadmin', compact('authUser'));
    }

    public function admin()
    {
        $authUser = Auth::user();
        $students = Student::count();
        $teachers = Teacher::count();
        $classes = Classroom::count();
        $session = SchoolSession::where('status', 'active')->first();
        
        $notification = array(
            'message' => 'Welcome to your dashboard.',
            'alert-type' => 'success'
        );
        return view('dashboards.admin', compact('authUser', 'students', 'teachers', 'session', 'classes'))->with($notification);
    }

    public function user()
    {
        $authUser = Auth::user();
        $wards = Student::with('guardian')->count();
        $session = SchoolSession::where('status', 'active')->first();
        $guardian = Guardian::where('user_id', $authUser->id)->first();
        if (!$guardian) {
            session()->flash('message', 'Please fill the guardian form to proceed.');
            $notification = array(
                'message' => 'Please fill the guardian form to proceed.',
                'alert-type' => 'info'
            );
            return redirect()->route('guardian.form')->with($notification);
        }
        $notification = array(
            'message' => 'Welcome to your dashboard.',
            'alert-type' => 'success'
        );
        return view('dashboards.user', compact('authUser', 'guardian', 'wards', 'session'))->with($notification);
    }

    public function teacher()
    {
        $authUser = Auth::user();
        $classes = Classroom::with('teacher')->where('teacher_id', $authUser->id)->count();
      
        // $teacher = Teacher::where('user_id', $authUser->id)->first();
        // if (!$teacher) {
        //     session()->flash('message', 'Please fill the teacher form to proceed.');
        //     $notification = array(
        //         'message' => 'Please fill the teacher form to proceed.',
        //         'alert-type' => 'info'
        //     );
        //     return redirect()->route('teacher.form')->with($notification);
        // }
        $notification = array(
            'message' => 'Welcome to your dashboard.',
            'alert-type' => 'success'
        );
        return view('dashboards.teacher', compact('authUser', 'classes'))->with($notification);
    }
}
