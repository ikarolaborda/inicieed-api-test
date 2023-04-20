<?php

namespace App\Http\Controllers\Api;

use App\Contracts\ApiServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostCommentRequest;
use App\Http\Requests\CreateUserPostRequest;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function __construct(private readonly ApiServiceInterface $apiService)
    {
    }

    public function createUser(CreateUserRequest $request): JsonResponse
    {
        $response = $this->apiService->createUser($request->validated());
        return response()->json($response);
    }

    public function getUser(Request $request, int $id): JsonResponse
    {
        $response = $this->apiService->getUser($id);
        return response()->json($response);
    }

    public function getUsers(Request $request): JsonResponse
    {
        $response = $this->apiService->getUsers();
        return response()->json($response);
    }

    public function getPublicPosts(Request $request): JsonResponse
    {
        $response = $this->apiService->getPublicPosts();
        return response()->json($response);
    }

    public function createUserPost(CreateUserPostRequest $request, int $id): JsonResponse
    {
        $response = $this->apiService->createUserPost($id, $request->validated());
        return response()->json($response);
    }

    public function getUserPosts(Request $request, int $id): JsonResponse
    {
        $response = $this->apiService->getUserPosts($id);
        return response()->json($response);
    }

    public function createPostComment(CreatePostCommentRequest $request, int $id): JsonResponse
    {
        $response = $this->apiService->createPostComment($id, $request->validated());
        return response()->json($response);
    }

    public function deletePost(Request $request, int $id): JsonResponse
    {
        $response = $this->apiService->deletePost($id);
        return response()->json($response);
    }

    public function deleteComment(Request $request, int $id): JsonResponse
    {
        $response = $this->apiService->deleteComment($id);
        return response()->json($response);
    }
}
