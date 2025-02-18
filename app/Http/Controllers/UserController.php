<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
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
        $path = $request->file('avatar')->storeAs(
            'avatars',
            Str::uuid() . '.' . $request->file('avatar')->getClientOriginalExtension(),
            's3'
        );

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
     * Remove user's avatar.
     */
    public function removeAvatar(User $user)
    {
        // Check if the authenticated user is allowed to update the avatar
        $this->authorize('updateSelf', $user);

        // Ensure the user has an avatar before attempting to delete
        if ($user->avatar) {
            // Delete the avatar from S3
            Storage::disk('s3')->delete($user->avatar);

            // Remove the avatar path from the database
            $user->avatar = null;
            $user->save();
        }

        // Return a JSON response confirming the removal
        return response()->json([
            'message' => 'Avatar removed successfully!'
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
