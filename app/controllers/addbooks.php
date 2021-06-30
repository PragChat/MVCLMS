<?php

namespace Controller;

session_start();


class AddBooks
{

    public function post()
    {

        \Controller\Utils::loggedInAdmin();
        if(\Controller\Utils::isSetAll($_POST["name"], $_POST["isbn"])){

            $book_name = $_POST["name"];
            $book_isbn = $_POST["isbn"];

            
                \Model\Books::addBookData($book_name, $book_isbn);

                echo \View\Loader::make()->render("templates/adminpage.twig", array(
                    "dataEntered" => true,
                    "bookdata" =>  \Model\Books::findAll(),

                ));
            
        
    }}
}