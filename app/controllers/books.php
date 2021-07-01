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

        $Name = $_SESSION["UserName"];
            \Model\Books::updateRequest($Name, $_POST["checkout"]);
    }}
}

