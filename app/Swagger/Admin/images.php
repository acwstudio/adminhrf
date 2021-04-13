<?php


/**
 * @OA\Get(
 *     path="/admin/images/{id}",
 *     operationId="AdminImagesShow",
 *     tags={"Admin Images"},
 *     summary="Show admin image resource",
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Image id",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="200",
 *         description="Everything is fine",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *     @OA\Response(
 *         response="401",
 *         description="Unauthorized",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 *
 * )
 */

/**
 * @OA\Post(
 *     path="/admin/images",
 *     operationId="AdminImagesStore",
 *     tags={"Admin Images"},
 *     summary="Add admin image resource",
 *
 *     @OA\RequestBody(
 *         description="data to create new image",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *              required={"imageable_type","file"},
 *                  @OA\Property(property="imageable_type", type="string"),
 *                  @OA\Property(property="file", type="file"),
 *                  @OA\Property(property="imageable_id", type="integer"),
 *             ),
 *
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="201",
 *         description="Created"
 *     ),
 *      @OA\Response(
 *         response="403",
 *         description="Unauthenticated"
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="unexpected error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 * )
 */

/**
 * @OA\Post(
 *     path="/admin/images/{id}",
 *     operationId="AdminImagesUpdate",
 *     tags={"Admin Images"},
 *     summary="Update image resource",
 *
 *      @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Image id",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ),
 *
 *     @OA\RequestBody(
 *         description="data to create new image",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *              required={"file"},
 *                  @OA\Property(property="file", type="file"),
 *             ),
 *
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="201",
 *         description="Created"
 *     ),
 *      @OA\Response(
 *         response="403",
 *         description="Unauthenticated"
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="unexpected error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 * )
 */


/**
 * @OA\Delete(
 *     path="/admin/images/{id}",
 *     operationId="AdminImagesDelete",
 *     tags={"Admin Images"},
 *     summary="Delete image by id",
 *
 *     @OA\Parameter(
 *         description="Image id to delete",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Everything is fine",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *     @OA\Response(
 *         response="403",
 *         description="No permissions to delete resource",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="default",
 *         description="unexpected error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 *
 * )
 */
