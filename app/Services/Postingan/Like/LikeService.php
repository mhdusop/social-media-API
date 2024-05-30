<?php

namespace App\Services\Postingan\Like;

/**
 * import models
 */

use App\Models\User\User;

/**
 * import repositories
 */

use App\Repositories\Postingan\Like\LikeRepositories;

class LikeService
{
    protected $likeRepository;

    public function __construct(LikeRepositories $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function likePost($postId, User $user)
    {
        return $this->likeRepository->like($postId, $user);
    }

    public function unlikePost($postId, User $user)
    {
        return $this->likeRepository->unlike($postId, $user);
    }

    public function getMyLikedPosts(User $user)
    {
        return $this->likeRepository->getLikedPosts($user);
    }
}
