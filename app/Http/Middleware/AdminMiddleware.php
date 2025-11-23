<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Allow only user with id == 1.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::id() !== 1) {
            abort(403, 'Unauthorized admin access');
        }

        if (!session('admin_unlocked')) {
            return redirect()->route('admin.password');
        }

        return $next($request);
    }
}
