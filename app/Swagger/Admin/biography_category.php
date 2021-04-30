<?php

/**
 *  @OA\Get(
 *      path="/admin/biocategories", operationId="AdminBiographyCategoriesIndex",
 *      tags={"Admin Biography Categories"},
 *      summary="Fetches biography categories collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=biographies",
 *          @OA\Schema(
 *              type="string",
 *              enum={"biographies"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=title (-title)",
 *          @OA\Schema(
 *              type="string", enum={"id", "title"}
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
 *      path="/admin/biocategories/{id}", operationId="AdminBiographyCategoriesShow",
 *     tags={"Admin Biography Categories"},
 *      summary="Fetches the biography category resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Biography Category id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=biographies",
 *          @OA\Schema(
 *              type="string",
 *              enum={"biographies"}
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
 *      path="/admin/biocategories", operationId="AdminBiographyCategoriesCreate",
 *     tags={"Admin Biography Categories"},
 *      summary="Create a new biography category resource",
 *
 *      @OA\RequestBody(required=true, description="Pass biography categories properties",
 *          @OA\JsonContent(required={"title"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="biocategories"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="new category"),
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
 *      path="/admin/biocategories/{id}", operationId="AdminBiographyCategoriesUpdate",
 *      tags={"Admin Biography Categories"},
 *      summary="Update the biography category resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Biography Category id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass biography categories properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="biocategories"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="Another title"),
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
 *     path="/admin/biocategories/{id}", operationId="AdminBiographyCategoriesDelete",
 *     tags={"Admin Biography Categories"},
 *     summary="Delete the biography category resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Biography Category id", required=true,
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

