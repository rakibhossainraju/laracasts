<?php 

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri)['path'] ?? "/";
$routes = [
    "/" => "./controllers/home.php",
    "/home" => "./controllers/home.php",
    "/about" => "./controllers/about.php",
    "/contact" => "./controllers/contact.php",
    "/notes" => "./controllers/notes.php",
];

function routeToController($path, $routes) 
{
    // Include the route-specific content here
    include "./views/partials/nav.php";
    include "./views/partials/banner.php";
    include $routes[$path];
}


function abort($status = 404)
{
    http_response_code($status);
    include "./views/404.php";
    die();
}
