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
    
        $user = $request->user(); // Authenticated user
    
        if ($user->role !== 'user') {
            // Proper logout using Auth facade
            Auth::logout();
    
            // Clear session
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return back()->withErrors([
                'email' => 'You do not have permission to login here.',
            ]);
        }
    
        // Session regenerate for valid user
        $request->session()->regenerate();
    
        return redirect()->intended(route('dashboard', absolute: false));
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
