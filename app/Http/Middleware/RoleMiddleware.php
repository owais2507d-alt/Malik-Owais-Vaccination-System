<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // 2. Check if the user has the required role
        if ($user->role !== $role) {
            abort(403, 'Unauthorized action. You do not have access to this section.');
        }

        // 3. Special Guard: If Hospital is registered but still 'pending' approval by Admin
        if ($user->role === 'hospital' && $user->status === 'pending') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your hospital account is awaiting Admin Approval.');
        }

        return $next($request);
    }
}