<?php

namespace App\Http\Controllers\Api\Postingan\Comment;

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\Postingan\Comment\CreateCommentRequest;

/**
 * import resource
 */

use App\Http\Resources\Postingan\Comment\CommentResource;

/**
 * import service
 */

use App\Services\Postingan\Comment\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function addComment(CreateCommentRequest $request, $postId)
    {
        $addComment = $this->commentService->addComment($request->user(), $postId, $request->validated());
        return new CommentResource(true, 'Comment Added', $addComment);
    }

    public function deleteComment($id)
    {
        $deleteComment = $this->commentService->deleteComment($id);
        return new CommentResource(true, 'Comment Deleted', $deleteComment);
    }
}
