<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class EnsureHasRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(!Auth::check()) {
            return redirect('login')->with('error', 'You aren\'t logged in');
        }

        if (!$request->user()->hasRole($role)) {
            return redirect('/');
        }

        return $next($request);
    }

}
