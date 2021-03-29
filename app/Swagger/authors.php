<?php

/**
 * @OA\Get(
 *     path="/authors",
 *     operationId="authorsList",
 *     tags={"Authors"},
 *     summary="Display paginated listing of authors",
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
 *     path="/authors/{slug}",
 *     operationId="authorItem",
 *     tags={"Authors"},
 *     summary="Display author by slug",
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="Author slug",
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
 * * @OA\Get(
 *     path="/authors/{slug}/articles",
 *     operationId="articlesListbyAuthor",
 *     tags={"Authors"},
 *     summary="Display paginated listing of articles by given author",
 *
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
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="Author slug",
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

