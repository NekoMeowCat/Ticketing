<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Supports\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if(!Auth::check() || (Auth::check() && Auth::user()->is_admin !== 1)) 
        {
            return redirect('home');
        }

        return $next($request);
    }
}