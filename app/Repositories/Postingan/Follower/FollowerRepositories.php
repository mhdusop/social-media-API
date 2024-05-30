<?php

namespace App\Repositories\Postingan\Follower;

/**
 * import models
 */

use App\Models\Postingan\Follower\Follower;
use App\Models\User\User;

class FollowerRepositories
{
    public function follow(User $user, $userId)
    {
        Follower::create([
            'follower_id' => $user->id,
            'followed_id' => $userId,
        ]);
    }

    public function unfollow(User $user, $userId)
    {
        Follower::where('follower_id', $user->id)
            ->where('followed_id', $userId)
            ->delete();
    }

    public function getFollowers($userId)
    {
        return User::findOrFail($userId)->followers()->get();
    }

    public function getFollowing($userId)
    {
        return User::findOrFail($userId)->following()->get();
    }
}
