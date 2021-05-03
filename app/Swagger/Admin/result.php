<?php

/**
 *  @OA\Get(
 *      path="/admin/results", operationId="AdminResultsIndex",tags={"Admin Results"},
 *      summary="Fetches results collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=test,user",
 *          @OA\Schema(
 *              type="string",
 *              enum={"test,user"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=time_passed (-time_passed)",
 *          @OA\Schema(
 *              type="string", enum={"id", "time_passed"}
 *          )
 *      ),
 *
 *     @OA\Parameter(
 *          name="filter", in="query", description="Filter by field value", required=false,
 *          example="?filter[user]= 1 (user_id)",
 *          @OA\Schema(type="string", enum={"user","test"})
 *      ),
 *
 *      @OA\Response(
 *          response="200", description="Everything is fine",
 *          @OA\MediaType(mediaType="application/json",)
 *      ),
 *      @OA\Response(
 *          response="401", description="Unauthorized",
 *          @OA\MediaType(mediaType="application/json",)
 *      ),
 *  )
 *
 *  @OA\Get(
 *      path="/admin/results/{id}", operationId="AdminResultsShow",tags={"Admin Results"},
 *      summary="Fetches the result resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Result id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=test",
 *          @OA\Schema(
 *              type="string",
 *              enum={"test", "user"}
 *          )
 *      ),
 *      @OA\Response(response="200", description="Everything is fine",
 *          @OA\MediaType(mediaType="application/json",)
 *      ),
 *      @OA\Response(response="401", description="Unauthorized",
 *          @OA\MediaType(mediaType="application/json",)
 *      ),
 *  )
 *
 *  @OA\Post(
 *      path="/admin/results", operationId="AdminResultsCreate",tags={"Admin Results"},
 *      summary="Create a new result resource",
 *
 *      @OA\RequestBody(required=true, description="Pass result properties",
 *          @OA\JsonContent(required={"value","time_passed","is_closed","user_id","test_id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="messages"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="value",type="integer",example="10"),
 *                      @OA\Property(property="time_passed",type="integer",example="20"),
 *                      @OA\Property(property="test_id",type="integer",example="3"),
 *                      @OA\Property(property="user_id",type="integer",example="3"),
 *                      @OA\Property(property="is_closed",type="boolean",example=false),
 *                  ),
 *              )
 *          )
 *      ),
 *
 *      @OA\Response(response="201", description="Everything is fine",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *      @OA\Response(response="401", description="Unauthorized",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *      @OA\Response(response="422", description="Data does not pass validation",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *  )
 *
 *  @OA\Patch(
 *      path="/admin/results/{id}", operationId="AdminResultsUpdate",tags={"Admin Results"},
 *      summary="Update the result resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Result id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass result properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="results"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="value",type="integer",example="12"),
 *                  ),
 *              )
 *          )
 *      ),
 *
 *      @OA\Response(response="204", description="Everything is fine",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *      @OA\Response(response="401", description="Unauthorized",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *      @OA\Response(response="422", description="Data does not pass validation",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *  )
 *
 * @OA\Delete(
 *     path="/admin/results/{id}", operationId="AdminResultsDelete",tags={"Admin Results"},
 *     summary="Delete the result resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Result id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *     @OA\Response(response="204", description="Everything is fine",
 *          @OA\MediaType(mediaType="application/json")
 *      ),
 *     @OA\Response(response="401", description="Unauthorized",
 *         @OA\MediaType(mediaType="application/json")
 *     )
 *  )
 */

