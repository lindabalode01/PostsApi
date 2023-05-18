<?php
require_once '../vendor/autoload.php';

$response = \PostsApi\Core\Router::router();
$twig = new \PostsApi\Core\TwigRender();

echo $twig->render($response);
