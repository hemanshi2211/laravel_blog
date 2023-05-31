<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Category
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::user()->hasAnyPermission(['write category','edit category','delete category']));

            if(!Auth::user()->hasAnyPermission(['write category','edit category','delete category']))
            {
                abort(403);
            }
            return $next($request);
    }
}
