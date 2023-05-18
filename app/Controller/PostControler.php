<?php

namespace PostsApi\Controler;

use PostsApi\ApiClient;
use PostsApi\Core\View;

class PostControler
{
    private ApiClient $xlient;

    private function __construct()
    {
        $this->xlient = new ApiClient();
    }

    public function showAllPosts(): View
    {
        return new View('article', ['articles' => $this->xlient->fetchAll()]);
    }

    public function showUsers(): View
    {
        return new View('users', ['users' => $this->xlient->getUsers()]);
    }

}