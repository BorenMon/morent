<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\StatisticsService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function home(StatisticsService $statisticsService)
    {
        $cacheKey = 'home_data_' . Carbon::today()->toDateString();

        $cachedData = Cache::get($cacheKey);

        if ($cachedData) {
            return view('client.home', $cachedData);
        }

        $popularCars = Car::where('rent_times', '>=', 50)->limit(8)->get();
    
        $recommendedCars = Car::
            // where('rating', '>=', 4)->
            limit(16)->get();
    
        $totalCars = $statisticsService->getTotalCount(new Car());

        $homeData = compact('popularCars','recommendedCars', 'totalCars');

        // Cache the data
        Cache::put($cacheKey, $homeData, now()->addHour());
    
        return view('client.home', $homeData);
    }

    public function detail(Car $car)
    {
        return view('client.detail', compact('car'));
    }

    public function payment(Car $car)
    {
        return view('client.payment', compact('car'));
    }

    public function uploadIdCard(Request $request, User $user)
    {
        $this->authorize('updateSelf', $user);

        $request->validate([
            'id_card' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($user->id_card) {
            Storage::disk('s3')->delete($user->id_card);
        }

        $path = $request->file('id_card')->storeAs(
            'customer/id_cards',
            Str::uuid() . '.' . $request->file('id_card')->getClientOriginalExtension(),
            's3'
        );

        // Update the user's avatar path in the database
        $user->id_card = $path;
        $user->is_verified = false;
        $user->save();

        // Return a JSON response with the success message and avatar URL
        return response()->json([
            'message' => 'ID Card uploaded successfully!',
            'id_card' => $path
        ]);
    }

    public function removeIdCard(User $user)
    {
        $this->authorize('updateSelf', $user);

        // Check if the user has an ID card uploaded
        if ($user->id_card) {
            // Delete the ID card from S3
            Storage::disk('s3')->delete($user->id_card);

            // Remove the ID card path from the database
            $user->id_card = null;
            $user->is_verified = false;
            $user->save();

            // Return a JSON response with success message
            return response()->json([
                'message' => 'ID Card removed successfully!'
            ]);
        }

        // Return a JSON response if there was no ID card to remove
        return response()->json([
            'message' => 'No ID Card to remove.'
        ], 404);
    }

    public function uploadDrivingLicense(Request $request, User $user)
    {
        $this->authorize('updateSelf', $user);

        $request->validate([
            'driving_license' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($user->driving_license) {
            Storage::disk('s3')->delete($user->driving_license);
        }

        $path = $request->file('driving_license')->storeAs(
            'customer/driving_licenses',
            Str::uuid() . '.' . $request->file('driving_license')->getClientOriginalExtension(),
            's3'
        );

        $user->driving_license = $path;
        $user->is_verified = false;
        $user->save();

        return response()->json([
            'message' => 'Driving License uploaded successfully!',
            'driving_license' => $path
        ]);
    }

    public function removeDrivingLicense(User $user)
    {
        $this->authorize('updateSelf', $user);

        if ($user->driving_license) {
            Storage::disk('s3')->delete($user->driving_license);

            $user->driving_license = null;
            $user->is_verified = false;
            $user->save();

            return response()->json([
                'message' => 'Driving License removed successfully!'
            ]);
        }

        return response()->json([
            'message' => 'No Driving License to remove.'
        ], 404);
    }
}
