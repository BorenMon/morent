<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
    }

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'customer_email' => 'required|string|email|max:255|unique:users,email',
            'customer_password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'email' => $request->customer_email,
            'password' => Hash::make($request->customer_password),
            'role' => UserRole::Customer,
        ]);

        // event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::CUSTOMER_HOME)->with('success', 'Registration successful!');
    }
}
