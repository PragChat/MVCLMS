<?php

namespace Controller;

session_start();

class User
{

    public function get()
    {
        \Controller\Utils::loggedInUser();
            echo \View\Loader::make()->render("templates/userpage.twig");
        
    }
}