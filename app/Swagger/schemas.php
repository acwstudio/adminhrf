<?php

/**
 * @OA\Schema(
 *     schema="ErrorModel",
 *     @OA\Property(
 *         property="code",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="message",
 *         type="string"
 *     )
 * )
 */


/**
 * @OA\Schema(
 *     schema="CommentAdd",
 *     description="data to create new comment",
 *     type="object",
 *     required={"type", "text","commentable_type","commentable_id"},
 *     @OA\Property(
 *          property="type",
 *          description="comment or review",
 *          type="string"
 *      ),
 *     @OA\Property(
 *          property="text",
 *          description="comment text",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="commentable_type",
 *          description="type of commentable model",
 *          type="string"
 *
 *     ),
 *      @OA\Property(
 *          property="commentable_id",
 *          description="id of commentable model",
 *          type="integer"
 *     ),
 *      @OA\Property(
 *          property="parent_id",
 *          description="id of parent comment",
 *          type="integer"
 *     ),
 *      @OA\Property(
 *          property="answer_to",
 *          description="reply to data",
 *          type="object",
 *          @OA\Property(
 *              property="user_id",
 *              description="user id we reply to",
 *              type="integer"
 *          ),
 *          @OA\Property(
 *              property="comment_id",
 *              description="comment id we reply to",
 *              type="integer"
 *          ),
 *     ),
 *     @OA\Property(
 *          property="estimate",
 *          description="review estimate",
 *          type="string"
 *      ),
 * )
 */
