<?php

use App\Routing\Route;
use App\Controllers\AuthController;
use App\Controllers\PostController;

Route::get("register", [AuthController::class, "register"]);
Route::get("login", [AuthController::class, "login"]);

Route::get("", [PostController::class, "index"]);
Route::get("post", [PostController::class, "post"]);
Route::get("update/{id}", [PostController::class, "update"]);

Route::dispatch();
