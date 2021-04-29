<?php

/**
 *  @OA\Get(
 *      path="/admin/biographies", operationId="AdminBiographiesIndex", tags={"Admin Biographies"},
 *      summary="Show admin biographies collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=tags,images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tags", "bookmarks", "categories", "images", "timeline"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=surname (-surname)",
 *          @OA\Schema(
 *              type="string", enum={"id", "firstname", "surname", "published_at"}
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
 *      path="/admin/biographies/{id}", operationId="AdminBiographiesShow", tags={"Admin Biographies"},
 *      summary="Show admin biography resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Biography id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=images,categories",
 *          @OA\Schema(
 *              type="string",
 *              enum={"tags", "bookmarks", "categories", "images", "timeline"}
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
 * @OA\Post(
 *      path="/admin/biographies", operationId="AdminBiographiesCreate", tags={"Admin Biographies"},
 *      summary="Create a new biography resource",
 *
 *      @OA\RequestBody(required=true, description="Pass biography properties",
 *          @OA\JsonContent(required={"type", "surname", "firstname"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="articles"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="firstname", type="string", example="Ivan"),
 *                      @OA\Property(property="surname", type="string", example="Ivanov"),
 *                      @OA\Property(property="patronymic",type="string",example="Ivanovich"),
 *                      @OA\Property(property="birth_date", type="string", example="1980-10-20"),
 *                      @OA\Property(property="death_date", type="string", example=null),
 *                      @OA\Property(property="announce", type="text", example="any announce..."),
 *                      @OA\Property(property="description", type="text", example="any description..."),
 *                      @OA\Property(property="government_start", type="text", example="1980-10-20"),
 *                      @OA\Property(property="government_end", type="text", example=null),
 *                      @OA\Property(property="active", type="boolean",example=true),
 *                      @OA\Property(property="published_at", type="boolean",example="1962-09-18"),
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
 *      path="/admin/biographies/{id}", operationId="AdminBiographiesUpdate", tags={"Admin Biographies"},
 *      summary="Update the biography resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Biography id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass biography properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="biographies"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="firstname",type="string",example="Peter"),
 *                      @OA\Property(property="active", type="boolean",example=true),
 *                      @OA\Property(property="published_at", type="boolean",example="1992-09-18"),
 *                      @OA\Property(property="announce", type="text",example="another announce..."),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="authors", type="object",
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
 *  @OA\Delete(
 *     path="/admin/biographies/{id}", operationId="AdminBiographiesUpdate", tags={"Admin Biographies"},
 *     summary="Delete the biography resource",
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
