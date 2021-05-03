<?php

/**
 *  @OA\Get(
 *      path="/admin/videomaterials", operationId="AdminVideomaterialsIndex",
 *      tags={"Admin Videomaterials"},summary="Fetches videomaterials collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tags,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tags", "comments", "images", "bookmarks", "authors", "likes"}
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
 *     @OA\Parameter(
 *          name="filter", in="query", description="Filter by field value", required=false,
 *          example="?filter[type]=film",
 *          @OA\Schema(type="string", enum={"type"})
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
 *      path="/admin/videomaterials/{id}", operationId="AdminVideomaterialsShow",
 *      tags={"Admin Videomaterials"},summary="Fetches the videomaterial resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Videomaterial id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tags,authors",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tags", "comments", "images", "bookmarks", "authors", "likes"}
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
 *      path="/admin/videomaterials", operationId="AdminVideomaterialsCreate",
 *      tags={"Admin Videomaterials"},summary="Create a new videomaterial resource",
 *
 *      @OA\RequestBody(required=true, description="Pass videomaterial properties",
 *          @OA\JsonContent(required={
 *              "body","title","publish_at","announce","close_commentation","videocode",
 *              "show_in_rss","show_in_main","active","type"
 *          },
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="audiomaterials"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="body", type="string", example="Some text..."),
 *                      @OA\Property(property="title",type="string",example="Audiomaterial title"),
 *                      @OA\Property(property="announce", type="text", example="Something text..."),
 *                      @OA\Property(property="published_at", type="string", example="2021-12-23"),
 *                      @OA\Property(property="videocode", type="string", example="mp4"),
 *                      @OA\Property(property="show_in_rss", type="boolean", example=true),
 *                      @OA\Property(property="show_in_mine", type="boolean", example=true),
 *                      @OA\Property(property="close_commentation", type="boolean", example=true),
 *                      @OA\Property(property="active", type="boolean", example=true),
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
 *      path="/admin/videomaterials/{id}", operationId="AdminVideomaterialsUpdate",
 *      tags={"Admin Videomaterials"},summary="Update the videomaterial resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Videomaterial id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass videomaterial properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="videomaterials"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="Another Videomaterial title"),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="tags", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="10"),
 *                                  @OA\Property(property="type", type="string", example="tags"),
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
 *     path="/admin/videomaterials/{id}", operationId="AdminVideomaterialsDelete",
 *     tags={"Admin Videomaterials"},summary="Delete the videomaterial resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Videomaterial id", required=true,
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

