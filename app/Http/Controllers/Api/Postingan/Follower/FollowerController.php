<?php

namespace App\Http\Controllers\Api\Postingan\Follower;

use App\Http\Controllers\Controller;

/**
 * import resource
 */

use App\Http\Resources\Postingan\Follower\FollowerResource;

/**
 * import service
 */

use App\Services\Postingan\Follower\FollowerService;

use Illuminate\Http\Request;

class FollowerController extends Controller
{
    protected $followService;

    public function __construct(FollowerService $followService)
    {
        $this->followService = $followService;
    }

    public function getFollowers($userId)
    {
        $getFollowers = $this->followService->getFollowers($userId);
        return new FollowerResource(true, 'Succcess', $getFollowers);
    }

    public function getFollowing($userId)
    {
        $getFollowing = $this->followService->getFollowing($userId);
        return new FollowerResource(true, 'Succcess', $getFollowing);
    }
}
