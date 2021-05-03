<?php

/**
 *  @OA\Get(
 *      path="/admin/highlights", operationId="AdminHighlightsIndex", tags={"Admin Highlights"},
 *      summary="Fetches highlights collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tags,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tags", "images", "highlightable"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=title (-title)",
 *          @OA\Schema(
 *              type="string", enum={"title", "order"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="filter", in="query", description="Filter by field value", required=false,
 *          example="?filter[type]=audiocourse",
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
 *      path="/admin/highlights/{id}", operationId="AdminHighlightsShow", tags={"Admin Highlights"},
 *      summary="Fetches the highlight resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Highlight id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tags,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tags", "images", "highlightable"}
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
 *      path="/admin/highlights", operationId="AdminHighlightsCreate", tags={"Admin Highlights"},
 *      summary="Create a new highlight resource",
 *
 *      @OA\RequestBody(required=true, description="Pass highlight properties",
 *          @OA\JsonContent(required={"type", "title", "order"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="highlights"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="type", type="integer", example="1"),
 *                      @OA\Property(property="title",type="string",example="Article title"),
 *                      @OA\Property(property="order", type="integer", example="6"),
 *                      @OA\Property(property="active", type="boolean",example=true),
 *                      @OA\Property(property="published_at", type="boolean",example="1962-09-18"),
 *                      @OA\Property(property="announce", type="text",example="the announce..."),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="images", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="5"),
 *                                  @OA\Property(property="type", type="string", example="images"),
 *                              ),
 *                          ),
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
 *      path="/admin/highlights/{id}", operationId="AdminHighlightsUpdate", tags={"Admin Highlights"},
 *      summary="Update the highlight resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Article id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass highlight properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="articles"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="Another Highlight title"),
 *                      @OA\Property(property="active", type="boolean",example=true),
 *                      @OA\Property(property="published_at", type="boolean",example="1992-09-18"),
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
 *     path="/admin/highlights/{id}", operationId="AdminHighlightsDelete", tags={"Admin Highlights"},
 *     summary="Delete the highlight resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Highlight id", required=true,
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

