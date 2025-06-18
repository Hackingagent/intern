<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if(!$request -> expectsJson()){
            if($request->routeIs('Company.*')){
                return route('login');
            }
            if($request->routeIs('Student.*')){
                return route('login');
            }
            return route('login');
        }
    }
}
