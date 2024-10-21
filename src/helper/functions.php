<?php

function dd($value, $should_print_r = false): void
{
    if($should_print_r) {
        echo print_r($value);
    } else {
        echo "<pre>";
        echo var_dump($value);
        echo "</pre>";
    }
    die;
}

function urlIs($value): bool
{
    return $_SERVER["REQUEST_URI"] === $value;
}

function base_path($path): string
{
    return BASE_PATH . $path;
}

function view($path): string
{
    return base_path("views/{$path}");
}