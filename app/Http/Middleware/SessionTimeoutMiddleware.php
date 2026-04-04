<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip session timeout check for non-authenticated users
        if (!Auth::check()) {
            return $next($request);
        }

        // Get session lifetime in minutes
        $sessionLifetime = config('session.lifetime', 480); // Default 8 hours
        
        // Get last activity timestamp
        $lastActivity = $request->session()->get('last_activity');
        
        // If last activity is not set, set it now
        if (!$lastActivity) {
            $request->session()->put('last_activity', now()->timestamp);
            return $next($request);
        }
        
        // Calculate time since last activity in minutes
        $timeSinceActivity = (now()->timestamp - $lastActivity) / 60;
        
        // If session has expired
        if ($timeSinceActivity > $sessionLifetime) {
            // Logout the user gracefully
            Auth::logout();
            
            // Invalidate and regenerate session
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            // Redirect to login with timeout message
            return redirect('/login')
                ->with('message', 'Your session has expired due to inactivity. Please log in again.')
                ->with('message_type', 'warning');
        }
        
        // Update last activity timestamp
        $request->session()->put('last_activity', now()->timestamp);
        
        return $next($request);
    }
}