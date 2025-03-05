<?php

namespace App\Http\Controllers\Swagger;

class RequestServiceSwaggerController extends SwaggerController
{
    /**
     * @OA\Get(
     *     path="/api/requests",
     *     summary="Get all requests",
     *     tags={"Request Service"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of requests",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Sample Request"),
     *                     @OA\Property(property="description", type="string", example="This is a sample request description."),
     *                     @OA\Property(property="user_id", type="integer", example=1),
     *                     @OA\Property(property="created_at", type="datetime", example="2025-03-05T00:00:01.000000Z"),
     *                     @OA\Property(property="updated_at", type="datetime", example="2025-03-05T00:00:01.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Requests retrieved successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/api/requests/create",
     *     summary="Create a new request",
     *     tags={"Request Service"},
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         required=true,
     *         description="Request Title",
     *         @OA\Schema(
     *             type="string",
     *             example="Sample Request"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         required=true,
     *         description="Request Description",
     *         @OA\Schema(
     *             type="string",
     *             example="This is a sample request description."
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Request created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Sample Request"),
     *                 @OA\Property(property="description", type="string", example="This is a sample request description."),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="created_at", type="datetime", example="2025-03-05T00:00:01.000000Z"),
     *                 @OA\Property(property="updated_at", type="datetime", example="2025-03-05T00:00:01.000000Z")
     *             ),
     *             @OA\Property(property="message", type="string", example="Request created successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The title field is required."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="title", type="array",
     *                     @OA\Items(type="string", example="The title field is required.")
     *                 ),
     *                 @OA\Property(property="description", type="array",
     *                     @OA\Items(type="string", example="The description field is required.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store() {}

    /**
     * @OA\Get(
     *     path="/api/requests/{id}",
     *     summary="Get a specific request",
     *     tags={"Request Service"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Request ID",
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Request retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Sample Request"),
     *                 @OA\Property(property="description", type="string", example="This is a sample request description."),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="created_at", type="datetime", example="2025-03-05T00:00:01.000000Z"),
     *                 @OA\Property(property="updated_at", type="datetime", example="2025-03-05T00:00:01.000000Z")
     *             ),
     *             @OA\Property(property="message", type="string", example="Request retrieved successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Request not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Request not found")
     *         )
     *     )
     * )
     */
     public function show() {}

     /**
     * @OA\Put(
     *     path="/api/requests/{id}",
     *     summary="Update a specific request",
     *     tags={"Request Service"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Request ID",
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         required=true,
     *         description="Request Title",
     *         @OA\Schema(
     *             type="string",
     *             example="Updated Request"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         required=true,
     *         description="Request Description",
     *         @OA\Schema(
     *             type="string",
     *             example="This is an updated request description."
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Request updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Updated Request"),
     *                 @OA\Property(property="description", type="string", example="This is an updated request description."),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="created_at", type="datetime", example="2025-03-05T00:00:01.000000Z"),
     *                 @OA\Property(property="updated_at", type="datetime", example="2025-03-05T00:00:01.000000Z")
     *             ),
     *             @OA\Property(property="message", type="string", example="Request updated successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The title field is required."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="title", type="array",
     *                     @OA\Items(type="string", example="The title field is required.")
     *                 ),
     *                 @OA\Property(property="description", type="array",
     *                     @OA\Items(type="string", example="The description field is required.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
     public function update() {}

     /**
     * @OA\Delete(
     *     path="/api/requests/{id}",
     *     summary="Delete a specific request",
     *     tags={"Request Service"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Request ID",
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Request deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="string", example="Request deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Request not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Request not found")
     *         )
     *     )
     * )
     */
     public function destroy() {}
}
