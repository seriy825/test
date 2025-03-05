<?php

namespace App\Http\Controllers\Swagger;

class CurrencyRateSwaggerCotnroller extends SwaggerController
{
    /**
     * @OA\Get(
     *     path="/api/rates",
     *     summary="Get currency rates",
     *     tags={"Currency Rate"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Currency rates retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="response", type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="currency", type="string", example="USD"),
     *                         @OA\Property(property="rate", type="number", format="float", example=1.2345)
     *                     )
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Currency rates retrieved successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Currency rates not found in cache",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Currency rates not found in cache")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized")
     *         )
     *     )
     * )
     */
    public function index() {}
}
