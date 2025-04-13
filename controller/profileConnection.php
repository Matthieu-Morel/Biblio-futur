<?php
include "$filePath/model/user.php";

if (isLogged()) {
    include "$filePath/controller/profile.php";
}
else {
    if(isset($_POST["login"]) && isset($_POST["password"])){
        if(empty(trim($_POST["login"])) || empty(trim($_POST["password"]))){
            $_SESSION["alert"] = array("message" => "Veuillez renseigner tous les champs.", 
                                        "type" => "danger");
        }
        else if(!filter_var(trim($_POST["login"]), FILTER_VALIDATE_EMAIL)){
            $_SESSION["alert"] = array("message" => "L'adresse mail n'est pas valide.", 
                                        "type" => "danger");
        }
        else if(!login(trim($_POST["login"]), trim($_POST["password"]))){
            $_SESSION["alert"] = array("message" => "L'adresse mail ou le mot de passe est incorrect.", 
                                        "type" => "danger");
        }
        else {
            header("Location: ./?page=profil");
            exit();
        }
    }

    $title = "Connexion";
    include "$filePath/view/header.php";
    include "$filePath/view/viewProfileConnection.php";
    include "$filePath/view/footer.php";
}
?>