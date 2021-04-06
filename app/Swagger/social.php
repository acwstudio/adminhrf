<?php


/**
 * @OA\Get(
 *     path="/like",
 *     operationId="like",
 *     tags={"Social"},
 *     summary="Add/remove current user's like on selected entity",
 *
 *     @OA\Parameter(
 *         name="model_type",
 *         in="query",
 *         description="Model type",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             enum={"article", "news", "comment"}
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="query",
 *         description="Likeable model id",
 *         required=true,
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
 *     @OA\Response(
 *         response="401",
 *         description="Unauthorized",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 *
 * )
 */

/**
 * @OA\Get(
 *     path="/rateup",
 *     operationId="rateup",
 *     tags={"Social"},
 *     summary="Up rate of selected entity",
 *
 *     @OA\Parameter(
 *         name="model_type",
 *         in="query",
 *         description="Model type",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             enum={"comment"}
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="query",
 *         description="Rateable model id",
 *         required=true,
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
 *     @OA\Response(
 *         response="401",
 *         description="Unauthorized",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 *
 * )
 */

/**
 * @OA\Get(
 *     path="/ratedown",
 *     operationId="ratedown",
 *     tags={"Social"},
 *     summary="Down rate of selected entity",
 *
 *     @OA\Parameter(
 *         name="model_type",
 *         in="query",
 *         description="Model type",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             enum={"comment"}
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="query",
 *         description="Rateable model id",
 *         required=true,
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
 *     @OA\Response(
 *         response="401",
 *         description="Unauthorized",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 *
 * )
 */

/**
 * @OA\Get(
 *     path="/comments",
 *     operationId="getComments",
 *     tags={"Social"},
 *     summary="Get paged comments related to given model",
 *
 *     @OA\Parameter(
 *         name="model_type",
 *         in="query",
 *         description="Model type",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             enum={"article", "news", "comment"}
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="query",
 *         description="Commentable model id",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
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
 *     @OA\Response(
 *         response="401",
 *         description="Unauthorized",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *
 *
 * )
 */

/**
 * @OA\Get(
 *     path="/comments/answers/{id}",
 *     operationId="getCommentsAnswers",
 *     tags={"Social"},
 *     summary="Get paged comments answers related to given comment",
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Comment id",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
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
 *     @OA\Response(
 *         response="401",
 *         description="Unauthorized",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *
 *
 * )
 */


/**
 * @OA\Post(
 *     path="/comments",
 *     operationId="addComment",
 *     tags={"Social"},
 *     summary="add comment",
 *
 *     @OA\RequestBody(
 *         description="data to create new comment",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(ref="#/components/schemas/CommentAdd"),
 *
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="201",
 *         description="Created"
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="unexpected error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 * )
 */


/**
 * @OA\Delete(
 *     path="/comments/{id}",
 *     operationId="deleteComment",
 *     tags={"Social"},
 *     summary="Delete comment by id",
 *
 *     @OA\Parameter(
 *         description="Comment id to delete",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
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
 *     @OA\Response(
 *         response="403",
 *         description="No permissions to delete resource",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="default",
 *         description="unexpected error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 *
 * )
 */
