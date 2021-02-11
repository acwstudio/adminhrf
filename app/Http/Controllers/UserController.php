<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{

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
     * )
     *
     * Return logged in user
     *
     * @param Request $request
     * @return UserResource
     */

    public function me(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
