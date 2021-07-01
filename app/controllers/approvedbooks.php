<?php

namespace Controller;

session_start();


class ApprovedBooks
{


    public function get()
    {
        \Controller\Utils::loggedInUser();
            echo \View\Loader::make()->render("templates/approvedbooks.twig", array(
                "history" => \Model\Books::findApproved($_SESSION["UserName"]),
                "checkinsuccess" => false,
            ));
        
    }


    public function post()
    {
        if(\Controller\Utils::isSetAll($_POST["checkin"])){
        $db = \DB::get_instance();
        $Name = $_SESSION["UserName"];
            \Model\Books::updateCheckin($Name, $_POST["checkin"]);
    }}
}
