<?php

namespace App\Http\Controllers\Swagger;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

/**
 * @OA\Info(
 *     title="API Documentation",
 *     version="1.0.0",
 *     description="Additional documentation for the application:"
 * )
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     securityScheme="bearerAuth",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 *
 * @OA\Schema(
 *     schema="Response",
 *     title="Response",
 *     description="Response block",
 *             @OA\Property(property="success", type="boolean", example="true|false"),
 *             @OA\Property(property="status", type="string", example="'success'|'error'"),
 *             @OA\Property(property="data (array)", example="[string: 'string', string: array, string: object, ...]"),
 *             @OA\Property(property="message", type="string")
 * )
 *
 * @OA\Schema(
 *     schema="User",
 *     title="User",
 *     description="User model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", example="example@mail.com"),
 *     @OA\Property(property="created_at", type="datetime", example="1970-01-01T00:00:01.000000Z"),
 *     @OA\Property(property="updated_at", type="datetime", example="1970-01-01T00:00:01.000000Z")
 * )
 *
 * @OA\Schema(
 *     schema="RequestService",
 *     title="RequestService",
 *     description="RequestService model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Some title here"),
 *     @OA\Property(property="description", type="string", example="Some description text here"),
 *     @OA\Property(property="created_at", type="datetime", example="1970-01-01T00:00:01.000000Z"),
 *     @OA\Property(property="updated_at", type="datetime", example="1970-01-01T00:00:01.000000Z")
 * )
 *
 */
abstract class SwaggerController extends Controller
{
    use AuthorizesRequests;
}
