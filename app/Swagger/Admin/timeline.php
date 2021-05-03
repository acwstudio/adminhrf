<?php

/**
 *  @OA\Get(
 *      path="/admin/timelines", operationId="AdminTimelinesIndex",
 *      tags={"Admin Timelines"},
 *      summary="Fetches timelines collection",
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=timelinable",
 *          @OA\Schema(
 *              type="string",
 *              enum={"timelinable"}
 *          )
 *      ),
 *
 *      @OA\Parameter(
 *          name="sort", in="query", description="Sorts by field", required=false,
 *          example="?sort=date (-date)",
 *          @OA\Schema(
 *              type="string", enum={"id", "timelinable_type","date"}
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
 *      path="/admin/timelines/{id}", operationId="AdminTimelinesShow",
 *     tags={"Admin Timelines"},
 *      summary="Fetches the timeline resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Timeline id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\Parameter(
 *          name="include", in="query", description="Includes related models", required=false,
 *          example="?include=timelinable",
 *          @OA\Schema(
 *              type="string",
 *              enum={"timelinable"}
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
 *      path="/admin/timelines", operationId="AdminTimelinesCreate",
 *     tags={"Admin Timelines"},
 *      summary="Create a new timeline resource",
 *
 *      @OA\RequestBody(required=true, description="Pass timelines properties",
 *          @OA\JsonContent(required={"active","timelinable_type","timelinable_id","date"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="type", type="string", example="timelines"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="active",type="boolean",example=true),
 *                      @OA\Property(property="data",type="string",example="2012-10-01"),
 *                      @OA\Property(property="timelinable_id",type="integer",example="3"),
 *                      @OA\Property(property="timelinable_type",type="string",example="article"),
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
 *      path="/admin/timelines/{id}", operationId="AdminTestTimelinesUpdate",
 *      tags={"Admin Timelines"},
 *      summary="Update the timeline resource",
 *
 *      @OA\Parameter(
 *          name="id", in="path", description="Timeline id", required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *
 *      @OA\RequestBody(required=true, description="Pass timeline properties",
 *          @OA\JsonContent(required={"type", "id"},
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=5),
 *                  @OA\Property(property="type", type="string", example="timelines"),
 *                  @OA\Property(property="attributes", type="object",
 *                      @OA\Property(property="active",type="boolean",example=false),
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
 *     path="/admin/timelines/{id}", operationId="AdminTimelinesDelete",
 *     tags={"Admin Timelines"},
 *     summary="Delete the timeline resource",
 *
 *     @OA\Parameter(
 *          name="id", in="path", description="Timeline id", required=true,
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

