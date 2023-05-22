<?php
namespace PostsApi\Services\Article;
use PostsApi\ApiClient;

class ShowArticles
{
    private ApiClient $client;
    public function __construct()
    {
        $this->client = new ApiClient();
    }
    public function execute():array
    {
        return $this->client->fetchAll();
    }
}