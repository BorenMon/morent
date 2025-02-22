<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Booking;
use App\Models\Picklist;
use app\Enums\BookingStage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use app\Enums\BookingPaymentStatus;
use App\Services\StatisticsService;
use app\Enums\BookingProgressStatus;
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
            where('rating', '>=', 4)->
            limit(16)->get();

        $totalCars = $statisticsService->getTotalCount(new Car());

        $homeData = compact('popularCars', 'recommendedCars', 'totalCars');

        // Cache the data
        Cache::put($cacheKey, $homeData, now()->addHour());

        return view('client.home', $homeData);
    }

    public function cars()
    {
        $types = Picklist::where('category', 'car_type')->get();

        return view('client.cars', compact('types'));
    }

    public function getCars(Request $request)
    {
        // Get filters from request
        $search = $request->input('search');
        $types = $request->input('type', []); // Expecting an array
        $capacities = $request->input('capacity', []); // Expecting an array
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        // Query cars with filters
        $cars = Car::query();

        if ($search) {
            $cars->where(function ($query) use ($search) {
                $query->where('model', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if (!empty($types)) {
            $cars->whereIn('type_id', $types);
        }

        if (!empty($capacities)) {
            $cars->whereIn('capacity', $capacities);
        }

        if ($minPrice) {
            $cars->where('price', '>=', (float) $minPrice);
        }

        if ($maxPrice) {
            $cars->where('price', '<=', (float) $maxPrice);
        }

        // Paginate results (10 cars per page)
        $cars = $cars->paginate(10);

        // Return JSON response
        return response()->json($cars);
    }

    public function detail(Car $car)
    {
        $popularCars = Car::where('rent_times', '>=', 50)->limit(8)->get();

        return view('client.detail', compact('car', 'popularCars'));
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

    public function book(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'customer_id' => [
                'required',
                Rule::exists('users', 'id')->where('role', 'CUSTOMER')
            ],
            'car_id'           => 'required|exists:cars,id',
            'pick_up_city'     => 'required|string|max:255',
            'pick_up_datetime' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $minDate = Carbon::now()->addDay();
                    if (Carbon::parse($value)->lessThan($minDate)) {
                        $fail('The pick-up date must be at least 1 day from now.');
                    }
                },
            ],
            'drop_off_city'    => 'required|string|max:255',
            'drop_off_datetime' => 'required|date|after:pick_up_datetime',
            'name'             => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'address'          => 'required|string|max:500',
            'payment_proof'    => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $car = Car::findOrFail($request->car_id);

        // Calculate rental duration in days
        $pickUpDate = Carbon::parse($request->pick_up_datetime);
        $dropOffDate = Carbon::parse($request->drop_off_datetime);
        $durationInDays = $pickUpDate->diffInDays($dropOffDate);

        // Ensure minimum duration is at least 1 day
        $durationInDays = max($durationInDays, 1);

        // Calculate total amount
        $validated['total_amount'] = $car->has_promotion ? $car->promotion_price * $durationInDays : $car->price * $durationInDays;

        // Handle payment proof upload if provided
        if ($request->hasFile('payment_proof')) {
            $validated['payment_proof'] = $request->file('payment_proof')->storeAs(
                'payment-proofs',
                Str::uuid() . '.' . $request->file('payment_proof')->getClientOriginalExtension(),
                's3'
            );
        }

        // Set default values for booking
        $validated['stage'] = BookingStage::Booking;
        $validated['payment_status'] = BookingPaymentStatus::Pending;
        $validated['progress_status'] = BookingProgressStatus::Pending;

        // Create the booking record
        Booking::create($validated);

        return redirect()->route('client.profile')->with([
        'message_type' =>'success',
           'message' => 'Booking request sent successfully!'
        ])->withFragment('bookings');
    }

    public function profile()
    {
        $bookings = Booking::where('stage', BookingStage::Booking)->latest()->take(8)->get();

        $renting = Booking::where('stage', BookingStage::Renting)->latest()->first();

        $histories = Booking::where('stage', BookingStage::History)->latest()->take(8)->get();

        return view('client.profile', compact('bookings', 'renting', 'histories'));
    }

    public function cancel(Booking $booking)
    {
        if (auth()->user()->id != $booking->customer_id) {
            abort(403);
        }

        $booking->update([
            'stage' => BookingStage::History,
            'progress_status' => BookingProgressStatus::Cancelled,
            'payment_status' => $booking->payment_status == BookingPaymentStatus::Paid->value ? BookingPaymentStatus::Refunding : $booking->payment_status
        ]);

        return redirect()->back()->with([
            'message_type' => 'success',
            'message' => 'Booking cancelled successfully!'
        ])->withFragment('history');
    }
}
