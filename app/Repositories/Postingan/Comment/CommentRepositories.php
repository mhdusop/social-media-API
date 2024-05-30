<?php

namespace App\Repositories\Postingan\Comment;

/**
 * import models
 */

use App\Models\Postingan\Comment\Comment;

class CommentRepositories
{
    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function find($id)
    {
        return Comment::findOrFail($id);
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
    }
}
