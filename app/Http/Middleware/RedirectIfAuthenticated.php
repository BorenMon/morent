<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->role == UserRole::Customer->value) {
                    return redirect(RouteServiceProvider::CUSTOMER_HOME);
                }

                return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
            }
        }

        return $next($request);
    }
}
