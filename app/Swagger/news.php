<?php

/**
 * @OA\Get(
 *     path="/news",
 *     operationId="newsList",
 *     tags={"News"},
 *     summary="Display paginated listing of news",
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
 *     @OA\Parameter(
 *         name="sort_by",
 *         in="query",
 *         description="Sort by parameter",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             enum={"popular"}
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
 * @OA\Get(
 *     path="/news/tags/{slug}",
 *     operationId="newsListTag",
 *     tags={"News"},
 *     summary="Display paginated listing of news by slug",
 *
 *      @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="Tag's slug",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
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
 *     @OA\Parameter(
 *         name="sort_by",
 *         in="query",
 *         description="Sort by parameter",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             enum={"popular"}
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
 *     path="/news/{slug}",
 *     operationId="newsItem",
 *     tags={"News"},
 *     summary="Display news by slug",
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="News slug",
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

