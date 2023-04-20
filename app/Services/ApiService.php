<?php

namespace App\Services;

use App\Contracts\ApiServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ApiService implements ApiServiceInterface
{

    public ?string $baseUrl;
    public ?string $accessToken;
    public function __construct()
    {
        $this->baseUrl = env('GOREST_API_URL');
        $this->accessToken = env('GOREST_ACCESS_TOKEN');
    }

    private function requestHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->accessToken,
        ];
    }

    public function createUser(array $data): array
    {
        $response = Http::withHeaders($this->requestHeaders())->post("{$this->baseUrl}/users", $data);
        return $response->json();
    }

    public function getUser(int $id): array
    {
        $response = Http::withHeaders($this->requestHeaders())->get("{$this->baseUrl}/users/{$id}");
        return $response->json();
    }

    public function createUserPost(int $id, array $data): array
    {
        $response = Http::withHeaders($this->requestHeaders())->post("{$this->baseUrl}/users/{$id}/posts", $data);
        return $response->json();
    }

    public function getUserPosts(int $id): array
    {
        $response = Http::withHeaders($this->requestHeaders())->get("{$this->baseUrl}/users/{$id}/posts");
        return $response->json();
    }

    public function createPostComment(int $id, array $data): array
    {
        $response = Http::withHeaders($this->requestHeaders())->post("{$this->baseUrl}/posts/{$id}/comments", $data);
        return $response->json();
    }

    public function getUsers(): array
    {
        $response = Http::withHeaders($this->requestHeaders())->get("{$this->baseUrl}/users");
        return $response->json();
    }

    public function getPublicPosts(): array
    {
        $response = Http::withHeaders($this->requestHeaders())->get("{$this->baseUrl}/posts");
        return $response->json();
    }

    public function deletePost(int $id): array | null | JsonResponse
    {
        $response = Http::withHeaders($this->requestHeaders())->delete("{$this->baseUrl}/posts/{$id}");
        return $response->json();
    }

    public function deleteComment(int $id): array | null | JsonResponse
    {
        $response = Http::withHeaders($this->requestHeaders())->delete("{$this->baseUrl}/comments/{$id}");
        return $response->json();
    }

}
