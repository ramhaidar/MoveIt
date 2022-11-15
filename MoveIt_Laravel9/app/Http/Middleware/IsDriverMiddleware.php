<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDriverMiddleware
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
        if ($request->user()->is_driver) {
            return $next($request);
        }
        return response()->json(['error' => 'you are not an Driver!'], 403);
    }
}
