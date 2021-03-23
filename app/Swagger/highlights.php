<?php

/**
 * @OA\Get(
 *     path="/highlights",
 *     operationId="highlightsList",
 *     tags={"Highlights"},
 *     summary="Display paginated listing of highlights",
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="The page number",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         description="Number of items per page",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
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
 * )
 *
 * @OA\Get(
 *     path="/highlights/{id}",
 *     operationId="highlightsItem",
 *     tags={"Highlights"},
 *     summary="Display highlight by id",
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="highlight id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
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
 * )
 *
 *
 */
