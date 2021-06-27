<?php

namespace Model;

session_start();
class Auth
{

    public static function createUser($Name, $Password)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO CLIENTS (UNAME,PWD) VALUES (?,?)");
        $stmt->execute([$Name, $Password]);
    }


    public static function verifyLogin($Name, $Password)
    {
        $db = \DB::get_instance();

        $Sth = $db->prepare("SELECT * FROM CLIENTS WHERE UNAME= ?");
        $Sth->execute([$Name]);

        $Result = $Sth->fetch();
        // echo "job done";
        return $Result;
    }

    public static function verifyLoginAdmin($Name, $Password)
    {
        $db = \DB::get_instance();

        $Sth = $db->prepare("SELECT * FROM ADMINS WHERE ANAME= ?");
        $Sth->execute([$Name]);

        $Result = $Sth->fetch();
        // echo "job done";
        return $Result;
    }
}
