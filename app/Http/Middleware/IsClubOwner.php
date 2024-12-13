<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsClubOwner
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
        // Add your own logic to check if the user is a club owner
        if (!auth()->user() || auth()->user()->role !== 2) {
            return redirect()->route('home');  // Ensure correct redirection here
        }

        return $next($request);
    }
}
