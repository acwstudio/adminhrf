<?php

/**
 *
 * @OA\Get(
 *     path="/timeline",
 *     operationId="biographiesList",
 *     tags={"Timeline"},
 *     summary="Display paginated listing of timeline",
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
 *         name="start_date",
 *         in="query",
 *         description="Filter results by lower bound of date(Y-M)",
 *         required=false,
 *         @OA\Schema(
 *             type="date",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="end_date",
 *         in="query",
 *         description="Filter results by upper bound of date(Y-M)",
 *         required=false,
 *         @OA\Schema(
 *             type="date",
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
 *
 */

