<?php 

include "./helper/util.php";
include "./views/partials/hade.php";

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri)['path'] ?? "/";
$routes = [
    "/" => "./controllers/home.php",
    "/home" => "./controllers/home.php",
    "/about" => "./controllers/about.php",
    "/contact" => "./controllers/contact.php",
    "404" => "./views/404.php",
];


if(array_key_exists($path, $routes)) {
    // Include the route-specific content here
    include "./views/partials/nav.php";
    include "./views/partials/banner.php";
    include $routes[$path];

} else {
    
    http_response_code(404);
    include $routes["404"];
}


// Then include the footer
include "./views/partials/footer.php";