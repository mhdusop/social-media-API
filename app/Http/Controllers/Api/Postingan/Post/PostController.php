<?php

namespace App\Http\Controllers\Api\Postingan\Post;

/**
 * import collection
 */

use App\Http\Controllers\Controller;

/**
 * import service
 */

use App\Services\Postingan\Post\PostService;

/**
 * import form request
 */

use App\Http\Requests\Postingan\Post\CreatePostRequest;
use App\Http\Requests\Postingan\Post\UpdatePostRequest;

/**
 * import resource
 */

use App\Http\Resources\Postingan\Post\PostResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function addPost(CreatePostRequest $request)
    {
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');
                $images[] = $path;
            }
        }

        $data = $request->validated();
        $data['images'] = $images;

        $addPost = $this->postService->addPost($request->user(), $data);
        return new PostResource(true, 'Post Created', $addPost);
    }

    public function editPost(UpdatePostRequest $request, $id)
    {
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');
                $images[] = $path;
            }
        }

        $data = $request->validated();
        $data['images'] = $images;

        $editPost = $this->postService->editPost($request->user(), $id, $data);
        return new PostResource(true, 'Post Edited', $editPost);
    }

    public function getAllPosts(Request $request)
    {
        $posts = $this->postService->getAllPosts($request->user());
        return new PostResource(true, 'Success', $posts);
    }

    public function getPostById($id)
    {
        $getPostById = $this->postService->getPostById($id);
        return new PostResource(true, 'Success', $getPostById);
    }

    public function getPostsByUserId($userId)
    {
        $posts = $this->postService->getPostsByUserId($userId);
        return new PostResource(true, 'Success', $posts);
    }
}
