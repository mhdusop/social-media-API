<?php

namespace App\Services\Postingan\Post;

/**
 * import models
 */

use App\Models\User\User;

/**
 * import repositories
 */

use App\Repositories\Postingan\Post\PostRepositories;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepositories $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function addPost(User $user, array $data)
    {
        $data['user_id'] = $user->id;
        return $this->postRepository->create($data);
    }

    public function editPost(User $user, $id, array $data)
    {
        $post = $this->postRepository->find($id);

        if ($post->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return $this->postRepository->update($post, $data);
    }

    public function getAllPosts(User $user)
    {
        return $this->postRepository->getAllPosts($user);
    }

    public function getPostById($id)
    {
        return $this->postRepository->find($id);
    }

    public function getPostsByUserId($userId)
    {
        return $this->postRepository->getPostsByUserId($userId);
    }
}
