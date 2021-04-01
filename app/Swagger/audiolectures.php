<?php
/**
 * @OA\Get(
 *     path="/audiolectures",
 *     operationId="audiolecturesList",
 *     tags={"Audiolectures"},
 *     summary="Display paginated listing of audiolectures",
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
 *
 * @OA\Get(
 *     path="/audiolectures/tags/{slug}",
 *     operationId="audiolecturesList",
 *     tags={"Audiolectures"},
 *     summary="Display paginated listing of audiolectures",
 *
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="Tag's slug",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
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
 * )
 *
 * @OA\Get(
 *     path="/audiolectures/{slug}",
 *     operationId="audiolectureItem",
 *     tags={"Audiolectures"},
 *     summary="Display audiolecture by slug",
 *
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="Audiolecture slug",
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
