<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AcceptEula
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if user is authenticated, has not accepted the EULA, and the cookie is not set
        if ($user && !$user->eula_accepted && !$request->cookie('eula_accepted')) {
            // Redirect to the EULA page
            return redirect()->route('eula');
        }

        // If the user has accepted the EULA or the cookie is set, continue with the request
        return $next($request);
    }
}
