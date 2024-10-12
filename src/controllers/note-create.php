<?php


if($_SERVER['REQUEST_METHOD'] === "POST") {
    dd($_POST);
}
include "./views/note-create.view.php";
