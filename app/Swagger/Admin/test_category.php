<?php

/**
 *  @OA\Get(
 *      path="/admin/test-categories", operationId="AdminTestCategoriesIndex",
 *      tags={"Admin Test Categories"},
 *      summary="Fetches test categories collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tests",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tests"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=text (-text)",
 *          @OA\Schema(
 *              type="string", enum={"id", "text","position"}
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
 *      path="/admin/test-categories/{id}", operationId="AdminTestCategoriesShow",
 *     tags={"Admin Test Categories"},
 *      summary="Fetches the test category resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Test Category id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tests",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tests"}
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
 *      path="/admin/test-categories", operationId="AdminTestCategoriesCreate",
 *     tags={"Admin Test Categories"},
 *      summary="Create a new test category resource",
 *
 *      @OA\RequestBody(required=true, description="Pass test categories properties",
 *          @OA\JsonContent(required={"text","position"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="tcategories"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="text",type="string",example="new category"),
 *                      @OA\Property(property="position",type="integer",example="3"),
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
 *      path="/admin/test-categories/{id}", operationId="AdminTestCategoriesUpdate",
 *      tags={"Admin Test Categories"},
 *      summary="Update the test category resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Test Category id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass test categories properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="tcategories"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="text",type="string",example="Another text"),
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
 *     path="/admin/test-categories/{id}", operationId="AdminTestCategoriesDelete",
 *     tags={"Admin Test Categories"},
 *     summary="Delete the test category resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Article Category id", required=true,
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
