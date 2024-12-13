<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
        $request->authenticate();

        $request->session()->regenerate();

        return $this->authenticated($request, Auth::user());

        //return redirect()->intended(route('dashboard', absolute: false));
    }

    
    /**
     * Redirect users after login based on their role.
     */
    protected function authenticated(Request $request, $user): RedirectResponse
    {
        if ($user->role === 0) {
            // Admin
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 1) {
            // Regular User
            return redirect()->route('home');
        } elseif ($user->role === 2) {
            // Club Owner
            return redirect()->route('clubowner.dashboard');
        }

        // Default redirect if no specific role matches
        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
