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

        $Data = array($_POST["request"]);
        $Size = sizeof($Data);
        $Name = $_SESSION["UserName"];
        //echo \View\Loader::make()->render("templates/test.twig");
        for($x = 0; $x<$Size; $x++)
        {
            \Model\Books::updateRequestAdmin($_POST["request"][$x], $Name);
        }
    }}
}