<?php
/**
 * @OA\Get(
 *     path="/random/articles",
 *     operationId="randomArticlesList",
 *     tags={"Random"},
 *     summary="Display listing of random articles",
 *
 *     @OA\Parameter(
 *         name="rand",
 *         in="query",
 *         description="Qty articles in result - 1 by default",
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
 * @OA\Get(
 *     path="/random/news",
 *     operationId="randomNewsList",
 *     tags={"Random"},
 *     summary="Display listing of random news",
 *
 *     @OA\Parameter(
 *         name="rand",
 *         in="query",
 *         description="Qty news in result - 1 by default",
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
 * @OA\Get(
 *     path="/random/biographies",
 *     operationId="randomBiographiesList",
 *     tags={"Random"},
 *     summary="Display listing of random biographies",
 *
 *     @OA\Parameter(
 *         name="rand",
 *         in="query",
 *         description="Qty biographies in result - 1 by default",
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
 * @OA\Get(
 *     path="/random/videolectures",
 *     operationId="randomVideolecturesList",
 *     tags={"Random"},
 *     summary="Display listing of random videolectures",
 *
 *     @OA\Parameter(
 *         name="rand",
 *         in="query",
 *         description="Qty videolectures in result - 1 by default",
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
 * @OA\Get(
 *     path="/random/audiolectures",
 *     operationId="randomAudiolecturesList",
 *     tags={"Random"},
 *     summary="Display listing of random audiolectures",
 *
 *     @OA\Parameter(
 *         name="rand",
 *         in="query",
 *         description="Qty audiolectures in result - 1 by default",
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
 * @OA\Get(
 *     path="/random/films",
 *     operationId="randomFilmsList",
 *     tags={"Random"},
 *     summary="Display listing of random films",
 *
 *     @OA\Parameter(
 *         name="rand",
 *         in="query",
 *         description="Qty films in result - 1 by default",
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
 * @OA\Get(
 *     path="/random/highlights",
 *     operationId="randomHighlightsList",
 *     tags={"Random"},
 *     summary="Display listing of random highlights",
 *
 *     @OA\Parameter(
 *         name="rand",
 *         in="query",
 *         description="Qty articles in result - 1 by default",
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
 * )@OA\Get(
 *     path="/random/courses",
 *     operationId="randomCoursesList",
 *     tags={"Random"},
 *     summary="Display listing of random articles",
 *
 *     @OA\Parameter(
 *         name="rand",
 *         in="query",
 *         description="Qty articles in result - 1 by default",
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
 * @OA\Get(
 *     path="/random/tests",
 *     operationId="randomTestList",
 *     tags={"Random"},
 *     summary="Display listing of random tests",
 *
 *     @OA\Parameter(
 *         name="rand",
 *         in="query",
 *         description="Qty tests in result - 1 by default",
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
 * @OA\Get(
 *     path="/random/audiocourses",
 *     operationId="randomAudiocoursesList",
 *     tags={"Random"},
 *     summary="Display listing of random audiocourses",
 *
 *     @OA\Parameter(
 *         name="rand",
 *         in="query",
 *         description="Qty articles in result - 1 by default",
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
 * @OA\Get(
 *     path="/random/videocourses",
 *     operationId="randomVideocoursesList",
 *     tags={"Random"},
 *     summary="Display listing of random videocourses",
 *
 *     @OA\Parameter(
 *         name="rand",
 *         in="query",
 *         description="Qty videocourses in result - 1 by default",
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
 * @OA\Get(
 *     path="/random/podcasts",
 *     operationId="randomPodcastsList",
 *     tags={"Random"},
 *     summary="Display listing of random podcasts",
 *
 *     @OA\Parameter(
 *         name="rand",
 *         in="query",
 *         description="Qty podcasts in result - 1 by default",
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
 *
 *
 */
