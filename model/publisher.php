<?php
include_once "database.php";

function getPublishers(){
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM PUBLISHER");
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function addPublisher($labelPublisher){
    $connection = connectBDD();

    $query = $connection->prepare("INSERT INTO PUBLISHER (label_publisher) 
                                    VALUES (:label_publisher)");
    $query->bindValue(":label_publisher", $labelPublisher, PDO::PARAM_STR);
    $query->execute();
}

function updatePublisher($idPublisher, $labelPublisher){
    $connection = connectBDD();

    $query = $connection->prepare("UPDATE PUBLISHER 
                                    SET label_publisher = :label_publisher
                                    WHERE id_publisher = :id_publisher");
    $query->bindValue(":id_publisher", $idPublisher, PDO::PARAM_INT);
    $query->bindValue(":label_publisher", $labelPublisher, PDO::PARAM_STR);
    $query->execute();
}

function removePublisher($idPublisher){
    $connection = connectBDD();

    $query = $connection->prepare("DELETE FROM PUBLISHER
                                    WHERE id_publisher = :id_publisher");
    $query->bindValue(":id_publisher", $idPublisher, PDO::PARAM_INT);
    $query->execute();
}
?>