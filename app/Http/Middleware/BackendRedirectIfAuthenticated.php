<?php

namespace HappyFeet\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class BackendRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::guard($guard)->user()->super_admin) {
            return redirect('backend/dashboard');
        }
        return $next($request);
    }
}
