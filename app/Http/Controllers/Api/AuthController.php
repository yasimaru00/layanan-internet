<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'device_name' => 'required',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         throw ValidationException::withMessages([
    //             'email' => ['The provided credentials are incorrect.'],
    //         ]);
    //     }

    //     return response()->json(
    //         [
    //             'token' => $user->createToken($request->device_name)->plainTextToken,
    //         ],
    //         200
    //     );
    // }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $key = 'login:' . $request->ip();

        if (RateLimiter::remaining($key, 5) === 0) {
            return response()->json([
                'message' => 'Too many login attempts. Please try again later.',
            ], 429);
        }

        try {
            RateLimiter::hit($key, 60);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                Log::warning('Failed login attempt', ['email' => $request->email, 'ip' => $request->ip()]);
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $user->createToken($request->device_name)->plainTextToken;
            Session::put('api_token', $token);
            
          
            if (Session::has('api_token')) {
                Log::info('API Token stored in session: ' . Session::get('api_token'));
            } else {
                Log::error('Failed to store API Token in session');
            }
            

            return response()->json(['token' => $token], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed', Password::defaults()],
            'device_name' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(
            [
                'token' => $user->createToken($request->device_name)->plainTextToken,
            ],
            200
        );
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->noContent();
    }
}
