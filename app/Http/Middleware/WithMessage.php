<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WithMessage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('action_error', 'You must be logged in to do this.');
        }

        return $next($request);
    }
}
