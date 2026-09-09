<?php

class Router
{
    private $routes = [];

    public function add($method, $path, $handler)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler,
        ];
    }

    public function dispatch($method, $uri)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper($method) && $route['path'] === $uri) {
                [$class, $action] = explode('@', $route['handler']);
                $controller = new $class();
                return $controller->$action();
            }
        }

        http_response_code(404);
        echo '404 - Página no encontrada';
    }
}
