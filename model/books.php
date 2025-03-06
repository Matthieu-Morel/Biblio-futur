<?php
include "database.php";

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

function getBooksBySearch($research) : array
{
    $connection = connectBDD();
    $research = htmlspecialchars($research);
    $research = "%$research%";

    $query = $connection->prepare("SELECT * FROM BOOK 
                                   JOIN AUTHOR ON BOOK.id_author = AUTHOR.id_author
                                   JOIN CATEGORY ON BOOK.id_category = CATEGORY.id_category
                                   WHERE BOOK.title_book LIKE :research
                                      OR BOOK.description_book LIKE :research
                                      OR AUTHOR.name_author LIKE :research
                                      OR AUTHOR.last_name_author LIKE :research
                                      OR CATEGORY.title_category LIKE :research");
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