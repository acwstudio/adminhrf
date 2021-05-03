<?php

/**
 *  @OA\Get(
 *      path="/admin/podcasts", operationId="AdminPodcastsIndex", tags={"Admin Podcasts"},
 *      summary="Fetches podcasts collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=city,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"images","taggable","bookmarks","tags"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=title (-title)",
 *          @OA\Schema(
 *              type="string", enum={"id", "order", "created_at", "title"}
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
 *      path="/admin/podcasts/{id}", operationId="AdminPodcastsShow", tags={"Admin Podcasts"},
 *      summary="Fetches the podcast resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Podcast id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=images,tags",
 *          @OA\Schema(
 *              type="string",
 *              enum={"images","taggable","bookmarks","tags"}
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
 *      path="/admin/podcasts", operationId="AdminPodcastsCreate", tags={"Admin Podcasts"},
 *      summary="Create a new podcast resource",
 *
 *      @OA\RequestBody(required=true, description="Pass podcast properties",
 *          @OA\JsonContent(required={"type", "title", "iframe", "order"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="podcasts"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="order", type="integer", example="1"),
 *                      @OA\Property(property="title",type="string",example="Podcast title"),
 *                      @OA\Property(property="description", type="text", example="Something text..."),
 *                      @OA\Property(property="iframe", type="string",example="iframe text..."),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
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
 *      path="/admin/podcasts/{id}", operationId="AdminPodcastsUpdate", tags={"Admin Podcasts"},
 *      summary="Update the podcast resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Podcast id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass event properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="podcasts"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="Another Podcast title"),
 *                      @OA\Property(property="description", type="text",
 *                          example="another description..."),
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
 *     path="/admin/podcasts/{id}", operationId="AdminPodcastsDelete", tags={"Admin Podcasts"},
 *     summary="Delete the podcast resource",
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

