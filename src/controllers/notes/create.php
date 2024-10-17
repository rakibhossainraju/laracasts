<?php
include_once "./Database.php";
include_once "./Validator.php";
$config = include_once "./config.php";
$db = new Database($config);

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $note = $_POST['note'];
    $errors = [];
    $validation_fields = [
        "string" => $note,
        "rules" => [
            "required" => [
                "message" => "Note is required"
            ],
            "min" => [
                "value" => 5,
                "message" => "Note must be at least 5 characters"
            ],
            "max" => [
                "value" => 500,
                "message" => "Note must not be more than 500 characters"
            ]
        ],
    ];
    $valeted_note = (new Validator())->string($validation_fields);
    if(is_string($valeted_note)) {
        $errors['message'] = $valeted_note;
    } else {
        $db->insert([
            'table_name' => 'notes',
            'field_names' => ['note', 'user_id'],
            'values' => [htmlspecialchars($note), 5]
        ]);
        $note = "";
    }
}
include "./views/notes/create.view.php";
