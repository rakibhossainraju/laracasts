<?php
include_once "./Database.php";

$config = include_once "./config.php";
$db = new Database($config);

$note = $db->queryOne([
    'table_name' => 'notes',
    'field_name' => ['note', 'user_id'],
    'condition_name' => 'id',
    'condition' => '=',
    'condition_value' => $_GET['id'] ?? 1,
]);
const CURRENT_USER_ID = 5;
//dd($note);
if (!$note) {
    $note = [
        'note' => 'No note Found'
    ];
    http_response_code(404);
} else if ($note['user_id'] !== CURRENT_USER_ID) {
    $note = [
        'note' => 'Forbidden. <br /> You can not access this node.'
    ];
    http_response_code(403);
}


include "./views/notes/index.view.php";