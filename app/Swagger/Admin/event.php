<?php

/**
 *  @OA\Get(
 *      path="/admin/events", operationId="AdminEventsIndex", tags={"Admin Events"},
 *      summary="Fetches events collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=city,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"images","leisure","city","likes","bookmarks","comments"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=title (-title)",
 *          @OA\Schema(
 *              type="string", enum={"id", "afisha_date", "published_at", "title"}
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
 *      path="/admin/events/{id}", operationId="AdminEventsShow", tags={"Admin Events"},
 *      summary="Fetches the event resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Event id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=images,likes",
 *          @OA\Schema(
 *              type="string",
 *              enum={"images","leisure","city","likes","bookmarks","comments"}
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
 *      path="/admin/events", operationId="AdminEventsCreate", tags={"Admin Events"},
 *      summary="Create a new event resource",
 *
 *      @OA\RequestBody(required=true, description="Pass event properties",
 *          @OA\JsonContent(required={"type", "title", "city_id", "leisure_id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="events"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="user_id", type="integer", example="1"),
 *                      @OA\Property(property="city_id", type="integer", example="2"),
 *                      @OA\Property(property="leisure_id", type="integer", example="10"),
 *                      @OA\Property(property="title",type="string",example="Event title"),
 *                      @OA\Property(property="body", type="text", example="Something text..."),
 *                      @OA\Property(property="announce", type="text",example="the announce..."),
 *                      @OA\Property(property="street", type="string",example="street"),
 *                      @OA\Property(property="link", type="string",example="http://link.com"),
 *                      @OA\Property(property="afisha_date", type="string",example="2021-06-22"),
 *                      @OA\Property(property="published_at", type="string",example="2021-06-22"),
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
 *      path="/admin/events/{id}", operationId="AdminEventsUpdate", tags={"Admin Events"},
 *      summary="Update the event resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Event id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass event properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="events"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="title",type="string",example="Another Event title"),
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
 *     path="/admin/events/{id}", operationId="AdminEventsDelete", tags={"Admin Events"},
 *     summary="Delete the event resource",
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

