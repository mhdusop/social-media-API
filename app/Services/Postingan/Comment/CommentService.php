<?php

namespace App\Services\Postingan\Comment;

/**
 * import models
 */

use App\Models\User\User;

/**
 * import repositories
 */

use App\Repositories\Postingan\Comment\CommentRepositories;

/**
 * import collection
 */

use Illuminate\Support\Facades\Auth;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepositories $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function addComment(User $user, $postId, array $data)
    {
        $data['user_id'] = $user->id;
        $data['post_id'] = $postId;
        return $this->commentRepository->create($data);
    }

    public function deleteComment($id)
    {
        $comment = $this->commentRepository->find($id);

        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return $this->commentRepository->delete($comment);
    }
}
