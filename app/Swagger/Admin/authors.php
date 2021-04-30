<?php

/**
 *  @OA\Get(
 *      path="/admin/authors", operationId="AdminAuthorIndex", tags={"Admin Authors"},
 *      summary="Fetches authors collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=articles,image",
 *          @OA\Schema(
 *              type="string",
 *              enum={"articles", "image", "video"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=firstname (-firstname)",
 *          @OA\Schema(
 *              type="string", enum={"id", "birth_date", "firstname", "surname"}
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
 *      path="/admin/authors/{id}", operationId="AdminAuthorsShow", tags={"Admin Authors"},
 *      summary="Fetches the author resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Author id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=video,image",
 *          @OA\Schema(
 *              type="string",
 *              enum={"articles", "video", "image"}
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
 *      path="/admin/authors", operationId="AdminAuthorsCreate", tags={"Admin Authors"},
 *      summary="Create a new author resource",
 *
 *      @OA\RequestBody(required=true, description="Pass author properties",
 *          @OA\JsonContent(required={"type", "surname", "firstname"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="authors"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="firstname", type="string", example="Alexander"),
 *                      @OA\Property(property="patronymic", type="string", example="Sergeevich"),
 *                      @OA\Property(property="surname",type="string",example="Pushkin"),
 *                      @OA\Property(property="birth_date", type="string", example="1992-09-18"),
 *                      @OA\Property(property="description", type="text", example="Some description..."),
 *                      @OA\Property(property="announce", type="text",example="the announce..."),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="articles", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="22"),
 *                                  @OA\Property(property="type", type="string", example="articles"),
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
 *      path="/admin/authors/{id}", operationId="AdminAuthorsUpdate", tags={"Admin Authors"},
 *      summary="Update the author resource",
 *
 *      @OA\RequestBody(required=true, description="Pass author properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="authors"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="birth_date", type="string", example="06-05-1799"),
 *                      @OA\Property(property="description", type="text", example="Some description..."),
 *                      @OA\Property(property="announce", type="text",example="the announce..."),
 *                  ),
 *                  @OA\Property(property="relationships", type="object",
 *                      @OA\Property(property="articles", type="object",
 *                          @OA\Property(property="data", type="array",
 *                              @OA\Items(type="object",
 *                                  @OA\Property(property="id", type="integer", example="24"),
 *                                  @OA\Property(property="type", type="string", example="articles"),
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
 *     path="/admin/authors/{id}", operationId="AdminAuthorsDelete", tags={"Admin Authors"},
 *     summary="Delete the author resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Author id", required=true,
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
