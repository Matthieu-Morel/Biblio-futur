<?php
include_once "database.php";

function getAuthors(){
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM AUTHOR");
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function addAuthor($name, $lastName){
    $connection = connectBDD();

    $query = $connection->prepare("INSERT INTO AUTHOR (name_author, last_name_author) 
                                    VALUES (:name_author, :last_name_author)");
    $query->bindValue(":name_author", $name, PDO::PARAM_STR);
    $query->bindValue(":last_name_author", $lastName, PDO::PARAM_STR);
    $query->execute();
}

function updateAuthor($idAuthor, $name, $lastName){
    $connection = connectBDD();

    $query = $connection->prepare("UPDATE AUTHOR 
                                    SET name_author = :name_author,
                                    last_name_author = :last_name_author
                                    WHERE id_author = :id_author");
    $query->bindValue(":name_author", $name, PDO::PARAM_STR);
    $query->bindValue(":last_name_author", $lastName, PDO::PARAM_STR);
    $query->bindValue(":id_author", $idAuthor, PDO::PARAM_INT);
    $query->execute();
}

function removeAuthor($idAuthor){
    $connection = connectBDD();

    $query = $connection->prepare("DELETE FROM AUTHOR 
                                    WHERE id_author = :id_author");
    $query->bindValue(":id_author", $idAuthor, PDO::PARAM_INT);
    $query->execute();
}
?>