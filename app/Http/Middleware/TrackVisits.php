<?php

namespace App\Http\Middleware;

use Closure;
use App\Jobs\TrackVisitJob;
use Illuminate\Support\Facades\Auth;

class TrackVisits
{
    public function handle($request, Closure $next)
    {
        // Get the authenticated user ID (NULL for guests)
        $userId = Auth::id();

        // Get the IP address and user agent from the request
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');

        // Dispatch the job to track the visit asynchronously
        TrackVisitJob::dispatch($userId, $ipAddress, $userAgent);

        // Continue with the request
        return $next($request);
    }
}
