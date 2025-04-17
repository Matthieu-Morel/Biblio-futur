<?php 
include_once "$filePath/model/database.php";

function addBookToFavorites($id_book, $id_user) : void
{
    $connection = connectBDD();

    $query = $connection->prepare("INSERT INTO TO_LIKE (id_users, id_book) 
                                    VALUES (:id_users, :id_book)");
    $query->bindValue(":id_users", $id_user, PDO::PARAM_INT);
    $query->bindValue(":id_book", $id_book, PDO::PARAM_INT);
    $query->execute();
}

function removeBookFromFavorites($id_book, $id_user) : void
{
    $connection = connectBDD();

    $query = $connection->prepare("DELETE FROM TO_LIKE 
                                    WHERE id_users = :id_users 
                                    AND id_book = :id_book");
    $query->bindValue(":id_users", $id_user, PDO::PARAM_INT);
    $query->bindValue(":id_book", $id_book, PDO::PARAM_INT);
    $query->execute();
}

function getFavoritesByUserId($id_user) : array
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT id_book FROM TO_LIKE
                                    WHERE id_users = :id_users");
    $query->bindValue(":id_users", $id_user, PDO::PARAM_INT);
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_COLUMN);
    return $data;
}
?>