<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $email = strtolower($request->email);
            $password = $request->password;

            $user = User::whereEmail($email)->first();

            if (!$user)
                return $this->response404("No user found with the provided email, Please make sure to enter a valid email address");

            if (Hash::check($password, $user->password)) {
                $token = $user->createToken('SOME_SECRET_TOKEN_KEY_HERE')->accessToken;

                $response = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                    'token' => $token,
                ];
//                return response()->json(['token' => $token]);
                return $this->response200('Successfully logged in', $response);
            }

            return $this->response401('Failed to login. Incorrect password.');
        }
        catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            // hashing the password and merging into the request
            $request->merge(['password' => Hash::make($request->password)]);

            $user = User::query()->create($request->only((new User)->getFillable()));
            if (!$user)
                return $this->response409("Failed to create new user, Please try again.");

            $response = [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
            ];

            return $this->response200('Successfully Registered.', $response);
        }
        catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
    }

    public function me()
    {
        try {
            $user = auth()->user();
            if (!$user)
                return $this->response404("No authenticated user found.");

            return $this->response200("User Details", $user);
        }
        catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
    }

    public function logout()
    {
        try {
            return $this->response200("User logged out successfully.", null);
        }
        catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
    }
}
