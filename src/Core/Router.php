<?php

namespace Core;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'PATCH' => [],
        'DELETE' => [],
    ];
    public function get($uri, $controller): void
    {
       $this->add('GET', $uri, $controller);
    }
    public function post($uri, $controller): void
    {
        $this->add('POST', $uri, $controller);
    }
    public function put($uri, $controller): void
    {
        $this->add('PUT', $uri, $controller);
    }
    public function patch($uri, $controller): void
    {
        $this->add('PATCH', $uri, $controller);
    }
    public function delete($uri, $controller): void
    {
        $this->add('DELETE', $uri, $controller);
    }
    private function add($method, $uri, $controller): void
    {
        $this->routes[$method][$uri] = $controller;
    }
    public function route($uri, $method = "GET")
    {
        foreach ($this->routes[$method] as $route => $controller) {
            if ($uri === $route) {
                include view("partials/nav.php");
                include view("partials/banner.php");
                include base_path($controller);
                return true;
            }
        }
        $this->abort();
        return  false;
    }
    public function abort($status = 404)
    {
        http_response_code($status);
        include view("404.php");
        die();
    }
}
