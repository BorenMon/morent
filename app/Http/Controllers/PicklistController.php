<?php

namespace App\Http\Controllers;

use App\Models\Picklist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PicklistController extends Controller
{
    /**
     * Display a listing of car models.
     */
    public function carBrandsIndex()
    {
        $brands = Picklist::where('category', 'car_brand')->get();
        return view('admin.pages.picklist.car-brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new car model.
     */
    public function carBrandsCreate()
    {
        return view('admin.pages.picklist.car-brands.create');
    }

    /**
     * Store a newly created car model in storage.
     */
    public function carBrandsStore(Request $request)
    {
        $request->validate([
            'value' => 'required|string|max:255'
        ]);

        Picklist::create([
            'value' => $request->value,
            'category' => 'car_brand'
        ]);

        return redirect()->route('admin.car-brands')->with([
            'message' => 'Car Brand created successfully',
            'message_type' => 'success'
        ]);
    }

    /**
     * Remove the specified car model from storage.
     */
    public function carBrandsDestroy(Picklist $carBrand)
    {
        $carBrand->delete();

        return redirect()->route('admin.car-brands')->with([
            'message' => 'Brand deleted successfully',
            'message_type' => 'success'
        ]);
    }

    public function carTypesIndex()
    {
        $types = Picklist::where('category', 'car_type')->get();
        return view('admin.pages.picklist.car-types.index', compact('types'));
    }

    public function carTypesCreate()
    {
        return view('admin.pages.picklist.car-types.create');
    }

    public function carTypesStore(Request $request)
    {
        $request->validate([
            'value' => 'required|string|max:255'
        ]);

        Picklist::create([
            'value' => $request->value,
            'category' => 'car_type'
        ]);

        return redirect()->route('admin.car-types')->with([
            'message' => 'Car Type created successfully',
            'message_type' => 'success'
        ]);
    }

    public function carTypesDestroy(Picklist $carType)
    {
        $carType->delete();

        return redirect()->route('admin.car-types')->with([
            'message' => 'Type deleted successfully',
            'message_type' => 'success'
        ]);
    }

    public function carSteeringsIndex()
    {
        $steerings = Picklist::where('category', 'car_steering')->get();
        return view('admin.pages.picklist.car-steerings.index', compact('steerings'));
    }

    public function carSteeringsCreate()
    {
        return view('admin.pages.picklist.car-steerings.create');
    }

    public function carSteeringsStore(Request $request)
    {
        $request->validate([
            'value' => 'required|string|max:255'
        ]);

        Picklist::create([
            'value' => $request->value,
            'category' => 'car_steering'
        ]);

        return redirect()->route('admin.car-steerings')->with([
            'message' => 'Car Steering created successfully',
            'message_type' => 'success'
        ]);
    }

    public function carSteeringsDestroy(Picklist $carSteering)
    {
        $carSteering->delete();

        return redirect()->route('admin.car-steerings')->with([
            'message' => 'Steering deleted successfully',
            'message_type' => 'success'
        ]);
    }
}
