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
?>