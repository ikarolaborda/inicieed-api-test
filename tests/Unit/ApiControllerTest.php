<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\CreateUserPostRequest;
use App\Http\Requests\CreatePostCommentRequest;
use App\Contracts\ApiServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ApiControllerTest extends TestCase
{
    use WithFaker;
    private MockObject|ApiServiceInterface $apiServiceMock;

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->apiServiceMock = $this->createMock(ApiServiceInterface::class);
    }

    public function testCreateUser()
    {
        $requestMock = $this->createMock(CreateUserRequest::class);
        $requestMock->expects($this->once())
            ->method('validated')
            ->willReturn([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'gender' => 'male',
                'status' => 'active',
            ]);

        $this->apiServiceMock->expects($this->once())
            ->method('createUser')
            ->willReturn([
                'code' => 201,
                'meta' => null,
                'data' => [
                    'id' => 1,
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'gender' => 'male',
                    'status' => 'active',
                ],
            ]);

        $controller = new ApiController($this->apiServiceMock);
        $response = $controller->createUser($requestMock);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetUser()
    {
        $requestMock = $this->createMock(Request::class);

        $this->apiServiceMock->expects($this->once())
            ->method('getUser')
            ->willReturn([
                'code' => 200,
                'meta' => null,
                'data' => [
                    'id' => 1,
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'gender' => 'male',
                    'status' => 'active',
                ],
            ]);

        $controller = new ApiController($this->apiServiceMock);
        $response = $controller->getUser($requestMock, 1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCreateUserPost()
    {
        $requestMock = $this->createMock(CreateUserPostRequest::class);
        $requestMock->expects($this->once())
            ->method('validated')
            ->willReturn([
                'user_id' => 1,
                'title' => 'Example Post',
                'body' => 'This is an example post.',
            ]);

        $this->apiServiceMock->expects($this->once())
            ->method('createUserPost')
            ->willReturn([
                'code' => 201,
                'meta' => null,
                'data' => [
                    'id' => 1,
                    'user_id' => 1,
                    'title' => 'Example Post',
                    'body' => 'This is an example post.',
                ],
            ]);

        $controller = new ApiController($this->apiServiceMock);
        $response = $controller->createUserPost($requestMock, 1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetUserPosts()
    {
        $requestMock = $this->createMock(Request::class);

        $this->apiServiceMock->expects($this->once())
            ->method('getUserPosts')
            ->willReturn([
                'code' => 200,
                'meta' => null,
                'data' => [
                    [
                        'id' => 1,
                        'user_id' => 1,
                        'title' => 'Example Post',
                        'body' => 'This is an example post.',
                    ],
                ],
            ]);

        $controller = new ApiController($this->apiServiceMock);
        $response = $controller->getUserPosts($requestMock, 1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCreatePostComment()
    {
        $requestMock = $this->createMock(CreatePostCommentRequest::class);
        $requestMock->expects($this->once())
            ->method('validated')
            ->willReturn([
                'post_id' => 1,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'body' => 'This is an example comment.',
            ]);

        $this->apiServiceMock->expects($this->once())
            ->method('createPostComment')
            ->willReturn([
                'code' => 201,
                'meta' => null,
                'data' => [
                    'id' => 1,
                    'post_id' => 1,
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'body' => 'This is an example comment.',
                ],
            ]);

        $controller = new ApiController($this->apiServiceMock);
        $response = $controller->createPostComment($requestMock, 1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCreateAndDeleteComment()
    {
        // Este test é um e2e, mas, pela complexidade da aplicação, decidi coloca-lo aqui.
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'gender' => 'male',
            'status' => 'active',
        ];

        $userResponse = $this->postJson('/api/users', $userData);
        $userResponse->assertStatus(200);
        $userId = $userResponse->json('id');

        $postData = [
            'user_id' => $userId,
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ];

        $postResponse = $this->postJson("/api/users/{$userId}/posts", $postData);
        $postResponse->assertStatus(200);
        $postId = $postResponse->json('id');

        $commentData = [
            'post_id' => $postId,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'body' => $this->faker->paragraph,
        ];

        $commentResponse = $this->postJson("/api/posts/{$postId}/comments", $commentData);
        $commentResponse->assertStatus(200);
        $commentId = $commentResponse->json('id');

        $deleteCommentResponse = $this->deleteJson("/api/comments/{$commentId}");
        $deleteCommentResponse->assertStatus(200);
    }
}
