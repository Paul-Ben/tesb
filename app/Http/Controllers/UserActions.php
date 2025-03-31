<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Teacher;

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

    
}
