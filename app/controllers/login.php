<?php

namespace Controller;

session_start();

class Login
{

    public function get()
    {

        echo \View\Loader::make()->render("templates/login.twig");
    }

    public function post()
    {
        $Name = $_POST["name"];
        $Password = $_POST["password"];
        $Result = \Model\Auth::verifyLogin($Name, $Password);

        if ($Result['PWD'] == null) {
            echo \View\Loader::make()->render("templates/login.twig", array(
                "EmailDNE" => true,
            ));
        } else if (password_verify($Password, $Result['PWD'])) {

            $_SESSION["UserName"] = $Name;

            header("Location:/user");
        } else {
            echo \View\Loader::make()->render("templates/login.twig", array(
                "wrongpw" => true,
            ));
        }
    }
}

class Logout
{

    public function get()
    {
        session_destroy();
        header("Location:/");
    }
}
