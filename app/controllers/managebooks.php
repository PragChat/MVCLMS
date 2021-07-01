<?php

namespace Controller;

session_start();


class ManageBooks
{

    public function get()
    {
        \Controller\Utils::loggedInUser();

            echo \View\Loader::make()->render("templates/managebooks.twig", array(
                "requestdata" =>  \Model\Books::findAllRequests(),
            ));
        
    }

    public function post()
    {
        if(\Controller\Utils::isSetAll($_POST["request"])){
        $db = \DB::get_instance();
        $Name = $_SESSION["UserName"];
            \Model\Books::updateRequestAdmin($_POST["request"], $Name);
    }}
}