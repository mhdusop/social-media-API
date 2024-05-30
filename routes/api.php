<?php

/**
 * Import controller
 */

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Postingan\Comment\CommentController;
use App\Http\Controllers\Api\Postingan\Follower\FollowerController;
use App\Http\Controllers\Api\Postingan\Like\LikeController;
use App\Http\Controllers\Api\Postingan\Post\PostController;
use App\Http\Controllers\Api\User\UserController;

use Illuminate\Support\Facades\Route;


/**
 * Api V1
 */
Route::prefix('v1')->group(function () {
    // Auth Routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        // User Profile Routes
        Route::get('/get/profile', [UserController::class, 'profile']);
        Route::get('/get/profile/{id}', [UserController::class, 'getUserProfile']);
        Route::put('/update/profile', [UserController::class, 'updateProfile']);

        // User Search Routes
        Route::get('/get/user/{name}', [UserController::class, 'searchUser']);

        // User Followers and Following Routes
        Route::get('/get/user/{id}/followers', [FollowerController::class, 'getFollowers']);
        Route::get('/get/user/{id}/following', [FollowerController::class, 'getFollowing']);

        // User Follow/Unfollow Routes
        Route::post('/user/{id}/follow', [UserController::class, 'followUser']);
        Route::post('/user/{id}/unfollow', [UserController::class, 'unfollowUser']);

        // Post Routes
        Route::post('/create/posts', [PostController::class, 'addPost']);
        Route::post('/update/posts/{id}', [PostController::class, 'editPost']);
        Route::get('/get/posts', [PostController::class, 'getAllPosts']);
        Route::get('/get/posts/{id}', [PostController::class, 'getPostById']);
        Route::get('/get/posts/user/{userId}', [PostController::class, 'getPostsByUserId']);

        // Like/Unlike Post Routes
        Route::post('/posts/{postId}/like', [LikeController::class, 'likePost']);
        Route::post('/posts/{postId}/unlike', [LikeController::class, 'unlikePost']);

        // Get My Liked Posts Route
        Route::get('/get/liked/posts', [LikeController::class, 'getMyLikedPosts']);

        // Comment Routes
        Route::post('/create/posts/{postId}/comments', [CommentController::class, 'addComment']);
        Route::delete('/delete/comment/{id}', [CommentController::class, 'deleteComment']);
    });
});
