<?php

/**
 *  @OA\Get(
 *      path="/admin/articles", operationId="AdminArticlesIndex", tags={"Admin Articles"},
 *      summary="Fetches articles collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tags,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tags", "authors", "comments", "bookmarks", "category", "images", "timeline"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=title (-title)",
 *          @OA\Schema(
 *              type="string", enum={"id", "title", "published_at", "created_at", "event_date"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="filter", in="query", description="Filter by field value", required=false,
 *          example="?filter[is_timeline]=true (false)",
 *          @OA\Schema(type="string", enum={"is_timeline"})
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
 *      path="/admin/articles/{id}", operationId="AdminArticlesShow", tags={"Admin Articles"},
 *      summary="Fetches the article resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Article id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tags,authors",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tags", "authors", "comments", "bookmarks", "category", "images", "timeline"}
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
 *      path="/admin/articles", operationId="AdminArticlesCreate", tags={"Admin Articles"},
 *      summary="Create a new article resource",
 *
 *      @OA\RequestBody(required=true, description="Pass article properties",
 *          @OA\JsonContent(required={"type", "title", "user_id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="articles"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="user_id", type="integer", example="1"),
 *                      @OA\Property(property="category_id", type="integer", example="2"),
 *                      @OA\Property(property="title",type="string",example="Article title"),
 *                      @OA\Property(property="body", type="text", example="Something text..."),
 *                      @OA\Property(property="show_in_rss", type="boolean", example=true),
 *                      @OA\Property(property="yatextid", type="string", example="any string"),
 *                      @OA\Property(property="active", type="boolean",example=true),
 *                      @OA\Property(property="published_at", type="boolean",example="1962-09-18"),
 *                      @OA\Property(property="announce", type="text",example="the announce..."),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="authors", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="2"),
 *                                  @OA\Property(property="type", type="string", example="authors"),
 *                              ),
 *                          )
 *                      ),
 *                      @OA\Property(property="images", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="5"),
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
 *      path="/admin/articles/{id}", operationId="AdminArticlesUpdate", tags={"Admin Articles"},
 *      summary="Update the article resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Article id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass article properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="articles"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="Another Article title"),
 *                      @OA\Property(property="active", type="boolean",example=true),
 *                      @OA\Property(property="published_at", type="boolean",example="1992-09-18"),
 *                      @OA\Property(property="announce", type="text",example="another announce..."),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="authors", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="10"),
 *                                  @OA\Property(property="type", type="string", example="authors"),
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
 *     path="/admin/articles/{id}", operationId="AdminArticlesDelete", tags={"Admin Articles"},
 *     summary="Delete the article resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Article id", required=true,
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
