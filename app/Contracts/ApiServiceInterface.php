<?php

namespace App\Contracts;

interface ApiServiceInterface
{
    public function createUser(array $data);
    public function getUser(int $id);
    public function getUsers();
    public function createUserPost(int $id, array $data);
    public function getPublicPosts();
    public function getUserPosts(int $id);
    public function createPostComment(int $id, array $data);

    public function deleteComment(int $id);
    public function deletePost(int $id);
}
