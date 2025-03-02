<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, $role):Response
    // {
    //     // if (!Auth::check() || Auth::user()->role !== $role) {
    //     //     abort(403, 'Unauthorized');
    //     // }
        
    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        // Get the authenticated user's role
        $userRole = Auth::user()->role;

        // Ensure roles parameter is treated as an array
        if (!is_array($roles)) {
            $roles = [$roles]; // Convert string role to an array
        }

        // Check if the user's role is in the allowed roles
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }

}
