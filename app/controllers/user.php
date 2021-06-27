<?php

namespace Controller;

session_start();

class Home
{
    public function get()
    {

        if ($_SESSION["UserName"] != NULL) {

            if ($_SESSION['Role'] != NULL) {
                header("Location:/admin");
            } else {
                // echo \View\Loader::make()->render("templates/userpage.twig");
                header("Location:/user");
            }
        } else {
            echo \View\Loader::make()->render("templates/home.twig");
        }
    }
}


class User
{

    public function get()
    {
        if (!isset($_SESSION)) {
            echo \View\Loader::make()->render("templates/home.twig");
        } else {
            echo \View\Loader::make()->render("templates/userpage.twig");
        }
    }
}


class UserRequests
{

    public function get()
    {
        
        if (!isset($_SESSION)) {
            echo \View\Loader::make()->render("templates/home.twig");
        } else {
            echo \View\Loader::make()->render("templates/userrequests.twig", array(
                "book" => \Model\Books::findReq($_SESSION["UserName"]),
            ));
        }
    }
}
