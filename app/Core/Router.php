<?php

namespace PostsApi\Core;

use FastRoute;

class Router
{
    public static function router()
    {
        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/', [\PostsApi\Controler\PostControler::class, 'showAllPosts']);
            $r->addRoute('GET', '/articles', [\PostsApi\Controler\PostControler::class, 'showAllPosts']);
            $r->addRoute('GET', '/users', [\PostsApi\Controler\PostControler::class, 'showUsers']);

        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                [$controllerName, $methodName] = $handler;

                return (new $controllerName)->{$methodName}();
        }
        return null;
    }
}