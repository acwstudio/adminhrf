<?php

/**
 *  @OA\Get(
 *      path="/admin//article-categories", operationId="AdminArticleCategoriesIndex",
 *      tags={"Admin Article Categories"},
 *      summary="Fetches article categories collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=articles",
 *          @OA\Schema(
 *              type="string",
 *              enum={"articles"}
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
 *      path="/admin/article-categories/{id}", operationId="AdminArticleCategoriesShow",
 *     tags={"Admin Article Categories"},
 *      summary="Fetches the article category resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Article Category id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=articles",
 *          @OA\Schema(
 *              type="string",
 *              enum={"articles"}
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
 *      path="/admin/article-categories", operationId="AdminArticleCategoriesCreate",
 *     tags={"Admin Article Categories"},
 *      summary="Create a new article resource",
 *
 *      @OA\RequestBody(required=true, description="Pass article categories properties",
 *          @OA\JsonContent(required={"title"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="articlecategories"),
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
 *      path="/admin/article-categories/{id}", operationId="AdminArticleCategoriesUpdate",
 *      tags={"Admin Article Categories"},
 *      summary="Update the article category resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Article Category id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass article categories properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="articlecategories"),
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
 *     path="/admin/article-categories/{id}", operationId="AdminArticleCategoriesUpdate",
 *     tags={"Admin Article Categories"},
 *     summary="Delete the article category resource",
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
