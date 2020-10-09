<?php




if (isset($_POST['add'])) {
    $data = date('Y-m-d H:i:s'); //date format
    $message = $_POST['message']; //global variable
    $name = $_POST['name'];
    $title = $_POST['title'];
    saveMessages($name, $title, $message, $data);
}


//db
function openConnection(): PDO
{
    $dbHost = "localhost";
    $dbUser = "root";
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

function listMessages(): array
{
    $rows = [];
    try {
        $pdo    = openConnection();
        $sql    = "SELECT ID, name, title, message, postdate FROM test";
        $handle = $pdo->prepare($sql);
        $handle->execute();
        $rows = $handle->fetchAll();
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }

    return $rows;
}

function saveMessages($name, $title, $message, $datepost): void
{
    try {
        $pdo = openConnection();
        // if ($guestbookItem->getID() === '') {
        $sql    = 'INSERT INTO test (name, title, message, postdate) VALUES (:name,  :title, :message, :datepost)';
        $handle = $pdo->prepare($sql);
        // } else {
        //     $sql    = 'UPDATE guestbook SET name_first = :name_first, name_last = :name_last, title = :title, message = :message, date_post = :date_post WHERE ID = :id';
        //     $handle = $pdo->prepare($sql);
        //     $handle->bindValue(':id', $guestbookItem->getID());
        // }
        $handle->bindValue(':name', $name);
        $handle->bindValue(':title', $title);
        $handle->bindValue(':message', $message);
        $handle->bindValue(':datepost', $datepost);
        $handle->execute();
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}
// function get($id): array
// {
//     $rows = [];
//     try {
//         $pdo    = self::openConnection();
//         $sql    = 'SELECT ID, name, , title, message, postdate FROM test WHERE ID = :id';
//         $handle = $pdo->prepare($sql);
//         $handle->bindValue(':id', $id);
//         $handle->execute();
//         $rows = $handle->fetchAll();
//     } catch (Exception $e) {
//         echo 'Caught exception: ', $e->getMessage(), "\n";
//     }

//     return $rows;
// }

// function delete($id): void
// {
//     try {
//         $pdo    = self::openConnection();
//         $sql    = 'DELETE FROM guestbook WHERE ID = :id';
//         $handle = $pdo->prepare($sql);
//         $handle->bindValue(':id', $id);
//         $handle->execute();
//     } catch (Exception $e) {
//         echo 'Caught exception: ', $e->getMessage(), "\n";
//     }
// }
$listMessages = listMessages();