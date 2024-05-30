<?php

namespace App\Services\User;

/**
 * import models
 */

use App\Models\User\User;

/**
 * import repositories
 */

use App\Repositories\User\UserRepositories;

/**
 * import collection
 */

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserService
{
    protected $userRepositories;

    public function __construct(UserRepositories $userRepositories)
    {
        $this->userRepositories = $userRepositories;
    }

    public function getProfile(User $user)
    {
        return $user;
    }

    public function updateProfile(User $user, array $data)
    {
        return $this->userRepositories->update($user, $data);
    }

    public function searchUser($name)
    {
        return $this->userRepositories->searchByName($name);
    }

    public function getUserProfile($id)
    {
        return $this->userRepositories->find($id);
    }

    public function getFollowers($id)
    {
        return $this->userRepositories->getFollowers($id);
    }

    public function getFollowing($id)
    {
        return $this->userRepositories->getFollowing($id);
    }

    public function followUser(User $userToFollow)
    {
        $followerId = auth()->id();

        // Check if the user is trying to follow themselves
        if ($followerId === $userToFollow->id) {
            return response()->json(['success' => false, 'message' => 'You cannot follow yourself.'], 400);
        }

        // Check if the user already follows the other user
        if ($userToFollow->followers()->where('follower_id', $followerId)->exists()) {
            return response()->json(['success' => false, 'message' => 'You already follow this user.'], 400);
        }

        return $this->userRepositories->follow($followerId, $userToFollow->id);
    }

    public function unfollowUser(User $userToUnfollow)
    {
        $userId = auth()->id();

        // Check if the user is trying to unfollow themselves
        if ($userId === $userToUnfollow->id) {
            return response()->json(['success' => false, 'message' => 'You cannot unfollow yourself.'], 400);
        }

        // Check if the user is not following the user to unfollow
        if (!$userToUnfollow->followers()->where('follower_id', $userId)->exists()) {
            return response()->json(['success' => false, 'message' => 'You are not following this user.'], 400);
        }

        return $this->userRepositories->unfollow($userId, $userToUnfollow->id);
    }
}
