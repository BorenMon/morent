<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Update user's avatar.
     */
    public function updateAvatar(Request $request, User $user)
    {
        // Check if the authenticated user is allowed to update the avatar
        $this->authorize('updateUser', $user);

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
        // Check if the authenticated user is allowed to update the info
        $this->authorize('updateUser', $user);

        // Validate request body
        $request->validate([
            'name',
            'phone',
            'address',
        ]);

        // Update the user's info in the database
        $user->update($request->all());

        // Return a JSON response with the success message
        return response()->json(['message' => 'User info updated successfully!']);
    }

    /**
     * Update user's password.
     */
    public function updatePassword(Request $request, User $user)
    {
        // Check if the authenticated user is allowed to update the password
        $this->authorize('updateUser', $user);

        // Validate request body
        $request->validate([
            'current_password',
            'new_password',
            'new_password_confirmation',
        ]);

        // Check if the current password matches the user's stored password
        if (! Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password does not match.'], 400);
        }

        // Update the user's password in the database
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Return a JSON response with the success message
        return response()->json(['message' => 'Password updated successfully!']);
    }
}
