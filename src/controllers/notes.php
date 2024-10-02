<?php
include_once "./Database.php";

$config = include_once "./config.php";
$db = new Database($config);

$notes = $db->queryAll("SELECT * FROM notes where user_id = 5");


//dd($notes, true);
include "./views/notes.view.php";