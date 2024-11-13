<?php
use Core\Database;

$config = include_once base_path("config.php");
$db = new Database($config);
const CURRENT_USER_ID = 5;

$note = $db->queryOne([
    'table_name' => 'notes',
    'field_name' => ['note', 'user_id'],
    'condition_name' => 'id',
    'condition' => '=',
    'condition_value' => $_GET['id'] ?? 1,
]);
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['_method']) && $_POST['_method'] === "DELETE") {
    if($note['user_id'] !== CURRENT_USER_ID) {
        $note = [
            'note' => 'Forbidden. <br /> You do not have the permission to delete this node.'
        ];
        http_response_code(403);
    } else {
        $db->deleteOne([
            'table_name' => 'notes',
            'condition_name' => 'id',
            'condition' => '=',
            'condition_value' => $_POST['id'],
        ]);
        echo "<script>window.location.href = '/notes'</script>";
        die;
    }
} else {
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
}
include view("notes/note.view.php");


