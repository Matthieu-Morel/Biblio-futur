<?php
function connectBDD()
{
    $host = "127.0.0.1";
    $dbname = "bdd_biblio_futur";
    $user = "root";
    $password = "";

    try {
        $options =
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
        $connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, $options);
        return $connection;
    } catch (PDOException $e) {
        print "Erreur de connexion PDO ";
        die();
    }
}

function getBooks() : array
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM BOOK 
                                   JOIN AUTHOR ON BOOK.id_author = AUTHOR.id_author
                                   JOIN CATEGORY ON BOOK.id_category = CATEGORY.id_category");
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function getBookByTitle($research) : array
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM BOOK 
                                   WHERE BOOK.title_book LIKE '%:research%'
                                   JOIN AUTHOR ON BOOK.id_author = AUTHOR.id_author
                                   JOIN CATEGORY ON BOOK.id_category = CATEGORY.id_category");
    $query->bindValue(":research", $research, PDO::PARAM_STR);
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function getBookDetailsById($id) : array
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM BOOK 
                                   JOIN AUTHOR ON BOOK.id_author = AUTHOR.id_author
                                   JOIN CATEGORY ON BOOK.id_category = CATEGORY.id_category
                                   WHERE BOOK.id_book = :id");
    $query->bindValue(":id", $id, PDO::PARAM_STR);
    $query->execute();

    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function getBooksSortedByPrice() : array
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM BOOK 
                                   JOIN AUTHOR ON BOOK.id_author = AUTHOR.id_author
                                   JOIN CATEGORY ON BOOK.id_category = CATEGORY.id_category
                                   ORDER BY price_book");
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
?>