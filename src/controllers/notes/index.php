<?php
use Core\Database;

$config = include_once base_path("config.php");
$db = new Database($config);

$notes = $db->queryAll("SELECT * FROM notes");


//dd($notes, true);
include view("notes/index.view.php");