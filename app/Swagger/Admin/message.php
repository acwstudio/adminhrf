<?php

/**
 *  @OA\Get(
 *      path="/admin/messages", operationId="AdminMessagesIndex",tags={"Admin Messages"},
 *      summary="Fetches messages collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"test,images"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=title (-title)",
 *          @OA\Schema(
 *              type="string", enum={"id", "title"}
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
 *      path="/admin/messages/{id}", operationId="AdminMessagesShow",tags={"Admin Messages"},
 *      summary="Fetches the message resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Message id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=images",
 *          @OA\Schema(
 *              type="string",
 *              enum={"test", "images"}
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
 *      path="/admin/messages", operationId="AdminMessagesCreate",tags={"Admin Messages"},
 *      summary="Create a new message resource",
 *
 *      @OA\RequestBody(required=true, description="Pass message properties",
 *          @OA\JsonContent(required={"title","lowest_value","highest_value","text","test_id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="messages"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="text",type="string",example="some text..."),
 *                      @OA\Property(property="title",type="string",example="new title"),
 *                      @OA\Property(property="test_id",type="integer",example="3"),
 *                      @OA\Property(property="highest_value",type="integer",example="3"),
 *                      @OA\Property(property="lowest_value",type="integer",example="1"),
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
 *      path="/admin/messages/{id}", operationId="AdminMessagesUpdate",tags={"Admin Messages"},
 *      summary="Update the message resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Message id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass message properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="messages"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="text",type="string",example="Another text"),
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
 *     path="/admin/messages/{id}", operationId="AdminMessagesDelete",
 *     tags={"Admin Messages"},
 *     summary="Delete the message resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Message id", required=true,
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
