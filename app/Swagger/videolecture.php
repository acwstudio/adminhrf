<?php

/**
 * @OA\Get(
 *     path="/videolectures",
 *     operationId="videolecturesList",
 *     tags={"Videolectures"},
 *     summary="Display paginated listing of videolectures",
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
 *     path="/videolectures/{slug}",
 *     operationId="videolecturesItem",
 *     tags={"Videolectures"},
 *     summary="Display videolecture by slug",
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="videolecture slug",
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

