<?php
//return [
//    "/" => base_path("controllers/home.php"),
//    "/home" => base_path("controllers/home.php"),
//    "/about" => base_path("controllers/about.php"),
//    "/contact" => base_path("controllers/contact.php"),
//    "/notes" => base_path("controllers/notes/index.php"),
//    "/note/create" => base_path("controllers/notes/create.php"),
//    "/note" => base_path("controllers/notes/note.php"),
//];
//GET ROUTES
$router->get("/", "controllers/home.php");
$router->get("/home", "controllers/home.php");
$router->get("/about", "controllers/about.php");
$router->get("/contact", "controllers/contact.php");

$router->get("/notes", "controllers/notes/index.php");
$router->get("/note", "controllers/notes/note.php");
$router->get("/note/create", "controllers/notes/create.php");

// POST ROUTES
$router->post("/note/create", "controllers/notes/create.php");

//DELETE ROUTES
$router->delete("/note", "controllers/notes/note.php");