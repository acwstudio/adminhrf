<?php

/**
 * @OA\Get(
 *     path="/tests",
 *     operationId="testList",
 *     tags={"Tests"},
 *     summary="Display paginated listing of tests",
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
 *         description="categories though | operator",
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
 *     path="/tests/{slug}",
 *     operationId="testItem",
 *     tags={"Tests"},
 *     summary="Display tests by slug",
 *     @OA\Parameter(
 *         name="slig",
 *         in="path",
 *         description="test slug",
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
 * @OA\Get(
 *     path="/tests/result/{id}",
 *     operationId="testResultItem",
 *     tags={"Tests"},
 *     summary="Send score and get results P.S. Test can only have points or count neither both",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="test ID",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="count",
 *         in="query",
 *         description="Count of true answers if test is countable",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="points",
 *         in="query",
 *         description="Points right answers if test has points",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         description="user ID -> if not given( r not right) result data will no be saved in DB",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="finished",
 *         in="query",
 *         description="If test was not finished for user (bcs of running out of time or changing page)",
 *         required=false,
 *         @OA\Schema(
 *             type="boolean",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="time",
 *         in="query",
 *         description="time passed (If test has time) in seconds",
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
 *
 */

