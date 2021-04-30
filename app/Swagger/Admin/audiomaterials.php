<?php

/**
 *  @OA\Get(
 *      path="/admin/audiomaterials", operationId="AdminAudiomaterialsIndex",
 *      tags={"Admin Audiomaterials"},summary="Fetches audiomaterials collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tags,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tags", "highlights", "images", "bookmarks", "audiofile"}
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
 *      path="/admin/audiomaterials/{id}", operationId="AdminAudiomaterialsShow",
 *      tags={"Admin Audiomaterials"},summary="Fetches the audiomaterial resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Audiomaterial id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tags,authors",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tags", "highlights", "images", "bookmarks", "audiofile"}
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
 *      path="/admin/audiomaterials", operationId="AdminAudiomaterialsCreate",
 *      tags={"Admin Audiomaterials"},summary="Create a new audiomaterial resource",
 *
 *      @OA\RequestBody(required=true, description="Pass audiomaterial properties",
 *          @OA\JsonContent(required={"type", "title", "position"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="audiomaterials"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="parent_id", type="integer", example="1"),
 *                      @OA\Property(property="title",type="string",example="Audiomaterial title"),
 *                      @OA\Property(property="description", type="text", example="Something text..."),
 *                      @OA\Property(property="path", type="string", example="/path"),
 *                      @OA\Property(property="show_in_rss_apple", type="boolean", example=true),
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
 *      path="/admin/audiomaterials/{id}", operationId="AdminAudiomaterialsUpdate",
 *      tags={"Admin Audiomaterials"},summary="Update the audiomaterial resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Audiomaterial id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass audiomaterial properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="audiomaterials"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="Another Audiomaterial title"),
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
 *     path="/admin/audiomaterials/{id}", operationId="AdminAudiomaterialsDelete",
 *     tags={"Admin Audiomaterials"},summary="Delete the audiomaterial resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Audiomaterial id", required=true,
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
