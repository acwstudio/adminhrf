<?php

/**
 * @OA\Get(
 *     path="/admin/articles/{id}",
 *     operationId="AdminArticlesShow",
 *     tags={"Admin Articles"},
 *     summary="Show admin article resource",
 *
 *     @OA\Parameter(
 *         name="include",
 *         in="query",
 *         description="Includes related models",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             enum={"tags", "authors"}
 *         )
 *     ),
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Article id",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *
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
