<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        
        Cookie::queue('askedURL', Request::path(), 3600);

        if($request->routeIs('getOffcode')){
            return route('login', $request->route('seller'));
        }

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
