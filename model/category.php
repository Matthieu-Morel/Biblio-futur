<?php
include_once "database.php";

function getCategories(){
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM CATEGORY");
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function addCategory($titleCategory){
    $connection = connectBDD();

    $query = $connection->prepare("INSERT INTO CATEGORY (title_category) 
                                    VALUES (:title_category)");
    $query->bindValue(":title_category", $titleCategory, PDO::PARAM_STR);
    $query->execute();
}

function updateCategory($idCategory, $titleCategory){
    $connection = connectBDD();

    $query = $connection->prepare("UPDATE CATEGORY 
                                    SET title_category = :title_category
                                    WHERE id_category = :id_category");
    $query->bindValue(":id_category", $idCategory, PDO::PARAM_INT);
    $query->bindValue(":title_category", $titleCategory, PDO::PARAM_STR);
    $query->execute();
}

function removeCategory($idCategory){
    $connection = connectBDD();

    $query = $connection->prepare("DELETE FROM CATEGORY 
                                    WHERE id_category = :id_category");
    $query->bindValue(":id_category", $idCategory, PDO::PARAM_INT);
    $query->execute();
}
?>