<?php

namespace Controller;

session_start();

class Admin
{
    public function get()
    {
        \Controller\Utils::loggedInAdmin();
            echo \View\Loader::make()->render("templates/adminpage.twig", array(
                "bookdata" => \Model\Books::findAll(),
            ));
        
    }
}
