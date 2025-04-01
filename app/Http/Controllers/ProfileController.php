<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

use App\Models\Teacher;
use App\Models\Guardian;
use App\Models\Admin;
use App\Models\User;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $authUser = Auth::user();
        $user = User::with(['teacher', 'guardian', 'admin'])->where('id', $authUser->id)->first();
        if($authUser->role->name == 'Teacher') {

        return view('profile.teacher_edit', [
            'authUser' =>  $user,
        ]);

        }else if($authUser->role->name == 'User') {

            return view('profile.guardian_edit', [
                'authUser' =>  $user,
            ]);

        }else if($authUser->role->name == 'Admin') {

            return view('profile.admin_edit', [
                'authUser' =>  $user,
            ]);
        }

    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $request->user()->save();
        $authUser = Auth::user();
        $admin = Admin::where('user_id',$authUser->id)->first();
        $teacher = Teacher::where('user_id', $authUser->id)->first();
        $guardian = Guardian::where('user_id',$authUser->id)->first();
        $user = User::where('id',$authUser->id)->first();
      
        if($authUser->role->name == 'Teacher') {

            $request->validate([
                'first_name' => 'nullable|string',
                'last_name' => 'nullable|string',
                'middle_name' => 'string|nullable',
                'email' => 'email|unique:teachers,email,' . $authUser->teacher->id,
                'date_of_birth' => 'nullable|date',
                'phone_number' => 'string|nullable',
                'address' => 'nullable|string',
                'qualification' => 'string|nullable',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:4048',
            ]);

            $user->update([
                'name' =>  $request->first_name .' '. $request->last_name,
                'email'  => $request->email
            ]);


            if ($request->hasFile('avatar')) {
                $oldImage = $teacher->image;
                $fullname =  $request->first_name. ' '.  $request->last_name;
                $imageName = str_replace(' ', '_', $fullname) . '_' . time() . '.' . $request->file('avatar')->getClientOriginalExtension();
                $avatarPath = $request->file('avatar')->storeAs('avatars', $imageName, 'public');
                
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
                $teacher->image = $avatarPath;
           }
           
            $teacher->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'qualification' => $request->qualification,
            ]);

            
    
            $notification = [
                'message' => 'Profile Updated Successfully',
                'alert-type' => 'success',
            ];
    
            return Redirect::route('profile.edit')->with($notification);

        }else if($authUser->role->name == 'User') {

            $request->validate([
                'guardian_name' => 'nullable|string',
                'guardian_phone' => 'nullable|string',
                'guardian_email' => 'nullable|email|unique:guardians,guardian_email,' . $authUser->guardian->id,
                'nationality' => 'nullable|string',
                'state_of_origin' => 'nullable|string',
                'lga' => 'nullable|string',
                'address' => 'nullable|string',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:4048',
            ]);

            $user->update([
                'name' => $request->guardian_name,
                'email' => $request->guardian_email,
            ]);

            if ($request->hasFile('avatar')) {
                $oldImage = $guardian->image;
                $imageName = str_replace(' ', '_', $request->guardian_name) . '_' . time() . '.' . $request->file('avatar')->getClientOriginalExtension();
                $avatarPath = $request->file('avatar')->storeAs('avatars', $imageName, 'public');
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                 }
                $guardian->image = $avatarPath;
          }
  
            $guardian->update([
                'guardian_name' => $request->guardian_name,
                'guardian_phone' => $request->guardian_phone,
                'guardian_email' => $request->guardian_email,
                'nationality' => $request->nationality,
                'stateoforigin' => $request->stateoforigin,
                'lga' => $request->lga,
                'address' => $request->address,
            ]);

            $notification = [
                'message' => 'Profile Updated Successfully',
                'alert-type' => 'success',
            ];
    
            return Redirect::route('profile.edit')->with($notification);
    
        }else if($authUser->role->name == 'Admin')
        {
            $request->validate([
                'first_name' => 'nullable|string',
                'last_name' => 'nullable|string',
                'middle_name' => 'string|nullable',
                'email' => 'email|unique:teachers,email,' . $authUser->admin->id,
                'date_of_birth' => 'nullable|date',
                'phone_number' => 'string|nullable',
                'address' => 'nullable|string',
                'qualification' => 'string|nullable',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:4048',
            ]);

            $user->update([
                'name' =>  $request->first_name .' '. $request->last_name,
                'email'  => $request->email
            ]);


            if ($request->hasFile('avatar')) {
                $oldImage = $admin->image;
                $fullname =  $request->first_name. ' '.  $request->last_name;
                $imageName = str_replace(' ', '_', $fullname) . '_' . time() . '.' . $request->file('avatar')->getClientOriginalExtension();
                $avatarPath = $request->file('avatar')->storeAs('avatars', $imageName, 'public');
                
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
                $admin->image = $avatarPath;
           }
           
            $admin->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'qualification' => $request->qualification,
            ]);

            
    
            $notification = [
                'message' => 'Profile Updated Successfully',
                'alert-type' => 'success',
            ];
    
            return Redirect::route('profile.edit')->with($notification);
        }
      
        $notification = [
            'message' => 'Error Occured. Try Again!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
    
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
