<?php

/**
 * @OA\Info(
 *     title="HISTRF Swagger API documentation",
 *     version="1.0.0",
 *
 * )
 * @OA\Server(
 *     description="Local API server",
 *     url=L5_SWAGGER_LOCAL_SERVER
 * )
 * @OA\Server(
 *     description="DEV API server",
 *     url=L5_SWAGGER_DEV_SERVER
 * )
 * @OA\SecurityScheme(
 *      securityScheme="bearer",
 *      in="header",
 *      name="Authorization",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * )
 * @OA\ExternalDocumentation(
 *     description="Find out more about Swagger",
 *     url="http://swagger.io"
 * )
 */


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
 *     path="/me",
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


