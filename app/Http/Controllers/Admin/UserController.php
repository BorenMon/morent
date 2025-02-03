<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
     * Update the authenticated user's avatar.
     */
    public function updateAvatar(Request $request, User $user)
    {
        // Check if the authenticated user is allowed to update the avatar
        $this->authorize('updateAvatar', $user);

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

        if(!$path) {
            return response()->json([
               'message' => 'Failed to update avatar. Please try again.'
            ], 500);
        }

        // Update the user's avatar path in the database
        $user->avatar = $path;
        $user->save();

        // Return a JSON response with the success message and avatar URL
        return response()->json([
            'message' => 'Avatar updated successfully!',
            'avatar_url' => getAvatarUrl($path)
        ]);
    }
}
