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
