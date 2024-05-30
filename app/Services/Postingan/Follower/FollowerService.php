<?php

namespace App\Services\Postingan\Follower;

/**
 * import models
 */

use App\Models\User\User;

/**
 * import repositories
 */

use App\Repositories\Postingan\Follower\FollowerRepositories;

class FollowerService
{
    protected $followRepository;

    public function __construct(FollowerRepositories $followRepository)
    {
        $this->followRepository = $followRepository;
    }

    public function getFollowers($userId)
    {
        return $this->followRepository->getFollowers($userId);
    }

    public function getFollowing($userId)
    {
        return $this->followRepository->getFollowing($userId);
    }
}
