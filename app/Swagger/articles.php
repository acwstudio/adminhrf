<?php
/**
* @OA\Get(
*     path="/articles",
*     operationId="articlesList",
*     tags={"Articles"},
*     summary="Display paginated listing of articles",
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
*     path="/articles/{slug}",
*     operationId="articleItem",
*     tags={"Articles"},
*     summary="Display article by slug",
*
*     @OA\Parameter(
*         name="slug",
*         in="path",
*         description="Article slug",
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
