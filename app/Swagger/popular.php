<?php
/**
* @OA\Get(
*     path="/popular/articles",
*     operationId="popularArticlesList",
*     tags={"Popular"},
*     summary="Display listing of popular articles",
*
*     @OA\Parameter(
*         name="qty",
*         in="query",
*         description="Qty articles in result - 6 by default",
*         required=false,
*         @OA\Schema(
*             type="integer",
*         )
*     ),
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
 *
 *  @OA\Get(
 *     path="/popular/comments",
 *     operationId="popularCommentsList",
 *     tags={"Popular"},
 *     summary="Display listing of popular comments",
 *
 *     @OA\Parameter(
 *         name="qty",
 *         in="query",
 *         description="Qty comments in result - 10 by default",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ),
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
*
*
*/
