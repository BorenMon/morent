<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the staffs.
     */
    public function staffsIndex(Request $request)
    {
        $authUser = auth()->user();

        $this->authorize('manageStaffs', $authUser);

        // Get the search query
        $search = $request->input('search');

        $query = User::query();

        if ($authUser->role === UserRole::Admin->value) {
            $query->whereNotIn('role', ['CUSTOMER'])->where('id', '!=', $authUser->id); // Exclude self
        } elseif ($authUser->role === UserRole::Manager->value) {
            $query->whereIn('role', ['STAFF', 'MANAGER'])
                ->where('id', '!=', $authUser->id); // Exclude self
        }

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

        return view('admin.pages.staffs.index', compact('users', 'search'));
    }

    public function staffsCreate()
    {
        $this->authorize('manageStaffs', auth()->user());

        return view('admin.pages.staffs.create');
    }

    public function staffsStore(Request $request)
    {
        $authUser = auth()->user();
        $this->authorize('manageStaffs', $authUser);

        // Define role restrictions
        $allowedRoles = [
            'ADMIN' => ['ADMIN', 'STAFF', 'MANAGER'],
            'MANAGER' => ['STAFF'],
        ];

        // Get the roles that the current user can assign
        $assignableRoles = $allowedRoles[$authUser->role] ?? [];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'role' => ['required', Rule::in($assignableRoles)],
            'address' => 'nullable|string',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'address' => $validated['address'] ?? null,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.staffs')->with([
            'message' => 'Staff created successfully',
            'message_type' => 'success'
        ]);
    }

    public function staffsShow(User $user)
    {
        $this->authorize('manageStaffs', $user);
        $this->authorize('modifyStaff', $user);

        return view('admin.pages.staffs.show', compact('user'));
    }

    public function staffsEdit(User $user)
    {
        $this->authorize('manageStaffs', $user);
        $this->authorize('modifyStaff', $user);

        return view('admin.pages.staffs.edit', compact('user'));
    }

    public function staffsUpdate(Request $request, User $user)
    {
        $authUser = auth()->user();
        $this->authorize('manageStaffs', $authUser);
        $this->authorize('modifyStaff', $user);

        // Define role restrictions
        $allowedRoles = [
            'ADMIN' => ['ADMIN', 'STAFF', 'MANAGER'],
            'MANAGER' => ['STAFF'],
        ];

        // Get the roles that the current user can assign
        $assignableRoles = $allowedRoles[$authUser->role] ?? [];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'phone' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user)],
            'role' => ['required', Rule::in($assignableRoles)],
            'address' => 'nullable|string',
        ]);

        $user->update($validated);

        return redirect()->route('admin.staffs.show', $user)->with([
            'message' => 'Staff updated successfully',
            'message_type' => 'success'
        ]);
    }

    public function staffsDestroy(User $user)
    {
        $authUser = auth()->user();
        $this->authorize('manageStaffs', $authUser);
        $this->authorize('modifyStaff', $user);

        if ($user->delete()) {
            return redirect()->route('admin.staffs')->with([
                'message' => 'Staff deleted successfully',
                'message_type' => 'success'
            ]);
        }

        return redirect()->route('admin.staffs')->with([
            'message' => 'Failed to delete staff',
            'message_type' => 'error'
        ]);
    }
}
