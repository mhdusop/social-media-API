<?php

namespace App\Http\Controllers\Api\User;

/**
 * import collection
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Resources\User\UserResource;
use App\Models\User\User;

/**
 * import service
 */

use App\Services\User\UserService;

use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function profile(Request $request)
    {
        $user = $this->userService->getProfile($request->user());
        return new UserResource(true, 'Profile retrieved successfully', $user);
    }

    public function updateProfile(Request $request)
    {
        $updatedUser = $this->userService->updateProfile($request->user(), $request->all());
        return new UserResource(true, 'Profile Updated', $updatedUser);
    }

    public function searchUser($name)
    {
        $searchUser = $this->userService->searchUser($name);
        return new UserResource(true, 'Success', $searchUser);
    }

    public function getUserProfile($id)
    {
        $user = $this->userService->getUserProfile($id);
        return new UserResource(true, 'Profile retrieved successfully', $user);
    }

    public function getFollowers($id)
    {
        $followers = $this->userService->getFollowers($id);
        return new UserResource(true, 'Follower retrieved successfully', $followers);
    }

    public function getFollowing($id)
    {
        $following = $this->userService->getFollowing($id);
        return new UserResource(true, 'Following retrieved successfully', $following);
    }

    public function followUser($id)
    {
        $followerId = auth()->id();

        // Check if the user is trying to follow themselves
        if ($followerId == $id) {
            return response()->json(['success' => false, 'message' => 'You cannot follow yourself.'], 400);
        }

        $userToFollow = User::findOrFail($id);

        // Check if the follower already follows the user
        if ($userToFollow->followers()->where('follower_id', $followerId)->exists()) {
            return response()->json(['success' => false, 'message' => 'You already follow this user.'], 400);
        }

        $follow = $this->userService->followUser($userToFollow);

        return new UserResource(true, 'Success Following', $follow);
    }

    public function unfollowUser($id)
    {
        $userId = auth()->id();

        // Check if the user is trying to unfollow themselves
        if ($userId == $id) {
            return response()->json(['success' => false, 'message' => 'You cannot unfollow yourself.'], 400);
        }

        $userToUnfollow = User::findOrFail($id);

        // Check if the user is not following the user to unfollow
        if (!$userToUnfollow->followers()->where('follower_id', $userId)->exists()) {
            return response()->json(['success' => false, 'message' => 'You are not following this user.'], 400);
        }

        $unfollow = $this->userService->unfollowUser($userToUnfollow);

        return new UserResource(true, 'Success Unfollow', $unfollow);
    }
}
