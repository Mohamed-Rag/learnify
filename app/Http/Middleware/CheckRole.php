<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * This middleware checks if the authenticated user has the specified role.
     * If the user does not have the role, they are redirected to the home page
     * with an error message.
     * If the user is not authenticated, they are redirected to the login page.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */

    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if (Auth::user()->role !== $role) {
            return redirect('/home')->with('error', 'You do not have access to this section.');
        }

        return $next($request);
    }
}
