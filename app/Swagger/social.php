<?php


/**
 * @OA\Get(
 *     path="/like",
 *     operationId="like",
 *     tags={"Social"},
 *     summary="Add/remove current user's like on selected entity",
 *
 *     @OA\Parameter(
 *         name="model_type",
 *         in="query",
 *         description="Model type",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             enum={"article", "news", "comment"}
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="query",
 *         description="Likeable model id",
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
