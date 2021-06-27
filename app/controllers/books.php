<?php

namespace Controller;

session_start();


class Books
{
    public function get()
    {
        if (!isset($_SESSION)) {
            echo \View\Loader::make()->render("templates/home.twig");
        } else {
            $Name = $_SESSION["UserName"];

            echo \View\Loader::make()->render("templates/books.twig", array(
                "booksavailable" => \Model\Books::findAvailable(),

            ));
        }
    }


    public function post()
    {

        $db = \DB::get_instance();
        $Data = $_POST["checkout"];

        $Name = $_SESSION["UserName"];

        \Model\Books::updateRequest($Name, $Data);
    }
}



class AddBooks
{

    public function post()
    {

        if (!isset($_SESSION["Role"])) {
            echo \View\Loader::make()->render("templates/home.twig");
        } else {

            $book_name = $_POST["name"];
            $book_isbn = $_POST["isbn"];

            if ($book_count < 0) {

                echo \View\Loader::make()->render("templates/adminpage.twig", array(
                    "invaliddata" => true,
                    "bookdata" =>  \Model\Books::findAll(),

                ));
            } else {
                \Model\Books::addBookData($book_name, $book_isbn);

                echo \View\Loader::make()->render("templates/adminpage.twig", array(
                    "dataEntered" => true,
                    "bookdata" =>  \Model\Books::findAll(),

                ));
            }
        }
    }
}


class ApprovedBooks
{


    public function get()
    {
        if (!isset($_SESSION)) {
            echo \View\Loader::make()->render("templates/home.twig");
        }
        //echo $_SESSION["UserName"];
        else {
            echo \View\Loader::make()->render("templates/approvedbooks.twig", array(
                "history" => \Model\Books::findApproved($_SESSION["UserName"]),
                "checkinsuccess" => false,
            ));
        }
    }


    public function post()
    {

        $db = \DB::get_instance();
        $Data = $_POST["checkin"];
        $Name = $_SESSION["UserName"];
        \Model\Books::updateCheckin($Name, $Data);
    }
}


class ManageBooks
{

    public function get()
    {
        if (!isset($_SESSION)) {
            echo \View\Loader::make()->render("templates/home.twig");
        } else {

            echo \View\Loader::make()->render("templates/managebooks.twig", array(
                "requestdata" =>  \Model\Books::findAllRequests(),
            ));
        }
    }

    public function post()
    {

        $db = \DB::get_instance();

        $Data = $_POST["request"];
        $Name = $_SESSION["UserName"];
        //echo \View\Loader::make()->render("templates/test.twig");
        \Model\Books::updateRequestAdmin($Data, $Name);
    }
}

class CheckedBooks
{
    public function get()
    {

        if (!isset($_SESSION["Role"])) {
            echo \View\Loader::make()->render("templates/home.twig");
        } else {
            echo \View\Loader::make()->render("templates/checkedbooks.twig", array(
                "books" => \Model\Books::findChecked(),
            ));
        }
    }
}
