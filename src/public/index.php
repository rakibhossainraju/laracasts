<?php
use Core\Router;
const BASE_PATH = __DIR__ . "/../";
include BASE_PATH . "helper/functions.php";
include view("/partials/header.php");
include base_path("router.php");

spl_autoload_register(function ($class) {
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    include base_path("{$class}.php");
});



$router = new Router();
include_once base_path("routes.php");

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri)['path'] ?? "/";
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router->route($path, $method);

 // Then include the footer
 include view("/partials/footer.php");
