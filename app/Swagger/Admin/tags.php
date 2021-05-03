<?php

/**
 *  @OA\Get(
 *      path="/admin/tags", operationId="AdminTagsIndex", tags={"Admin Tags"},
 *      summary="Fetches tags collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=articles,news",
 *          @OA\Schema(
 *              type="string",
 *              enum={
 *                  "articles", "documents", "news", "biographies", "videomaterials", "audiomaterials"
 *              }
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
 *      path="/admin/tags/{id}", operationId="AdminTagsShow", tags={"Admin Tags"},
 *      summary="Fetches the tag resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Tag id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=articles,biographies",
 *          @OA\Schema(
 *              type="string",
 *              enum={
 *                  "articles", "documents", "news", "biographies", "videomaterials",
 *                  "audiomaterials"
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
 *      path="/admin/tags", operationId="AdminTagsCreate", tags={"Admin Tags"},
 *      summary="Create a new question resource",
 *
 *      @OA\RequestBody(required=true, description="Pass tag properties",
 *          @OA\JsonContent(required={"type", "title"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="tags"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="tag title"),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="news", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="5"),
 *                                  @OA\Property(property="type", type="string", example="news"),
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
 *      path="/admin/tags/{id}", operationId="AdminTagsUpdate", tags={"Admin Tags"},
 *      summary="Update the tag resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Tag id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass tag properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="tags"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="Another Tag title"),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="news", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="10"),
 *                                  @OA\Property(property="type", type="string", example="news"),
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
 *     path="/admin/tags/{id}", operationId="AdminTagsDelete", tags={"Admin Tags"},
 *     summary="Delete the tag resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Tag id", required=true,
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


