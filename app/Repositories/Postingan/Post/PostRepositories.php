<?php

namespace App\Repositories\Postingan\Post;

/**
 * import models
 */

use App\Models\Postingan\Post\Post;
use App\Models\User\User;

class PostRepositories
{
    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update(Post $post, array $data)
    {
        $post->update($data);
        return $post;
    }

    public function getAllPosts(User $user)
    {
        return Post::all();
    }

    public function find($id)
    {
        return Post::findOrFail($id);
    }

    public function getPostsByUserId($userId)
    {
        return Post::where('user_id', $userId)->with('comments', 'likes')->get();
    }
}
