<?php

namespace Controller;

session_start();

class AdminLogin
{

    public function get()
    {

        echo \View\Loader::make()->render("templates/admin_login.twig");
    }

    public function post()
    {
        if(\Controller\Utils::isSetAll($_POST["name"], $_POST["password"])){
        $Name = $_POST["name"];
        $Password = $_POST["password"];
        $Result = \Model\Auth::verifyLoginAdmin($Name, $Password);

        if ($Result['PWD'] == null) {
            echo \View\Loader::make()->render("templates/admin_login.twig", array(
                "EmailDNE" => true,
            ));
        } else if ($Password == $Result['PWD']) {
            //echo "Correct Pw";
            $_SESSION["UserName"] = $Name;
            $_SESSION["Role"] = "Admin";
            $_SESSION["LoggedIn"] = 1;
            header("Location:/admin");
        } else {
            echo \View\Loader::make()->render("templates/admin_login.twig", array(
                "wrongpw" => true,
            ));
        }
    }}
}