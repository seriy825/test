<?php

namespace App\Http\Controllers\Swagger;

class AuthSwaggerController extends SwaggerController
{
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Login user",
     *     tags={"Auth"},
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=true,
     *         description="User Email",
     *         @OA\Schema(
     *             type="string",
     *             format="email",
     *             example="user@email.com"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         required=true,
     *         description="User Password",
     *             @OA\Schema(
     *                 type="string",
     *                 format="password",
     *                 example="password"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object", @OA\Property(property="token", type="string", example="token here")),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="data", type="array", example="[]", @OA\Items()),
     *             @OA\Property(property="message", type="string", example="The provided credentials are incorrect")
     *         )
     *     )
     * )
     */
    public function login() {}

    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="Register user",
     *     tags={"Auth"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *         description="User Name",
     *         @OA\Schema(
     *             type="string",
     *             example="John Doe"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=true,
     *         description="User Email",
     *         @OA\Schema(
     *             type="string",
     *             format="email",
     *             example="example@mail.com"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         required=true,
     *         description="User Password",
     *         @OA\Schema(
     *             type="string",
     *             format="password",
     *             example="password"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful registration",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="token", type="string", example="xx|xxxxxxxxxxxxxxxx")
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="The email field must be a valid email address."
     *             ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     type="array",
     *                     @OA\Items(
     *                         type="string",
     *                         example="The email field must be a valid email address."
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="array",
     *                     @OA\Items(
     *                         type="string",
     *                         example="The password field is required."
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function register() {}

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Logout user",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Logged out",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="string", example="Logged out successfully")
     *         )
     *     ),
     *      @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function logout() {}

    /**
     * @OA\Get(
     *     path="/api/auth/user",
     *     summary="Get authenticated user",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Authenticated user data",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", example="user@email.com"),
     *                 @OA\Property(property="email_verified_at", type="datetime", example="1970-01-01T00:00:01.000000Z"),
     *                 @OA\Property(property="created_at", type="datetime", example="1970-01-01T00:00:01.000000Z"),
     *                 @OA\Property(property="updated_at", type="datetime", example="1970-01-01T00:00:01.000000Z"),
     *                 @OA\Property(property="role", type="string", example="user"),
     *             ),
     *             @OA\Property(property="message", type="string", example="Authenticated user data retrieved successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized")
     *         )
     *     )
     * )
     */
    public function me() {}
}
