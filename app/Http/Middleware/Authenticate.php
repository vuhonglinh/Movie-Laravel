<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            $currentMiddleware = $request->route()->middleware();
            if (!empty($currentMiddleware) && in_array('auth:customer', $currentMiddleware)) {
                return route('login');
            }
            return route('admin.login');
        }
    }
}
