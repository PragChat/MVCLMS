<?php

namespace Controller;

session_start();

class CheckedBooks
{
    public function get()
    {

        \Controller\Utils::loggedInAdmin();
            echo \View\Loader::make()->render("templates/checkedbooks.twig", array(
                "books" => \Model\Books::findChecked(),
            ));
        
    }
}