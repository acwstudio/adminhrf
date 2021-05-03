<?php

/**
 *  @OA\Get(
 *      path="/admin/questions", operationId="AdminQuestionsIndex", tags={"Admin Questions"},
 *      summary="Fetches questions collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=city,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tests","answers"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=created_at (-created_at)",
 *          @OA\Schema(
 *              type="string", enum={"id", "position", "created_at"}
 *          )
 *      ),
 *
 *     @OA\Parameter(
 *          name="filter", in="query", description="Filter by field value", required=false,
 *          example="?filter[has_points]=true (false)",
 *          @OA\Schema(type="string", enum={"has_points"})
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
 *      path="/admin/questions/{id}", operationId="AdminQuestionsShow", tags={"Admin Questions"},
 *      summary="Fetches the question resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Question id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=answers,tests",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tests","answers"}
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
 *      path="/admin/questions", operationId="AdminQuestionsCreate", tags={"Admin Questions"},
 *      summary="Create a new question resource",
 *
 *      @OA\RequestBody(required=true, description="Pass question properties",
 *          @OA\JsonContent(required={"type", "text", "position", "points"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="questions"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="position", type="integer", example="1"),
 *                      @OA\Property(property="has_points", type="boolean", example=true),
 *                      @OA\Property(property="text",type="text",example="Question title"),
 *                      @OA\Property(property="description", type="text", example="Something text..."),
 *                      @OA\Property(property="points", type="integer",example="7"),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="answers", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="5"),
 *                                  @OA\Property(property="type", type="string", example="answers"),
 *                              ),
 *                          )
 *                      ),
 *                  )
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
 *      path="/admin/questions/{id}", operationId="AdminQuestionsUpdate", tags={"Admin Questions"},
 *      summary="Update the question resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Question id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass question properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="questions"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="text",type="string",example="Another Question text"),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="tests", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="10"),
 *                                  @OA\Property(property="type", type="string", example="tests"),
 *                              ),
 *                          )
 *                      ),
 *                  )
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
 *     path="/admin/questions/{id}", operationId="AdminQuestionsDelete", tags={"Admin Questions"},
 *     summary="Delete the question resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Question id", required=true,
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


