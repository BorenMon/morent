<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use App\Enums\UserRole;
use App\Models\Booking;
use App\Services\StatisticsService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function dashboard(StatisticsService $statisticsService)
    {
        $cacheKey = 'dashboard_data_' . Carbon::today()->toDateString();

        // Check if cached data exists
        $cachedData = Cache::get($cacheKey);

        if ($cachedData) {
            return view('admin.pages.dashboard', $cachedData);
        }

        // Perform the calculations if cache is not found
        $customerRole = UserRole::Customer->value;

        // Get customer statistics
        $customersCount = $statisticsService->getTotalCount(new User(), ['role' => $customerRole]);
        $currentMonthCustomers = $statisticsService->getCurrentMonthCount(new User(), ['role' => $customerRole]);
        $lastMonthCustomers = $statisticsService->getLastMonthCount(new User(), ['role' => $customerRole]);
        $customersPercentageChange = $statisticsService->calculatePercentageChange($currentMonthCustomers, $lastMonthCustomers);

        // Get booking statistics
        $bookingsCount = $statisticsService->getTotalCount(new Booking());
        $currentMonthBookings = $statisticsService->getCurrentMonthCount(new Booking());
        $lastMonthBookings = $statisticsService->getLastMonthCount(new Booking());
        $bookingsPercentageChange = $statisticsService->calculatePercentageChange($currentMonthBookings, $lastMonthBookings);

        // Get Total Revenue
        $totalRevenue = Booking::sum('total_amount');
        $currentMonthRevenue = Booking::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_amount');
        $lastMonthRevenue = Booking::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('total_amount');
        if ($lastMonthRevenue > 0) {
            $revenuePercentageChange = (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;
        } else {
            $revenuePercentageChange = $currentMonthRevenue > 0 ? 100 : 0;
        }

        // Get car statistics
        $carsCount = $statisticsService->getTotalCount(new Car());
        $currentMonthCars = $statisticsService->getCurrentMonthCount(new Car());
        $lastMonthCars = $statisticsService->getLastMonthCount(new Car());
        $carsPercentageChange = $statisticsService->calculatePercentageChange($currentMonthCars, $lastMonthCars);

        $recentBookings = Booking::latest()->take(8)->get();

        // Prepare data to be cached
        $dashboardData = compact(
            'customersCount',
            'customersPercentageChange',
            'bookingsCount',
            'bookingsPercentageChange',
            'totalRevenue',
            'revenuePercentageChange',
            'carsCount',
            'carsPercentageChange',
            'recentBookings'
        );

        // Cache the data
        Cache::put($cacheKey, $dashboardData, now()->addHour());

        return view('admin.pages.dashboard', $dashboardData);
    }
}
