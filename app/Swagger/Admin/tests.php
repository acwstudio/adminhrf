<?php

/**
 *  @OA\Get(
 *      path="/admin/tests", operationId="AdminTestsIndex", tags={"Admin Tests"},
 *      summary="Fetches tests collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=questions,messages",
 *          @OA\Schema(
 *              type="string",
 *              enum={
 *                  "images", "questions", "messages", "comments", "categories", "likes", "results"
 *              }
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=title (-title)",
 *          @OA\Schema(
 *              type="string", enum={"id", "title", "created_at", "published_at"}
 *          )
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
 *      path="/admin/tests/{id}", operationId="AdminTestsShow", tags={"Admin Tests"},
 *      summary="Fetches the test resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Test id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=messages,questions",
 *          @OA\Schema(
 *              type="string",
 *              enum={
 *                  "images", "questions", "messages", "comments", "categories", "likes", "results"
 *              }
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
 *      path="/admin/tests", operationId="AdminTestsCreate", tags={"Admin Tests"},
 *      summary="Create a new test resource",
 *
 *      @OA\RequestBody(required=true, description="Pass test properties",
 *          @OA\JsonContent(required={
 *              "type", "title","is_active","description","time","total_questions","max_points",
 *              "has_points","is_reversable","is_ege","published_at"
 *          },
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="tests"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="test title"),
 *                      @OA\Property(property="is_active",type="boolean",example=true),
 *                      @OA\Property(property="description",type="text",example="test description"),
 *                      @OA\Property(property="time",type="integer",example="20"),
 *                      @OA\Property(property="total_questions",type="integer",example="5"),
 *                      @OA\Property(property="max_points",type="integer",example="3"),
 *                      @OA\Property(property="has_points",type="boolean",example=true),
 *                      @OA\Property(property="is_reversable",type="boolean",example=true),
 *                      @OA\Property(property="is_ege",type="string",example=false),
 *                      @OA\Property(property="published_at",type="string",example="2020-10-09"),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="results", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="5"),
 *                                  @OA\Property(property="type", type="string", example="results"),
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
 *      path="/admin/tests/{id}", operationId="AdminTestsUpdate", tags={"Admin Tests"},
 *      summary="Update the test resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Test id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass test properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="tests"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="Another Test title"),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="questions", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="10"),
 *                                  @OA\Property(property="type", type="string", example="questions"),
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
 *     path="/admin/tests/{id}", operationId="AdminTestsDelete", tags={"Admin Tests"},
 *     summary="Delete the test resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Test id", required=true,
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



