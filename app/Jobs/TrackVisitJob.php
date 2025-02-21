<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Visit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;

class TrackVisitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $ipAddress;
    protected $userAgent;

    /**
     * Create a new job instance.
     */
    public function __construct($userId, $ipAddress, $userAgent)
    {
        $this->userId = $userId;
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Generate a cache key unique to the user (or guest) for today
        $cacheKey = 'visit:' . ($this->userId ?? $this->ipAddress) . ':' . Carbon::today()->toDateString();

        // Check if the visit is already cached
        if (!Cache::has($cacheKey)) {
            // Create the visit record
            Visit::create([
                'user_id' => $this->userId, // NULL for guests
                'ip_address' => $this->ipAddress,
                'user_agent' => $this->userAgent,
                'visited_at' => Carbon::now(),
            ]);

            // Cache the visit for 1 hour (or adjust as needed)
            Cache::put($cacheKey, true, now()->addHour()); // Cache for 1 hour
        }
    }
}
