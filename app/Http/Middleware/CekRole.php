<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $role): Response
    {
        if (!Auth::guard('User')->check()) {
            return redirect('/login');
        }

        if (Auth::guard('User')->user()->role != $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
