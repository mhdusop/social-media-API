<?php

namespace App\Repositories\Postingan\Like;

/**
 * import models
 */

use App\Models\Postingan\Like\Like;
use App\Models\User\User;

class LikeRepositories
{
    public function like($postId, User $user)
    {
        // Check if the user has already liked the post
        $existingLike = Like::where('post_id', $postId)
            ->where('user_id', $user->id)
            ->first();

        if ($existingLike) {
            return false;
        }

        Like::create([
            'post_id' => $postId,
            'user_id' => $user->id,
        ]);

        return true;
    }

    public function unlike($postId, User $user)
    {
        $like = Like::where('post_id', $postId)->where('user_id', $user->id)->first();

        if (!$like) {
            return true;
        }

        $like->delete();
    }

    public function getLikedPosts(User $user)
    {
        return $user->likedPosts()->with('user')->get();
    }
}
