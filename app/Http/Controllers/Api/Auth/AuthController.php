<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]);

            event(new Registered($user));
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->sendResponse([
                'user' => new UserResource($user),
                'token' => $token
            ], 'User registered successfully. Please verify your email.', 201);
        } catch (\Exception $e) {
            return $this->sendError('Registration failed.', $e->getMessage(), 400, 'Validation error or database issue.');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError('Unauthorized.', ['email' => 'Invalid credentials.'], 401, 'Credentials mismatch.');
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse([
            'user' => new UserResource($user),
            'token' => $token
        ], 'User logged in successfully.');
    }

    public function user(Request $request)
    {
        return $this->sendResponse(new UserResource($request->user()), 'User profile retrieved.');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->sendResponse(null, 'Logged out successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update(['password' => Hash::make($request->password)]);
        return $this->sendResponse(null, 'Password updated successfully.');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $user->delete();
        return $this->sendResponse(null, 'Account deleted successfully.');
    }

    public function index()
    {
        $users = User::latest()->paginate(20);
        return $this->sendResponse(UserResource::collection($users), 'Users list retrieved.');
    }
}
