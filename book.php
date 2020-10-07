<?php
$file = "book.txt"; //create text document to save all messages
$data = date('Y-m-d H:i:s'); //date format
$text = $_REQUEST['text']; //global variable
$name = $_REQUEST['name'];
if (@$_REQUEST['add']) {
  $f = fopen($file, "a"); //function that opens af file
  if (@$_REQUEST['text'] && @$_REQUEST['name']) fputs($f, '<span class="date-mess">' . $name . ' ' . $data . " </span><br>" . " <span class='message'>" . $text . "</span>" . "\n");
  fclose($f); //open and close file .txt
  $random = time();    // random parameter to not cache everything
  Header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?$random#form");
  exit();
}
$gb = @file($file);
if (!$gb) $gb = [];


//db
public static function openConnection(): PDO
    {
        $dbHost = "localhost";
        $dbUser = "test";
        $dbPass = "";
        $db     = "test";

        $driverOptions = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $pdo = new PDO('mysql:host=' . $dbHost . ';dbname=' . $db, $dbUser, $dbPass, $driverOptions);

        return $pdo;
    }

    public static function list(): array
    {
        $rows = [];
        try {
            $pdo    = self::openConnection();
            $sql    = "SELECT ID, name, , title, message, postdate FROM test";
            $handle = $pdo->prepare($sql);
            $handle->execute();
            $rows = $handle->fetchAll();
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return $rows;
    }

    public static function get($id): array
    {
        $rows = [];
        try {
            $pdo    = self::openConnection();
            $sql    = 'SELECT ID, name, , title, message, postdate FROM test WHERE ID = :id';
            $handle = $pdo->prepare($sql);
            $handle->bindValue(':id', $id);
            $handle->execute();
            $rows = $handle->fetchAll();
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return $rows;
    }

    public static function delete($id): void
    {
        try {
            $pdo    = self::openConnection();
            $sql    = 'DELETE FROM guestbook WHERE ID = :id';
            $handle = $pdo->prepare($sql);
            $handle->bindValue(':id', $id);
            $handle->execute();
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
}