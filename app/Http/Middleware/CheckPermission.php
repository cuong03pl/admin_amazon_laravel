<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if ($request->user() && ($request->user()->hasRole('super-admin'))) {
            return $next($request);
        }

        if (!$request->user()->hasRole($permission)) {
            return redirect()->route('dashboard')->with('error', 'Bạn không có vai trò phù hợp.');
        }

        return $next($request);
    }
}
