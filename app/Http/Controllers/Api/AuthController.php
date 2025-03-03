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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

        //TODO: Send email verification

        return $this->responseSuccess(compact('token'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
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

    /**
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return $this->responseError([], 'User not found', 404);
        }

        $user->tokens()->delete();

        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

        return $this->responseSuccess(compact('token'));
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $user = auth('sanctum')->user();

        return $this->responseSuccess(compact('user'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? $this->responseSuccess([], __($status))
            : $this->responseError(['error' => $status], __($status));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                $user->tokens()->each(function ($token) use ($user) {
                    if ($token->name === "$user->name-AuthToken") {
                        $token->delete();
                    }
                });

                $user->createToken($user->name . '-AuthToken');
            }
        );

        return $status === Password::PASSWORD_RESET
            ? $this->responseSuccess([], __($status))
            : $this->responseError(['error' => $status], __($status));
    }

}
