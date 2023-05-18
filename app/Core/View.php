<?php

namespace PostsApi\Core;

class View
{
    private array $posts;
    private string $path;

    public function __construct(string $path, array $posts)
    {
        $this->posts = $posts;
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path . '.html.twig';
    }

    public function getPosts(): array
    {
        return $this->posts;
    }
}