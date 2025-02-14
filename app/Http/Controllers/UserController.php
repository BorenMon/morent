<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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

    public function customersIndex()
    {
        $users = User::where('role', UserRole::Customer->value)->paginate(15);

        return view('admin.pages.customers.index', compact('users'));
    }

    /**
     * Update user's avatar.
     */
    public function updateAvatar(Request $request, User $user)
    {
        // Check if the authenticated user is allowed to update the avatar
        $this->authorize('updateSelf', $user);

        // Validate the uploaded file to ensure it's an image and meets size requirements
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If the user already has an avatar, delete it from S3
        if ($user->avatar) {
            Storage::disk('s3')->delete($user->avatar);
        }

        // Store the new avatar in the default S3 bucket
        $path = $request->file('avatar')->store('avatars', 's3');

        // Update the user's avatar path in the database
        $user->avatar = $path;
        $user->save();

        // Return a JSON response with the success message and avatar URL
        return response()->json([
            'message' => 'Avatar updated successfully!',
            'avatar_url' => getAvatarUrl($path)
        ]);
    }

    /**
     * Update user's info.
     */
    public function updateInfo(Request $request, User $user)
    {
        // Check if the authenticated user is authorized to update the info
        $this->authorize('updateSelf', $user);

        // Validate request body
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
            'address' => 'nullable|string|max:255',
        ]);

        // Update only validated fields
        $user->update($validated);

        return redirect()->back()->with([
            'message' => 'Info updated successfully!',
            'message_type' => 'success'
        ]);
    }

    /**
     * Update user's password.
     */
    public function updatePassword(Request $request, User $user)
    {
        // Check if the authenticated user is allowed to update the password
        $this->authorize('updateSelf', $user);

        // Validate request body
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Check if the current password matches the user's stored password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
        }

        // Update the user's password in the database
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with([
            'message' => 'Password updated successfully!',
            'message_type' => 'success'
        ]);
    }
}
