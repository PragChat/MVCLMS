<?php

namespace Controller;

session_start();


class Books
{
    public function get()
    {
        \Controller\Utils::loggedInUser();
            $Name = $_SESSION["UserName"];

            echo \View\Loader::make()->render("templates/books.twig", array(
                "booksavailable" => \Model\Books::findAvailable(),

            ));
        
    }


    public function post()
    {
        if(\Controller\Utils::isSetAll($_POST["checkout"])){
        $db = \DB::get_instance();
        $Data = array($_POST["checkout"]);
        $Size = sizeof($Data);

        $Name = $_SESSION["UserName"];

        for($x = 0; $x < $Size; $x++)
        {
            \Model\Books::updateRequest($Name, $_POST["checkout"][$x]);
        }
    }}
}

