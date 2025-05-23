<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */


public function store(LoginRequest $request)
{
    // Get raw input for honeypot check
    $website = $request->input('website');

    // If honeypot field has a value, assume it's a bot
    if (!empty($website)) {
        // Optional: Log the attempt
        \Log::warning("Bot detected on login attempt", [
            'ip' => $request->ip(),
            'email' => $request->email,
            'filled_website' => $website,
        ]);

        // Redirect back with error
        return back()->withErrors([
            'email' => 'Bot detected. Please try again.',
        ]);
    }

    // Proceed with authentication
    $request->authenticate();
    $request->session()->regenerate();

    return redirect()->intended(RouteServiceProvider::HOME);
}

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
