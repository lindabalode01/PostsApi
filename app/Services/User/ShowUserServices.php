<?php

namespace PostsApi\Service\User;

use PostsApi\ApiClient;
use PostsApi\Exception\UserNotFound;
use PostsApi\Models\User;

class ShowUserServices
{
private ApiClient $client;
public function __construct()
{
    $this->client = new ApiClient();
}
public function execute(): User
{
    $userId = rand(1,10);
    $users = $this->client->getOneUser($userId);
    if($users == null)
    {
        throw new UserNotFound('User not found');
    }
    return $users;
}
}