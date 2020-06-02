<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            return redirect(route('admin.login'));
        }

        if (!$request->user() instanceof Admin) {
            return redirect(route('restricted'));
        }
        return $next($request);
    }
}