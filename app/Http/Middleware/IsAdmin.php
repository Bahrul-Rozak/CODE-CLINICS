<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Pastikan user sudah login dan punya is_admin = 0
        if (!$user || !$user->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Access Denied! Super Admin only.');
        }

        return $next($request);
    }
}
