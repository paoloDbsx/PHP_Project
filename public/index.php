<?php

try {
    session_start();

    $pathname = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_URL);
    if (substr($pathname, -1) === '/') {
        $pathname = rtrim($pathname, '/');
        header("location:/{$pathname}");
    }

    spl_autoload_register(function ($class) {
        $path = "../" . str_replace("\\", "/", $class) . ".php";
        if (file_exists($path)) {
            require_once($path);
        }
    });

    require_once("../app/functions.php");
    require_once("../app/routing/router.php");
} catch (\Throwable $th) {
    echo $th->getMessage();
    echo "Line : " . $th->getLine() . ", File : " . $th->getFile();
}
