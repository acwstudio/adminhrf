<?php

/**
 * @OA\Get(
 *     path="/documents",
 *     operationId="documentsCategoriesList",
 *     tags={"Documents"},
 *     summary="Display listing of document categories",
 *
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
 *     path="/documents/{category}",
 *     operationId="documentsList",
 *     tags={"Documents"},
 *     summary="Display listing of documents by category",
 *
 *     @OA\Parameter(
 *         name="category",
 *         in="path",
 *         description="Category slug",
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
 *     path="/documents/{category}/{document}",
 *     operationId="documentItem",
 *     tags={"Documents"},
 *     summary="Display document by category and slug",
 *
 *     @OA\Parameter(
 *         name="category",
 *         in="path",
 *         description="Category slug",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="document",
 *         in="path",
 *         description="Document slug",
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
 */

