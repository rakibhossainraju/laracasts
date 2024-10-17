<?php
include_once "./Database.php";

$config = include_once "./config.php";
$db = new Database($config);

$notes = $db->queryAll("SELECT * FROM notes");


//dd($notes, true);
include "./views/notes/notes.view.php";