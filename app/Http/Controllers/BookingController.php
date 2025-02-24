<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use App\Models\Picklist;
use app\Enums\BookingStage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use app\Enums\BookingPaymentStatus;
use app\Enums\BookingProgressStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the search query
        $search = $request->input('search');

        $query = Booking::query();

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            });
        }

        // Paginate results
        $bookings = $query->paginate(15)->appends(['search' => $search]);

        return view('admin.pages.bookings.index', compact('bookings', 'search'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $paymentStatusOptions = BookingPaymentStatus::values();
        $paymentProgressStatusOptions = BookingProgressStatus::values();

        return view('admin.pages.bookings.show', compact('booking', 'paymentStatusOptions', 'paymentProgressStatusOptions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $brandOptions = Picklist::where('category', 'car_brand')->pluck('value', 'id');
        $steeringOptions = Picklist::where('category', 'car_steering')->pluck('value', 'id');
        $typeOptions = Picklist::where('category', 'car_type')->pluck('value', 'id');

        return view('admin.pages.cars.edit', compact(
            'brandOptions',
            'steeringOptions',
            'typeOptions',
            'car'
        ));
    }

    public function updateImage(Request $request, Car $car)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($car->image) {
            Storage::disk('s3')->delete($car->card_image);
        }

        $path = $request->file('image')->storeAs(
            'car/card-images',
            Str::uuid() . '.' . $request->file('image')->getClientOriginalExtension(),
            's3'
        );

        $car->card_image = $path;
        $car->save();

        return response()->json([
            'message' => 'Image updated successfully!',
            'image_url' => getAssetUrl($path)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'payment_status'   => ['required', 'string', Rule::in(BookingPaymentStatus::values())],
            'progress_status'  => ['required', 'string', Rule::in(BookingProgressStatus::values())],
        ]);

        $stage = $booking->stage;
        $paymentStatus = $booking->payment_status;

        if ($validated['progress_status'] === BookingProgressStatus::InProgress->value) {
            $stage = BookingStage::Renting;
        }
        if ($validated['payment_status'] === BookingPaymentStatus::Refunding->value || $validated['payment_status'] === BookingPaymentStatus::Refunded->value || $validated['progress_status'] === BookingProgressStatus::Completed->value ||
        $validated['progress_status'] === BookingProgressStatus::Cancelled->value) {
            $stage = BookingStage::History;
        }
        if ($validated['payment_status'] === BookingPaymentStatus::Paid && $validated['progress_status'] === BookingProgressStatus::Rejected)
        {
            $paymentStatus = BookingPaymentStatus::Refunding;
        }

        $booking->update([
            'stage' => $stage,
            'payment_status' => $paymentStatus
        ]);

        return redirect()->back()->with([
            'message' => 'Booking updated successfully',
            'message_type' => 'success'
        ]);
    }
}
