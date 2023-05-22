<?php

namespace PostsApi\Services\User;

use PostsApi\ApiClient;

class IndexUser
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }
    public function execute():array
    {
        return $this->client->getUsers();
    }
}