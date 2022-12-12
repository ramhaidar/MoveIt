<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->user()->is_driver) {
                    return redirect('dashboard-driver');
                }
                if ($request->user()->is_customer) {
                    return redirect('dashboard-customer');
                }
                if ($request->user()->is_admin) {
                    return redirect('dashboard-admin');
                }
            }
        }

        return $next($request);
    }
}
