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
        $Data = array($_POST["checkin"]);
        $Size = sizeof($Data);
        $Name = $_SESSION["UserName"];
        for($x = 0; $x < $Size; $x++)
        {
            \Model\Books::updateCheckin($Name, $_POST["checkin"][$x]);
        }
    }}
}
