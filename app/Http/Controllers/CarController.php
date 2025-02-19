<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Picklist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the search query
        $search = $request->input('search');

        $query = Car::query();

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('model', 'LIKE', "%$search%");
            });
        }

        // Paginate results
        $cars = $query->paginate(15)->appends(['search' => $search]);

        return view('admin.pages.cars.index', compact('cars', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brandOptions = Picklist::where('category', 'car_brand')->pluck('value', 'id');
        $steeringOptions = Picklist::where('category', 'car_steering')->pluck('value', 'id');
        $typeOptions = Picklist::where('category', 'car_type')->pluck('value', 'id');

        return view('admin.pages.cars.create', compact('brandOptions', 'steeringOptions', 'typeOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description'      => 'nullable|string',
            'type_id'          => 'nullable|exists:picklists,id',
            'steering_id'      => 'nullable|exists:picklists,id',
            'brand_id'         => 'nullable|exists:picklists,id',
            'model'            => 'required|string|max:255',
            'gasoline'         => 'required|integer|min:0',
            'capacity'         => 'required|integer|min:1',
            'price'            => 'required|numeric|min:0',
            'has_promotion'    => 'required|boolean',
            'promotion_price'  => [
                'nullable',
                'numeric',
                'min:0',
                'lt:price',
                'required_if:has_promotion,true'
            ],
            'rent_times'       => 'nullable|integer|min:0',
            'rating'           => 'nullable|numeric|min:0|max:5',
        ]);

        $validated['rating'] = $validated['rating'] ?? 0;

        Car::create($validated);

        return redirect()->route('admin.cars')->with([
            'message' => 'Car added successfully',
            'message_type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
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
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'description'      => 'nullable|string',
            'type_id'          => 'nullable|exists:picklists,id',
            'steering_id'      => 'nullable|exists:picklists,id',
            'brand_id'         => 'nullable|exists:picklists,id',
            'model'            => 'required|string|max:255',
            'gasoline'         => 'required|integer|min:0',
            'capacity'         => 'required|integer|min:1',
            'price'            => 'required|numeric|min:0',
            'has_promotion'    => 'required|boolean',
            'promotion_price'  => [
                'nullable',
                'numeric',
                'min:0',
                'lt:price',
                'required_if:has_promotion,true'
            ],
            'rent_times'       => 'nullable|integer|min:0',
            'rating'           => 'nullable|numeric|min:0|max:5',
        ]);

        $validated['rating'] = $validated['rating'] ?? 0;

        $car->update($validated);

        return redirect()->back()->with([
            'message' => 'Car updated successfully',
            'message_type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}
