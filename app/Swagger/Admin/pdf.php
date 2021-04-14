<?php


/**
 * @OA\Post(
 *     path="/admin/documents/pdf",
 *     operationId="AdminDocumentsPdfStore",
 *     tags={"Admin Pdf"},
 *     summary="Add admin pdf document",
 *
 *     @OA\RequestBody(
 *         description="pdf file",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *              required={"file"},
 *                  @OA\Property(property="file", type="file"),
 *             ),
 *
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="201",
 *         description="Created"
 *     ),
 *      @OA\Response(
 *         response="403",
 *         description="Unauthenticated"
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="unexpected error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 * )
 */

/**
 * @OA\Post(
 *     path="/admin/documents/pdf/{id}",
 *     operationId="AdminDocumentsPdfUpdate",
 *     tags={"Admin Pdf"},
 *     summary="Update admin pdf document",
 *
 *      @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Document id",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ),
 *
 *     @OA\RequestBody(
 *         description="pdf file",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *              required={"file"},
 *                  @OA\Property(property="file", type="file"),
 *             ),
 *
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="201",
 *         description="Created"
 *     ),
 *      @OA\Response(
 *         response="403",
 *         description="Unauthenticated"
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="unexpected error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 * )
 */
