<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function customersIndex(Request $request)
    {
        $authUser = auth()->user();

        // Get the search query
        $search = $request->input('search');

        $query = User::query()->where('role', UserRole::Customer->value);

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('phone', 'LIKE', "%$search%");
            });
        }

        // Paginate results
        $users = $query->paginate(15)->appends(['search' => $search]);

        return view('admin.pages.customers.index', compact('users', 'search'));
    }

    public function customersShow(User $user)
    {
        return view('admin.pages.customers.show', compact('user'));
    }

    public function customersCreate()
    {
        return view('admin.pages.customers.create');
    }

    public function customersStore(Request $request)
    {
        // Validate form input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'is_verified' => 'required|boolean',
            'address' => 'nullable|string',
            'password' => 'required|min:8|confirmed',
            'id_card' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'driving_license' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle file uploads
        $idCardPath = $request->hasFile('id_card')
            ? $request->file('id_card')->storeAs(
                'customer/id_cards',
                Str::uuid() . '.' . $request->file('id_card')->getClientOriginalExtension(),
                's3'
            )
            : null;

        $drivingLicensePath = $request->hasFile('driving_license')
            ? $request->file('driving_license')->storeAs(
                'customer/driving_licenses',
                Str::uuid() . '.' . $request->file('driving_license')->getClientOriginalExtension(),
                's3'
            )
            : null;

        // Create user
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'is_verified' => $request->boolean('is_verified'),
            'address' => $validated['address'] ?? null,
            'password' => Hash::make($validated['password']),
            'id_card' => $idCardPath,
            'driving_license' => $drivingLicensePath,
        ]);

        return redirect()->route('admin.customers')->with([
            'message' => 'Customer created successfully',
            'message_type' => 'success'
        ]);
    }

    public function customersEdit(User $user)
    {
        return view('admin.pages.customers.edit', compact('user'));
    }

    public function customersUpdate(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'phone' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user)],
            'is_verified' => 'required|boolean',
            'address' => 'nullable|string'
        ]);

        // Ensure is_verified has a default value of false
        $validated['is_verified'] = $request->boolean('is_verified');

        $user->update($validated);

        return redirect()->route('admin.customers.show', $user)->with([
            'message' => 'Customer updated successfully',
            'message_type' => 'success'
        ]);
    }

    public function customersDestroy(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('admin.customers')->with([
                'message' => 'Customer deleted successfully',
                'message_type' => 'success'
            ]);
        }

        return redirect()->route('admin.customers')->with([
            'message' => 'Failed to delete customer',
            'message_type' => 'error'
        ]);
    }
}
