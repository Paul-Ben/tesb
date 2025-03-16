<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // dd($request);
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        // dd($user->role->name);
        // dd($user->name);

        switch ($user->role->name) {
            case 'Super Admin':
                return redirect()->route('superadmin.dashboard');
            case 'Admin':
                return redirect()->route('admin.dashboard');
            case 'User':
                return redirect()->route('user.dashboard');
            case 'Teacher':
                return redirect()->route('teacher.dashboard');
            default:
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'Email-Address And Password Are Wrong.');
        }

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
