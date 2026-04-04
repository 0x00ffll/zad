<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle user authentication attempt
     */
    public function login(Request $request)
    {
        $credentials = $this->validateLogin($request);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            return $this->authenticated($request, Auth::user());
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Log the user out of the application
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('status', 'Successfully logged out');
    }

    /**
     * Validate login request data
     */
    protected function validateLogin(Request $request): array
    {
        return $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    /**
     * Handle successful authentication
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended('/dashboard');
    }

    /**
     * Handle failed authentication attempt
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
}