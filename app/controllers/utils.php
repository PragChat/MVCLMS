<?php

namespace Controller;
session_start();
class Utils
{
    public static function loggedInUser()
    {
        if(!isset($_SESSION["LoggedIn"]))
        {
            header("Location: /");
        }
    }
    public static function loggedInUserRedirectToLogin()
    {
        if(!isset($_SESSION["loggedIn"]))
        {
            header("Location: /login");
        }
    }

    public static function loggedInAdmin()
    {
        if(!((isset($_SESSION["LoggedIn"]))&& $_SESSION['Role']==='Admin'))
        {
            header("Location: /");
        }
    }

    public static function isSetAll(...$values)
    {
        $flag=true;
        foreach($values as $v)
            if(empty($v) || !isset($v))
                $flag=false;
        return $flag;
    }
}