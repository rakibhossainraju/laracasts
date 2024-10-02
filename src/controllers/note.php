<?php
include_once "./Database.php";

$config = include_once "./config.php";
$db = new Database($config);

$note = $db->queryOne([
    'table_name' => 'notes',
    'field_name' => 'note',
    'condition_name' => 'id',
    'condition' => '=',
    'condition_value' => $_GET['id'] ?? 1,
]);


//dd($notes, true);
include "./views/note.view.php";