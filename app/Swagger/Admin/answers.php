<?php

/**
 *  @OA\Get(
 *      path="/admin/answers", operationId="AdminAnswerIndex", tags={"Admin Answers"},
 *      summary="Fetches answers collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=question,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"question", "images"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=title (-title)",
 *          @OA\Schema(
 *              type="string", enum={"id", "title", "created_at"}
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
 *      path="/admin/answers/{id}", operationId="AdminAnswersShow", tags={"Admin Answers"},
 *      summary="Fetches the answer resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Answer id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=question,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"question", "images"}
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
 *      path="/admin/answers", operationId="AdminAnswersCreate", tags={"Admin Answers"},
 *      summary="Create a new answer resource",
 *
 *      @OA\RequestBody(required=true, description="Pass answer properties",
 *          @OA\JsonContent(required={"question_id", "title", "is_right"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="answers"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="question_id", type="integer", example="4"),
 *                      @OA\Property(property="title", type="string", example="Our title"),
 *                      @OA\Property(property="is_right",type="boolean",example=true),
 *                      @OA\Property(property="description", type="text", example="Some description..."),
 *                      @OA\Property(property="points", type="integer",example="8"),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="images", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="22"),
 *                                  @OA\Property(property="type", type="string", example="images"),
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
 *      path="/admin/answers/{id}", operationId="AdminAnswersUpdate", tags={"Admin Answers"},
 *      summary="Update the answer resource",
 *
 *      @OA\RequestBody(required=true, description="Pass answer properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="answers"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="points", type="integer", example="10"),
 *                      @OA\Property(property="description", type="text", example="Some description..."),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="images", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="24"),
 *                                  @OA\Property(property="type", type="string", example="images"),
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
 *  @OA\Delete(
 *     path="/admin/answers/{id}", operationId="AdminAnswersUpdate", tags={"Admin Answers"},
 *     summary="Delete the answer resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Answer id", required=true,
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
