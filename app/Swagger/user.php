<?php



/**
 * @OA\Post(
 *     path="/token",
 *     operationId="getToken",
 *     tags={"Auth"},
 *     summary="Issue bearer token for user",
 *
 *     @OA\RequestBody(
 *         description="Credentials required for token issue",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                  required={"email","password","device_name"},
 *                  @OA\Property(property="email", type="string"),
 *                  @OA\Property(property="password", type="string"),
 *                  @OA\Property(property="device_name", type="string"),
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="200",
 *         description="Token issued",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                  required={"token"},
 *                  @OA\Property(property="token", type="string"),
 *             )
 *
 *         )
 *     ),
 *     @OA\Response(
 *         response="422",
 *         description="Bad credentials"
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="unexpected error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
 *     )
 * )
 */

/**
 * @OA\Get(
 *     path="/profile",
 *     operationId="user",
 *     tags={"User"},
 *     summary="Return logged in user",
 *
 *     @OA\Response(
 *         response="200",
 *         description="Everything is fine",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *     @OA\Response(
 *         response="401",
 *         description="Unauthorized",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 *
 * )
 */

/**
 * @OA\Post(
 *     path="/profile",
 *     operationId="profileUpdate",
 *     tags={"User"},
 *     summary="Update user info",
 *
 *     @OA\RequestBody(
 *         description="Credentials",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                  required={"name"},
 *                  @OA\Property(property="name", type="string"),
 *                  @OA\Property(property="current_password", type="string"),
 *                  @OA\Property(property="password", type="string"),
 *                  @OA\Property(property="password_confirmation", type="string"),
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="200",
 *         description="Password reset"
 *     ),
 *     @OA\Response(
 *         response="422",
 *         description="Bad credentials"
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
*     path="/register",
*     operationId="registerUser",
*     tags={"User"},
*     summary="Register new user",
*
*     @OA\RequestBody(
*         description="Credentials to create new user",
*         required=true,
*         @OA\MediaType(
*             mediaType="multipart/form-data",
*             @OA\Schema(
*                  required={"name","email","password","password_confirmation"},
*                  @OA\Property(property="name", type="string"),
*                  @OA\Property(property="email", type="string"),
*                  @OA\Property(property="password", type="string"),
*                  @OA\Property(property="password_confirmation", type="string"),
*             )
*         )
*     ),
*
*     @OA\Response(
*         response="201",
*         description="Created"
*     ),
*     @OA\Response(
*         response="default",
*         description="unexpected error",
*         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
*     )
* )
*/

/**
* @OA\Post(
*     path="/forgot-password",
*     operationId="sendPasswordResetLink",
*     tags={"User"},
*     summary="Send password reset link to user",
*
*     @OA\RequestBody(
*         description="User email to send password reset link",
*         required=true,
*         @OA\MediaType(
*             mediaType="multipart/form-data",
*             @OA\Schema(
*                  required={"email"},
*                  @OA\Property(property="email", type="string"),
*             )
*         )
*     ),
*
*     @OA\Response(
*         response="200",
*         description="Email sent"
*     ),
 *     @OA\Response(
 *         response="422",
 *         description="Bad credentials"
 *     ),
*     @OA\Response(
*         response="default",
*         description="unexpected error",
*         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
*     )
* )
*/

/**
* @OA\Post(
*     path="/reset-password",
*     operationId="passwordReset",
*     tags={"User"},
*     summary="Reset user password",
*
*     @OA\RequestBody(
*         description="Credentials to reset user password",
*         required=true,
*         @OA\MediaType(
*             mediaType="multipart/form-data",
*             @OA\Schema(
*                  required={"token","email","password","password_confirmation"},
*                  @OA\Property(property="token", type="string"),
*                  @OA\Property(property="email", type="string"),
*                  @OA\Property(property="password", type="string"),
*                  @OA\Property(property="password_confirmation", type="string"),
*             )
*         )
*     ),
*
*     @OA\Response(
*         response="200",
*         description="Password reset"
*     ),
*     @OA\Response(
*         response="422",
*         description="Bad credentials"
*     ),
*     @OA\Response(
*         response="default",
*         description="unexpected error",
*         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
*     )
* )
*/

/**
 * @OA\Post(
 *     path="/avatar",
 *     operationId="updateAvatar",
 *     tags={"User"},
 *     summary="Add or update user avatar",
 *
 *     @OA\RequestBody(
 *         description="user avatar",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                  required={"file"},
 *                  @OA\Property(property="file", type="file"),
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="201",
 *         description="Created"
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
 * @OA\Delete(
 *     path="/avatar",
 *     operationId="deleteAvatar",
 *     tags={"User"},
 *     summary="Delete user avatar",
 *
 *
 *     @OA\Response(
 *         response="204",
 *         description="Everything is fine",
 *
 *     ),
 *     @OA\Response(
 *         response="403",
 *         description="No permissions to delete resource",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="default",
 *         description="unexpected error",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 *
 * )
 */

/**
 * @OA\Get(
 *     path="/profile/comments",
 *     operationId="userCommentsList",
 *     tags={"User"},
 *     summary="Display paginated listing of user comments",
 *
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="The page number",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         description="Number of items per page",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="sort_by",
 *         in="query",
 *         description="Sort by parameter",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             enum={"popular"}
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Everything is fine",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *         )
 *     ),
 *
 *     security={
 *         {"bearer": {}}
 *     }
 * )



/**
 * @OA\Post(
 *     path="/email/verification-notification",
 *     operationId="sendEmailVerificationLink",
 *     tags={"Email"},
 *     summary="Send email verification notification",
 *
 *     @OA\RequestBody(
 *         description="Credentials to create new user",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                  required={"email"},
 *                  @OA\Property(property="email", type="string"),
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="202",
 *         description="Email sent"
 *     ),
 *     @OA\Response(
 *         response="204",
 *         description="Email already confirmed"
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


