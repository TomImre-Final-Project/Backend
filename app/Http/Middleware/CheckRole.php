<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        Log::info('CheckRole middleware - User:', [
            'authenticated' => Auth::check(),
            'user' => Auth::user(),
            'required_role' => $role
        ]);

        if (!Auth::check() || Auth::user()->role !== $role) {
            Log::warning('CheckRole middleware - Unauthorized access attempt', [
                'user' => Auth::user(),
                'required_role' => $role
            ]);
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $next($request);
    }
} 