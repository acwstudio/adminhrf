<?php

/**
 *  @OA\Get(
 *      path="/admin/news", operationId="AdminNewsIndex", tags={"Admin News"},
 *      summary="Fetches news collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tags,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tags", "images", "bookmarks", "comments"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=title (-title)",
 *          @OA\Schema(
 *              type="string", enum={"id", "title", "published_at"}
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
 *      path="/admin/news/{id}", operationId="AdminNewsShow", tags={"Admin News"},
 *      summary="Fetches the news resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="News id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tags,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tags", "images", "bookmarks", "comments"}
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
 *      path="/admin/news", operationId="AdminNewsCreate", tags={"Admin News"},
 *      summary="Create a new news resource",
 *
 *      @OA\RequestBody(required=true, description="Pass news properties",
 *          @OA\JsonContent(required={"type", "title", "announce", "listorder", "body"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="news"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="listorder", type="integer", example="200"),
 *                      @OA\Property(property="title",type="string",example="News title"),
 *                      @OA\Property(property="body", type="text", example="Something text..."),
 *                      @OA\Property(property="announce", type="text",example="the announce..."),
 *                      @OA\Property(property="show_in_rss", type="boolean", example=true),
 *                      @OA\Property(property="status", type="boolean", example=true),
 *                      @OA\Property(property="show_in_afisha", type="boolean",example=true),
 *                      @OA\Property(property="close_commentation", type="boolean",example=true),
 *                      @OA\Property(property="published_at", type="string",example="1992-09-18"),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="tags", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="2"),
 *                                  @OA\Property(property="type", type="string", example="tags"),
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
 *      path="/admin/news/{id}", operationId="AdminNewsUpdate", tags={"Admin News"},
 *      summary="Update the news resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="News id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass news properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="news"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="Another News title"),
 *                      @OA\Property(property="announce", type="text",example="another announce..."),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="images", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="10"),
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
 * @OA\Delete(
 *     path="/admin/news/{id}", operationId="AdminNewsDelete", tags={"Admin News"},
 *     summary="Delete the news resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="News id", required=true,
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

