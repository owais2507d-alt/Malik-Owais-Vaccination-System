<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request and filter by specific user role.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Check if the user is authenticated globally
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // 2. Validate if the authenticated user possesses the required clearance role
        if ($user->role !== $role) {
            abort(403, 'Unauthorized action. Access denied to this medical portal section.');
        }

        // 3. Security Check: If a hospital account status is still pending administrative approval
        if ($user->role === 'hospital' && $user->status === 'pending') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your hospital profile registration is currently pending admin approval.');
        }

        return $next($request);
    }
}