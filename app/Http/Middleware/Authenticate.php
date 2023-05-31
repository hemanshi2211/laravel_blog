<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        if(Str::contains(request()->url(), 'edit'))
        {
            // dd(request()->url());
            $url = request()->url();
            session(['url' => $url]);
            return $request->expectsJson() ? null : route('login');
            // dd($url);
        }
        return $request->expectsJson() ? null : route('login');
    }
}
