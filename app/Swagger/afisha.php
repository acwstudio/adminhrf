<?php

/**
 * @OA\Get(
 *     path="/afisha/categories",
 *     operationId="eventsAfishaCategoriesList",
 *     tags={"Afisha"},
 *     summary="Display listing of afisha's events categories",
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
 *     path="/afisha",
 *     operationId="eventsAfishaList",
 *     tags={"Afisha"},
 *     summary="Display paginated listing of Afisha",
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
 *         name="categories",
 *         in="query",
 *         description="Filter results by categories - category slugs join by | - {slug}|{slug}...",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="city",
 *         in="query",
 *         description="Filter results by city id",
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
 *     path="/afisha/{id}",
 *     operationId="eventsAfishaItem",
 *     tags={"Afisha"},
 *     summary="Display events by id",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="events id",
 *         required=true,
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
 *
 */

