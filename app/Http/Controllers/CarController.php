<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('admin.pages.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year'  => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
        ]);

        Car::create($validated);

        return redirect()->route('cars.index')->with('success', 'Car added successfully.');
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
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year'  => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
        ]);

        $car->update($validated);

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
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
