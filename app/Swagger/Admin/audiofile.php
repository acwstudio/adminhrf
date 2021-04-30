<?php

/**
 *  @OA\Get(
 *      path="/admin/audiofiles",operationId="AdminAudiofilesIndex",tags={"Admin Audiofiles"},
 *      summary="Fetches audiofiles collection",
 *
 *      @OA\Parameter(
 *          name="per_page",in="query",description="Number of items per page",required=false,
 *          example="?per_page=20",
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Parameter(
 *          name="include",in="query",description="Includes related models",required=false,
 *          example="?include=audiomaterial",
 *          @OA\Schema(type="string",enum={"audiomaterial"},)
 *      ),
 *      @OA\Parameter(
 *          name="sort",in="query",description="Sorts by field",required=false,example="?sort=name",
 *          @OA\Schema(type="string",enum={"id", "name"},)
 *      ),
 *      @OA\Response(
 *          response="200",description="Everything is fine",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *      @OA\Response(
 *          response="401",description="Unauthorized",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *  )
 *
 *  @OA\Get(
 *      path="/admin/audiofiles/{id}",operationId="AdminAudiofileShow",tags={"Admin Audiofiles"},
 *      summary="Fetches an admin audiofile resource",
 *
 *      @OA\Parameter(name="id",in="path",description="id of fetched audiofile",required=true,
 *          example="/audiofiles/3",
 *          @OA\Schema(type="integer",)
 *      ),
 *      @OA\Parameter(
 *          name="include",in="query",description="Includes related models",required=false,
 *          example="?include=audiomaterial",
 *          @OA\Schema(type="string",enum={"audiomaterial"},)
 *      ),
 *      @OA\Response(
 *          response="200",description="Everything is fine",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *      @OA\Response(
 *          response="401",description="Unauthorized",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *  )
 *
 *  @OA\Post(
 *      path="/admin/audiofiles",operationId="AdminAudiofileCreate",tags={"Admin Audiofiles"},
 *      summary="Create a new audiofile resource",
 *
 *      @OA\RequestBody(
 *          required=true,description="Pass audiofile properties",
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  required={"audiofile"},
 *                  @OA\Property(property="audiofile", type="file"),
 *              )
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response="200",description="Everything is fine",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *      @OA\Response(
 *          response="401",description="Unauthorized",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *      @OA\Response(
 *          response="422",description="File does not pass validation",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *  )
 *
 *
 *  @OA\Delete(path="/admin/audiofiles/{id}",operationId="AdminAudiofileDelete",
 *     tags={"Admin Audiofiles"},summary="Delete the audiofile resource",
 *
 *      @OA\Parameter(name="id",in="path",description="id of deleted audiofile",required=true,
 *          example="/audiofiles/3",
 *          @OA\Schema(type="integer",)
 *      ),
 *
 *      @OA\Response(response="204",description="Everything is fine",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *      @OA\Response(response="401",description="Unauthorized",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *  )
 */
