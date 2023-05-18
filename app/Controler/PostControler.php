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
    return new View('layout', $this->xlient->fetchAll());
}

}