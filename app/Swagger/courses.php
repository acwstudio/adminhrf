<?php

/**
 * @OA\Get(
 *     path="/courses/audio",
 *     operationId="audioCoursesList",
 *     tags={"Courses"},
 *     summary="Display paginated listing of audiocourses",
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
 *     path="/courses/courses",
 *     operationId="regularCoursesList",
 *     tags={"Courses"},
 *     summary="Display paginated listing of regular courses",
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
 *  * @OA\Get(
 *     path="/courses/video",
 *     operationId="videoCoursesList",
 *     tags={"Courses"},
 *     summary="Display paginated listing of videocourses",
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

 *  * @OA\Get(
 *     path="/courses/video/tags/{slug}",
 *     operationId="videoCoursesList",
 *     tags={"Courses"},
 *     summary="Display paginated listing of videocourses",
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
 * ),
 *

 * @OA\Get(
 *     path="/courses/audio/tags/{slug}",
 *     operationId="videoCoursesList",
 *     tags={"Courses"},
 *     summary="Display paginated listing of videocourses",
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
 * ),
 *
 *
 * @OA\Get(
 *     path="/courses/courses/tags/{slug}",
 *     operationId="videoCoursesList",
 *     tags={"Courses"},
 *     summary="Display paginated listing of videocourses",
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
 * ),
 *
 * @OA\Get(
 *     path="/courses/{id}",
 *     operationId="coursesItem",
 *     tags={"Courses"},
 *     summary="Display any (video-,audio- or regular) course by id",
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="course slug",
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
