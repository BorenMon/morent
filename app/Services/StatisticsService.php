<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatisticsService
{
    /**
     * Check if the model uses the SoftDeletes trait.
     */
    protected function modelUsesSoftDeletes(Model $model): bool
    {
        return in_array(SoftDeletes::class, class_uses_recursive($model));
    }

    /**
     * Apply soft delete conditions if the model supports it.
     */
    protected function applySoftDeleteFilter(Model $model, Builder $query): Builder
    {
        if ($this->modelUsesSoftDeletes($model)) {
            return $query->whereNull('deleted_at'); // Exclude soft deleted records
        }
        return $query;
    }

    /**
     * Get total count for a given model and condition.
     */
    public function getTotalCount(Model $model, array $conditions = [])
    {
        $query = $model::where($conditions);
        if ($this->modelUsesSoftDeletes($model)) {
            $query = $query->withoutTrashed();
        }
        return $query->count();
    }

    /**
     * Get entity count for the current month.
     */
    public function getCurrentMonthCount(Model $model, array $conditions = [])
    {
        $query = $model::where($conditions)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year);

        return $this->applySoftDeleteFilter($model, $query)->count();
    }

    /**
     * Get entity count for the last month.
     */
    public function getLastMonthCount(Model $model, array $conditions = [])
    {
        $query = $model::where($conditions)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year);

        return $this->applySoftDeleteFilter($model, $query)->count();
    }

    /**
     * Calculate percentage change between two values.
     */
    public function calculatePercentageChange($current, $previous)
    {
        if ($previous > 0) {
            return (($current - $previous) / $previous) * 100;
        }

        return $current > 0 ? 100 : 0;
    }

    /**
     * Get the total number of visits for today.
     */
    public function getDailyVisits()
    {
        return Visit::whereDate('visited_at', Carbon::today())->count();
    }

    /**
     * Get the total number of visits for last month.
     */
    public function getLastMonthVisits()
    {
        return Visit::whereMonth('visited_at', Carbon::now()->subMonth()->month)
            ->whereYear('visited_at', Carbon::now()->subMonth()->year)
            ->count();
    }

    /**
     * Calculate percentage change in visits since last month.
     */
    public function calculatePercentageChangeSinceLastMonth()
    {
        $currentMonthTotal = $this->getDailyVisits();
        $lastMonthTotal = $this->getLastMonthVisits();

        if ($lastMonthTotal > 0) {
            // Calculate the percentage change
            return (($currentMonthTotal - $lastMonthTotal) / $lastMonthTotal) * 100;
        }

        // If last month had no visits, treat it as a 100% increase
        return $currentMonthTotal > 0 ? 100 : 0;
    }
}
