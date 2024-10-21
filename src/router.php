<?php
const BASE_PATH = __DIR__ . "/../";
$routes = include_once base_path("routes.php");
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri)['path'] ?? "/";

function routeToController($path, $routes): void
{
    // Include the route-specific content here
    include view("partials/nav.php");
    include view("partials/banner.php");
    include $routes[$path];
}


function abort($status = 404): void
{
    http_response_code($status);
    include view("404.php");
    die();
}
