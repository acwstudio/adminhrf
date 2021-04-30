<?php

/**
 *  @OA\Get(
 *      path="/admin/cities", operationId="AdminCitiesIndex",
 *      tags={"Admin Cities"},
 *      summary="Fetches cities collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=events",
 *          @OA\Schema(
 *              type="string",
 *              enum={"events"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=name (-name)",
 *          @OA\Schema(
 *              type="string", enum={"id", "name"}
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
 *      path="/admin/cities/{id}", operationId="AdminCitiesShow",
 *     tags={"Admin Cities"},
 *      summary="Fetches the city resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="City id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=events",
 *          @OA\Schema(
 *              type="string",
 *              enum={"events"}
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
 *      path="/admin/cities", operationId="AdminCitiesCreate",
 *     tags={"Admin Cities"},
 *      summary="Create a new city resource",
 *
 *      @OA\RequestBody(required=true, description="Pass city properties",
 *          @OA\JsonContent(required={"name"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="cities"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="name",type="string",example="New City"),
 *                  ),
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
 *      path="/admin/cities/{id}", operationId="AdminCitiesUpdate",
 *      tags={"Admin Cities"},
 *      summary="Update the city resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="City id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass city properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="cities"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="name",type="string",example="Another City"),
 *                  ),
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
 *     path="/admin/cities/{id}", operationId="AdminCitiesDelete",
 *     tags={"Admin Cities"},
 *     summary="Delete the city resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="City id", required=true,
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


