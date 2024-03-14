<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function register()
    {
        if (!isset($_SESSION["user"])) {
            $error = null;
            if (isset($_POST["register"])) {
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if ($pseudo && $password) {
                    if (!User::one(["pseudo" => $pseudo])) {
                        $user = new User();
                        $user->set([
                            "pseudo" => $pseudo,
                            "password" => password_hash($password, PASSWORD_DEFAULT),
                        ]);
                        $user->save();
                    } else {
                        $error = "Ce pseudo est déjà utilisé par un autre utilisateur.";
                    }
                } else {
                    $error = "Informations incomplètes ou invalides.";
                }
            }
            return view("public/register", "Inscription", ["error" => $error]);
        } else {
            to("");
        }
    }

    public function login()
    {
        if (!isset($_SESSION["user"])) {
            $error = null;
            if (isset($_POST["login"])) {
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if ($pseudo && $password) {
                    $user = User::one(["pseudo" => $pseudo]);
                    if ($user) {
                        if (password_verify($password, $user->getPassword())) {
                            $_SESSION["user"] = ["pseudo" => $user->getPseudo(), "id" => $user->getId()];
                            to("");
                        } else {
                            $error = "Informations incomplètes ou invalides.";
                        }
                    } else {
                        $error = "Informations incomplètes ou invalides.";
                    }
                } else {
                    $error = "Informations incomplètes ou invalides.";
                }
            }
            return view("public/login", "Connexion", ["error" => $error]);
        } else {
            to("");
        }
    }
}
