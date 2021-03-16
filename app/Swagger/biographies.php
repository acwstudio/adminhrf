<?php

/**
 * @OA\Get(
 *     path="/biographies/categories",
 *     operationId="biographyCategoriesList",
 *     tags={"Biographies"},
 *     summary="Display listing of biography categories",
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
 *     path="/biographies",
 *     operationId="biographiesList",
 *     tags={"Biographies"},
 *     summary="Display paginated listing of biographies",
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
 *         name="century",
 *         in="query",
 *         description="Filter results by century",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="categories",
 *         in="query",
 *         description="Filter results by categories",
 *         required=false,
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
 * @OA\Get(
 *     path="/biographies/{slug}",
 *     operationId="biographyItem",
 *     tags={"Biographies"},
 *     summary="Display biography by slug",
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="Biography slug",
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

