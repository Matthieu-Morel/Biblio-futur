<?php if(!isset($_SESSION)){
    session_start();
} 
include_once "$filePath/model/user.php";
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title?></title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body class="d-flex flex-column min-vh-100">
        <header class="container-fluid bg-dark d-flex flex-row p-3 justify-content-between align-items-center">
            <nav class="navbar navbar-expand-md navbar-dark w-100">
                <div class="container-fluid">
                    <img class="navbar-brand" style="width: 250px; height: 70px;" src="./img/logoBiblioFutur.png" alt="Logo de Biblio Futur">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-md-end" id="navbarContent">
                        <ul class="navbar-nav">
                            <?php if(isLogged()){ ?>
                                <?php if($_SESSION["role_users"] == "admin"){ ?>
                                    <li class="nav-item">
                                        <a class="d-lg-none nav-link fs-6 text-warning" href="./?page=admin">Administration</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="d-none d-lg-flex nav-link fs-5 text-warning" href="./?page=admin">Administration</a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                            <li class="nav-item">
                                <a class="d-lg-none nav-link fs-6 text-warning" href="./?page=accueil">Nouveautés</a>
                            </li>
                            <li class="nav-item">
                                <a class="d-none d-lg-flex nav-link fs-5 text-warning" href="./?page=accueil">Nouveautés</a>
                            </li>
                            <li class="nav-item">
                                <a class="d-lg-none nav-link fs-6 text-warning" href="./?page=catalogue">Catalogue</a>
                            </li>
                            <li class="nav-item">
                                <a class="d-none d-lg-flex nav-link fs-5 text-warning" href="./?page=catalogue">Catalogue</a>
                            </li>
                            <li class="nav-item">
                                <a class="d-lg-none nav-link fs-6 text-warning" href="./?page=commande">Commande</a>
                            </li>
                            <li class="nav-item">
                                <a class="d-none d-lg-flex nav-link fs-5 text-warning" href="./?page=commande">Commande</a>
                            </li>
                            <li class="nav-item">
                                <a class="d-lg-none nav-link fs-6 text-warning" href="./?page=profil">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="d-none d-lg-flex nav-link fs-5 text-warning" href="./?page=profil">Profil</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>


        </header>
            <?php if(isset($_SESSION["alert"])) { ?>
                <div class="alert alert-<?= $_SESSION["alert"]["type"] ?> alert-dismissible position-absolute top-0 start-50 translate-middle-x mt-5 fade show" role="alert">
                    <p class="m-0"><?= $_SESSION["alert"]["message"] ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php unset($_SESSION["alert"]);
            } ?>