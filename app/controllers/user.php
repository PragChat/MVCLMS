<?php

namespace Controller;

session_start();

class Home
{
    public function get()
    {

        if ($_SESSION["UserName"] != NULL) {

            if ($_SESSION['Role'] != "User") {
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
