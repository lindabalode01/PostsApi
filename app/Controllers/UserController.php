<?php

namespace PostsApi\Controllers;

use PostsApi\Core\View;
use PostsApi\Services\User\IndexUser;

class UserController
{

    public function showUsers(): View
    {
        $users = (new IndexUser())->execute();
        return new View('users', ['index' => $users]);
    }
}