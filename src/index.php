<?php

include "./helper/util.php";
include "./views/partials/hade.php";

include "./router.php";
 if (array_key_exists($path, $routes)) {
     routeToController($path, $routes);
 } else {
     abort();
 }
 // Then include the footer
 include "./views/partials/footer.php";
