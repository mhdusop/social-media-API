<?php

namespace App\Http\Controllers\Api\Postingan\Like;

use App\Http\Controllers\Controller;

/**
 * import resource
 */

use App\Http\Resources\Postingan\Like\LikeResource;

/**
 * import service
 */

use App\Services\Postingan\Like\LikeService;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function likePost(Request $request, $postId)
    {
        $user = $request->user();
        $like = $this->likeService->likePost($postId, $user);

        if ($like == false) {
            return new LikeResource(false, 'You have already liked this post.', null);
        }

        return new LikeResource(true, 'Success Liked', null);
    }

    public function unlikePost(Request $request, $postId)
    {
        $user = $request->user();
        $unlike = $this->likeService->unlikePost($postId, $user);

        return new LikeResource(true, 'Success Unliked', $unlike);
    }

    public function getMyLikedPosts(Request $request)
    {
        $user = $request->user();
        $likedPosts = $this->likeService->getMyLikedPosts($user);
        return new LikeResource(true, 'Success', $likedPosts);
    }
}
