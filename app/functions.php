<?php

function view(string $view, string $title, array $data = []): void
{
    foreach ($_GET as $param => $value) {
        $data[$param] = filter_input(INPUT_GET, $value, FILTER_SANITIZE_URL);
    }
    $data["view"] = "../views/$view.php";
    $data["title"] = $title;
    extract($data);
    require_once("../views/page.php");
}

function to(string $pathname): void
{
    header("location:/{$pathname}");
}
