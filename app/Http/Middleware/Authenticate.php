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
        // If the request expects JSON, return null (API users)
        if ($request->expectsJson()) {
            return null;
        }

        // Check if the request URL is for admin or customer
        if (str_contains($request->path(), 'admin')) {
            return route('admin.login'); // Redirect admins
        }

        if ($request->is('*')) {
            return route('client.auth'); // Redirect customers
        }

        // Default fallback
        return route('client.home');
    }
}
