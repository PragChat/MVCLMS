<?php

namespace Model;


class Books
{

  public static function findAvailable()
  {
    $db = \DB::get_instance();
    $Sth = $db->prepare("SELECT * FROM BOOKS WHERE IF_TAKEN=0 ORDER BY ISBN ASC");
    $Sth->execute();

    $Result = $Sth->fetchAll();
    return $Result;
  }

  public static function findAll()
  {
    $db = \DB::get_instance();
    $Sth = $db->prepare("SELECT * FROM BOOKS ORDER BY ISBN ASC");
    $Sth->execute();

    $Result = $Sth->fetchAll();
    return $Result;
  }

  public static function addBookData($book_name, $book_isbn)
  {

    $db = \DB::get_instance();
    $stmt = $db->prepare("INSERT INTO BOOKS (NAME, ISBN) VALUES (?,?)");
    $stmt->execute([$book_name, $book_isbn]);

    return;
  }

  public static function updateCheckin($Name, $RequestId)
  {
    $db = \DB::get_instance();
    $Data = array($RequestId);

    $Size = sizeof($RequestId);

    for ($x = 0; $x < $Size; $x++) {


      $Sth = $db->prepare("UPDATE BOOKS SET IF_TAKEN = 0, TAKEN_NAME = NULL WHERE ISBN=?");
      $Sth->execute([$RequestId[$x]]);
    }

    for ($x = 0; $x < $Size; $x++) {

      $Sth = $db->prepare("DELETE FROM REQUESTS WHERE ISBN = ?");
      $Sth->execute([$RequestId[$x]]);
    }
  }


  public static function findApproved($Name)
  {
    $db = \DB::get_instance();

    $Sth = $db->prepare("SELECT * FROM BOOKS WHERE TAKEN_NAME = ? AND IF_TAKEN=1 ORDER BY ISBN ASC");
    $Sth->execute([$Name]);

    $Result = $Sth->fetchAll();
    return $Result;
  }


  public static function updateRequest($Name, $books_id)
  {
    $db = \DB::get_instance();
    $Data = array($books_id);
    $Size = sizeof($books_id);

    for ($x = 0; $x < $Size; $x++) {
      $Status = 0;
      $Sth = $db->prepare("INSERT INTO REQUESTS (CLIENT,ISBN,REQUEST_TYPE) VALUES (?,?,?)");
      $Sth->execute([$Name, $books_id[$x], $Status]);
    }

    $Sth = $db->prepare("DELETE c1 FROM REQUESTS c1 INNER JOIN REQUESTS c2 WHERE c1.ID > c2.ID AND c1.ISBN = c2.ISBN AND c1.CLIENT = c2.CLIENT");
    $Sth->execute();
  }


  public static function findChecked()
  {
    $db = \DB::get_instance();

    $Sth = $db->prepare("SELECT * FROM BOOKS WHERE IF_TAKEN=1 ORDER BY ISBN ASC");
    $Sth->execute();

    $Result = $Sth->fetchAll();

    return $Result;
  }

  public static function findReq($Name)
  {
    $db = \DB::get_instance();

    $Sth = $db->prepare("SELECT * FROM REQUESTS INNER JOIN BOOKS USING(ISBN) WHERE  CLIENT = ? ORDER BY ID ASC");

    $Sth->execute([$Name]);

    $Result = $Sth->fetchAll();
    return $Result;
  }

  public static function findAllRequests()
  {
    $db = \DB::get_instance();

    $Sth = $db->prepare("SELECT * FROM REQUESTS INNER JOIN BOOKS USING (ISBN) ORDER BY ID ASC");
    $Sth->execute();

    $Result = $Sth->fetchAll();
    return $Result;
  }

  public static function updateRequestAdmin($RequestId, $Name)
  {
    $db = \DB::get_instance();
    $Data = array($RequestId);
    $Size = sizeof($RequestId);

  

      for ($x = 0; $x < $Size; $x++) {

        $Sth = $db->prepare("UPDATE BOOKS INNER JOIN REQUESTS USING (ISBN) SET IF_TAKEN = 1, TAKEN_NAME = REQUESTS.CLIENT WHERE ID=?");
        $Sth->execute([$RequestId[$x]]);
  }

      for ($x = 0; $x < $Size; $x++) {

        $Sth = $db->prepare("DELETE FROM REQUESTS WHERE ID=?");
        $Sth->execute([$RequestId[$x]]);
      }
    }
  }

