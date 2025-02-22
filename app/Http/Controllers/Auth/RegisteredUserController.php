<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:100', 'unique:users'],
            'email' => ['required', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:admin,restaurant_manager,customer,courier'],
            'phone' => ['required', 'string', 'max:20', 'unique:users'],
            'address' => ['nullable', 'string', 'max:255'],

        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        event(new Registered($user));

        // Auth::login($user); 

        // return response()->noContent();

        $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
]);

    }
}
