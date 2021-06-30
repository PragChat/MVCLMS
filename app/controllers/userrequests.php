<?php

namespace Controller;

session_start();

class UserRequests
{

    public function get()
    {
        
        \Controller\Utils::loggedInUser();
            echo \View\Loader::make()->render("templates/userrequests.twig", array(
                "book" => \Model\Books::findReq($_SESSION["UserName"]),
            ));
        
    }
}