<?php

namespace Controller;

class Register
{

    public function get()
    {
        echo \View\Loader::make()->render("templates/register.twig");
    }

    public function post()
    {
        if(\Controller\Utils::isSetAll($_POST["name"], $_POST["password"])){
        $Name = $_POST["name"];
        $Password = $_POST["password"];
        $Password = password_hash($Password, PASSWORD_BCRYPT);
        //$Password = hash("sha512", $password);

        \Model\Auth::createUser($Name, $Password);

        echo \View\Loader::make()->render("templates/register.twig", array(
            "dataEntered" => true,
        ));
    }}
}
