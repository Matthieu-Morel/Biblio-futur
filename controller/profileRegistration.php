<?php
include_once "$filePath/model/user.php";

if (isLogged()) {
    include "$filePath/controller/profile.php";
}
else {
    $formSubmited = isset($_POST["firstName"]) 
                    && isset($_POST["lastName"]) 
                    && isset($_POST["login"]) 
                    && isset($_POST["password"]) 
                    && isset($_POST["confirmPassword"]);
    if ($formSubmited) {
        if(empty(trim($_POST["firstName"])) || empty(trim($_POST["lastName"]))
            || empty(trim($_POST["login"])) || empty(trim($_POST["password"])) 
            || empty(trim($_POST["confirmPassword"]))){
            $_SESSION["alert"] = array("message" => "Veuillez renseigner tous les champs.", 
                                        "type" => "danger");
        }
        else if(!ctype_alpha(trim($_POST["firstName"]))){
            $_SESSION["alert"] = array("message" => "Le prénom ne doit contenir que des lettres.", 
                                        "type" => "danger");
        }
        else if(!ctype_alpha(trim($_POST["lastName"]))){
            $_SESSION["alert"] = array("message" => "Le nom ne doit contenir que des lettres.", 
                                        "type" => "danger");
        }
        else if(!filter_var(trim($_POST["login"]), FILTER_VALIDATE_EMAIL)){
            $_SESSION["alert"] = array("message" => "L'adresse mail n'est pas valide.", 
                                        "type" => "danger");
        }
        else if(strlen(trim($_POST["password"])) < 8){
            $_SESSION["alert"] = array("message" => "Le mot de passe doit contenir au moins 8 caractères.", 
                                        "type" => "danger");
        }
        else if(trim($_POST["password"]) != trim($_POST["confirmPassword"])){
            $_SESSION["alert"] = array("message" => "Les mots de passe ne correspondent pas.", 
                                        "type" => "danger");
        }
        else {
            registerUser(trim($_POST["firstName"]), trim($_POST["lastName"]), trim($_POST["login"]), trim($_POST["password"]));
            login(trim($_POST["login"]), trim($_POST["password"]));
            header("Location: ./?page=profil");
            exit();
        }
    }
    
    $title = "Inscription";
    include "$filePath/view/header.php";
    include "$filePath/view/viewProfileRegistration.php";
    include "$filePath/view/footer.php";
}
?>