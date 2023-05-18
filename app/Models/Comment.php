<?php

namespace PostsApi\Models;

class Comment
{
    private string $postId;
    private string $id;
    private string $name;
    private string $email;
    private string $body;

    public function __construct(
        string $postId,
        string $id,
        string $name,
        string $email,
        string $body
    )
    {
        $this->postId = $postId;
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->body = $body;
    }

    public function getPostId(): string
    {
        return $this->postId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBody(): string
    {
        return $this->body;
    }

}