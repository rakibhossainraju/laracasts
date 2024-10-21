<?php
const BASE_PATH = __DIR__ . "/../";

include "../helper/functions.php";
include view("/partials/header.php");
include base_path("router.php");

 if (array_key_exists($path, $routes)) {
     routeToController($path, $routes);
 } else {
     abort();
 }
 // Then include the footer
 include view("/partials/footer.php");
