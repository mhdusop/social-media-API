<?php

namespace App\Repositories\User;

/**
 * import models
 */

use App\Models\User\User;

class UserRepositories
{
    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    public function searchByName($name)
    {
        return User::where('name', 'like', "%{$name}%")->get();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function getFollowers($id)
    {
        return User::findOrFail($id)->followers;
    }

    public function getFollowing($id)
    {
        return User::findOrFail($id)->following;
    }

    public function follow($followerId, $userId)
    {
        $user = User::findOrFail($userId);
        $user->followers()->attach($followerId);
    }

    public function unfollow($followerId, $userId)
    {
        $user = User::findOrFail($userId);
        $user->followers()->detach($followerId);
    }
}
