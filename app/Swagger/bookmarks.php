<?php

/**
 * @OA\Get(
 *     path="/bookmarks",
 *     operationId="bookmarksList",
 *     tags={"Bookmarks"},
 *     summary="Display paginated listing of bookmarks",
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
 *         name="user_id",
 *         in="query",
 *         description="RIGHT NOW U CAN GET BOOKMARKS ONLY BY USER ID",
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
 * @OA\Get(
 *     path="/bookmarks/{action}",
 *     operationId="bookmarksList",
 *     tags={"Bookmarks"},
 *     summary="Display paginated listing of bookmarks by action",
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
 *         name="model_type",
 *         in="query",
 *         description="Model type",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             enum={"read", "listen", "watch"}
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         description="RIGHT NOW U CAN GET BOOKMARKS ONLY BY USER ID",
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

