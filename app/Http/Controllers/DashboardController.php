<?php

namespace App\Http\Controllers;

use App\Models\Department;
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
        $this->middleware('role:Super Admin,Admin,User'); // Restrict access to specific roles
    }

    public function superAdmin()
    {
        $authUser = Auth::user();
        return view('dashboards.superadmin', compact('authUser'));
    }

    public function admin()
    {
        $authUser = Auth::user();
        return view('dashboards.admin' , compact('authUser'));
    }

    public function user()
    {
        $authUser = Auth::user();
        return view('dashboards.user', compact('authUser'));
    }
}
