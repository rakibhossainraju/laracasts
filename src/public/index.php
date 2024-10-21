<?php
const BASE_PATH = __DIR__ . "/../";
include BASE_PATH . "helper/functions.php";
include view("/partials/header.php");
include base_path("router.php");

spl_autoload_register(function ($class) {
    include base_path("Core/{$class}.php");
});

 if (array_key_exists($path, $routes)) {
     routeToController($path, $routes);
 } else {
     abort();
 }
 // Then include the footer
 include view("/partials/footer.php");
