<?php

/**
 *  @OA\Get(
 *      path="/admin/document-categories", operationId="AdminBDocumentCategoriesIndex",
 *      tags={"Admin Document Categories"},
 *      summary="Fetches document categories collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=documents",
 *          @OA\Schema(
 *              type="string",
 *              enum={"documents"}
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
 *      path="/admin/document-categories/{id}", operationId="AdminDocumentCategoriesShow",
 *     tags={"Admin Document Categories"},
 *      summary="Fetches the document category resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Document Category id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=documents",
 *          @OA\Schema(
 *              type="string",
 *              enum={"documents"}
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
 *      path="/admin/document-categories", operationId="AdminDocumentCategoriesCreate",
 *     tags={"Admin Document Categories"},
 *      summary="Create a new document category resource",
 *
 *      @OA\RequestBody(required=true, description="Pass document categories properties",
 *          @OA\JsonContent(required={"title"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="documentcategories"),
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
 *      path="/admin/document-categories/{id}", operationId="AdminDocumentCategoriesUpdate",
 *      tags={"Admin Document Categories"},
 *      summary="Update the document category resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Document Category id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass document categories properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="documentcategories"),
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
 *     path="/admin/document-categories/{id}", operationId="AdminDocumentCategoriesDelete",
 *     tags={"Admin Document Categories"},
 *     summary="Delete the document category resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Document Category id", required=true,
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

