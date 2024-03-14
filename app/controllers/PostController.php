<?php

namespace App\Controllers;

use App\Models\Post;

class PostController
{
    public function index()
    {
        if (isset($_SESSION["user"])) {

            if (isset($_POST["logout"])) {
                unset($_SESSION["user"]);
                to("login");
            }

            if (isset($_POST["delete"])) {
                $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
                Post::delete(["id" => $id]);
                to("");
            }

            return view("private/home", "Accueil", ["posts" => Post::all()]);
        } else {
            to("login");
        }
    }

    public function post()
    {
        if (isset($_SESSION["user"])) {
            $error = null;
            if (isset($_POST["post"])) {
                $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if ($title && $content) {
                    $post = new Post();
                    $post->set([
                        "title" => $title,
                        "content" => $content,
                        "user_id" => $_SESSION["user"]["id"],
                    ]);
                    $post->save();
                    to("");
                } else {
                    $error = "Informations incomplètes ou invalides.";
                }
            }
            return view("private/post", "Création", ["error" => $error]);
        } else {
            to("login");
        }
    }

    public function update(int $id)
    {
        if (isset($_SESSION["user"])) {
            $post = Post::one(["id" => $id]);
            if ($post && $post->getUser_id() == $_SESSION["user"]["id"]) {
                $error = null;
                if (isset($_POST["update"])) {
                    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    if ($title && $content) {
                        $post->set([
                            "title" => $title,
                            "content" => $content,
                        ]);
                        $post->save();
                        to("");
                    } else {
                        $error = "Informations incomplètes ou invalides.";
                    }
                }
                return view("private/update", "Modification", ["post" => $post, "error" => $error]);
            } else {
                view("errors/404", "404");
            }
        } else {
            to("login");
        }
    }
}
