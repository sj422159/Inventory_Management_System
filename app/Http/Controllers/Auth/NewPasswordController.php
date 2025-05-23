<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    // Validate request
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|confirmed|min:8',
    ]);

    // Fetch user directly from the database
    $user = DB::table('users')->where('email', $request->email)->first();

    if (!$user) {
        return back()->withInput($request->only('email'))
                     ->withErrors(['email' => 'The provided email does not exist.']);
    }

    // Update password with hashed value
    DB::table('users')->where('email', $request->email)->update([
        'password' => Hash::make($request->password),
    ]);

    // Optionally dispatch password reset event
    event(new \Illuminate\Auth\Events\PasswordReset((object)['email' => $request->email]));

    // Redirect to login with success message
    return redirect()->route('login')->with('status', 'Your password has been reset successfully.');

}
}
