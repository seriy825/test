<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends ApiController
{
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request['email'])->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            return $this->responseError([], 'The provided credentials are incorrect', 401);
        }

        $token = $user->createToken("$user->name-AuthToken")->plainTextToken;

        return $this->responseSuccess(compact('token'));
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

        return $this->responseSuccess(compact('token'));
    }

    public function logout(Request $request): JsonResponse
    {
        $user = auth()->user();

        if (!$user) {
            $token = PersonalAccessToken::where(
                'token',
                $request->bearerToken()
            )
                ->first();

            $user = $token ? User::find($token->tokenable_id) : null;
        }

        if ($user) {
            $user->tokens()->delete();
        }

        return $this->responseSuccess([], 'Logged out successfully');
    }

    public function me(): JsonResponse
    {
        $user = auth('sanctum')->user();

        return $this->responseSuccess(compact('user'));
    }
}
