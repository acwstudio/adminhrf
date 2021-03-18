<?php

/**
 *
 * @OA\Get(
 *     path="/timeline",
 *     operationId="timelineList",
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
 *         name="start_year",
 *         in="query",
 *         description="Filter results by lower bound of date(Y)",
 *         required=false,
 *         @OA\Schema(
 *             type="int",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="end_year",
 *         in="query",
 *         description="Filter results by upper bound of date(Y)",
 *         required=false,
 *         @OA\Schema(
 *             type="int",
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
 * @OA\Get(
 *     path="/timeline/events/{event:slug}",
 *     operationId="timeline",
 *     tags={"Timeline"},
 *     summary="Display single model of event from timeline",
 *    @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="Event slug",
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
 *
 * @OA\Get(
 *     path="/timeline/biographies/{biography:slug}",
 *     operationId="timeline",
 *     tags={"Timeline"},
 *     summary="Display single model of Biography from timeline",
 *    @OA\Parameter(
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
 *
 */

