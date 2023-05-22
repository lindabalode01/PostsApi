<?php

namespace PostsApi\Controllers;

use PostsApi\Core\View;
use PostsApi\Services\Article\ShowArticles;

class ArticleController
{
    public function showAllPosts(): View
    {
        $articles = (new ShowArticles())->execute();
        return new View('article', ['articles' => $articles]);
    }

}