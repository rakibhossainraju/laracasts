<?php

function dd($value, $should_print_r = false) {
    if($should_print_r) {
        echo print_r($value);
    } else {
        echo "<pre>";
        echo var_dump($value);
        echo "</pre>";
    }
    die;
}

function urlIs($value) {
    return $_SERVER["REQUEST_URI"] === $value;
}