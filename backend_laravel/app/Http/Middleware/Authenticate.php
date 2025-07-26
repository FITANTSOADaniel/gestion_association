<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
   /* protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('route_vers_login');
           
        }
    }*/
    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Veuillez vous connecter.'], 401);
        }

        return parent::handle($request, $next, ...$guards);
    }
}
