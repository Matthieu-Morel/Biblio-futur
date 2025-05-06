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
            <img class="img-fluid col-2" src="./img/logoBiblioFutur.png" alt="Logo de Biblio Futur">
            <nav>
                <ul class="nav">
                    <?php if(isLogged()){ ?>
                        <?php if($_SESSION["role_users"] == "admin"){ ?>
                            <li class="nav-item">
                                <a class="nav-link fs-5 text-warning" href="./?page=admin">Administration</a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link fs-5 text-warning" href="./?page=accueil">Nouveautés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 text-warning" href="./?page=catalogue">Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 text-warning" href="./?page=commande">Commande</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 text-warning" href="./?page=profil">Profil</a>
                    </li>
                </ul>
            </nav>
        </header>
            <?php if(isset($_SESSION["alert"])) { ?>
                <div class="alert alert-<?= $_SESSION["alert"]["type"] ?> alert-dismissible position-absolute top-0 start-50 translate-middle-x mt-5 fade show" role="alert">
                    <p class="m-0"><?= $_SESSION["alert"]["message"] ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php unset($_SESSION["alert"]);
            } ?>