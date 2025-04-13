<?php
include "$filePath/model/user.php";

if (isLogged()) {
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case "modifier_prenom":
                if (isset($_POST["firstName"])) {
                    if (empty(trim($_POST["firstName"]))) {
                        $_SESSION["alert"] = array("message" => "Le prénom ne doit pas être vide.", 
                                                   "type" => "danger");
                    }
                    else if (!ctype_alpha(trim($_POST["firstName"]))) {
                        $_SESSION["alert"] = array("message" => "Le prénom ne doit contenir que des lettres.", 
                                                   "type" => "danger");
                    }
                    else {
                        updateNameUser($_SESSION["login_users"], $_POST["firstName"]);
                        $_SESSION["name_users"] = $_POST["firstName"];
                        $_SESSION["alert"] = array("message" => "Le prénom a été modifié avec succès.", 
                                                   "type" => "success");
                    }
                    unset($_POST["firstName"]);
                    header("Location: ./?page=profil");
                    exit();
                }
                break;
            case "modifier_nom":
                if (isset($_POST["lastName"])) {
                    if (empty(trim($_POST["lastName"]))) {
                        $_SESSION["alert"] = array("message" => "Le nom ne doit pas être vide.", 
                                                   "type" => "danger");
                    }
                    else if (!ctype_alpha(trim($_POST["lastName"]))) {
                        $_SESSION["alert"] = array("message" => "Le nom ne doit contenir que des lettres.", 
                                                   "type" => "danger");
                    }
                    else {
                        updateLastNameUser($_SESSION["login_users"], $_POST["lastName"]);
                        $_SESSION["last_name_users"] = $_POST["lastName"];
                        $_SESSION["alert"] = array("message" => "Le nom a été modifié avec succès.", 
                                                   "type" => "success");
                    }
                    unset($_POST["lastName"]);
                    header("Location: ./?page=profil");
                    exit();
                }
                break;
            case "modifier_mail":
                if (isset($_POST["login"])) {
                    if (empty(trim($_POST["login"]))) {
                        $_SESSION["alert"] = array("message" => "L'adresse mail ne doit pas être vide.", 
                                                   "type" => "danger");
                    }
                    else if (!filter_var(trim($_POST["login"]), FILTER_VALIDATE_EMAIL)) {
                        $_SESSION["alert"] = array("message" => "L'adresse mail n'est pas valide.", 
                                                   "type" => "danger");
                    }
                    else {
                        updateLoginUser($_SESSION["login_users"], $_POST["login"]);
                        $_SESSION["login_users"] = $_POST["login"];
                        $_SESSION["alert"] = array("message" => "L'adresse mail a été modifiée avec succès.", 
                                                   "type" => "success");
                    }
                    unset($_POST["login"]);
                    header("Location: ./?page=profil");
                    exit();
                }
                break;
            case "modifier_mdp":
                if (isset($_POST["password"]) && isset($_POST["confirmPassword"]) && isset($_POST["oldPassword"])) {
                    if (empty(trim($_POST["oldPassword"]))) {
                        $_SESSION["alert"] = array("message" => "L'ancien mot de passe ne doit pas être vide.", 
                                                   "type" => "danger");
                    }
                    else if (hash("sha512", htmlspecialchars($_POST["oldPassword"])) != $_SESSION["password_users"]) {
                        $_SESSION["alert"] = array("message" => "L'ancien mot de passe est incorrect.", 
                                                   "type" => "danger");
                    }
                    else if (empty(trim($_POST["password"]))) {
                        $_SESSION["alert"] = array("message" => "Le nouveau mot de passe ne doit pas être vide.", 
                                                   "type" => "danger");
                    }
                    else if (strlen(trim($_POST["password"])) < 8) {
                        $_SESSION["alert"] = array("message" => "Le nouveau mot de passe doit contenir au moins 8 caractères.", 
                                                   "type" => "danger");
                    }
                    else if ($_POST["password"] != $_POST["confirmPassword"]) {
                        $_SESSION["alert"] = array("message" => "Le mot de passe ne correspond pas avec la confirmation du mot de passe.", 
                                                   "type" => "danger");
                    }
                    else {
                        updatePasswordUser($_SESSION["login_users"], $_POST["password"]);
                        $_SESSION["password_users"] = hash("sha512", htmlspecialchars($_POST["password"]));
                        $_SESSION["alert"] = array("message" => "Le mot de passe a été modifié avec succès.", 
                                                   "type" => "success");
                    }
                    unset($_POST["password"]);
                    unset($_POST["confirmPassword"]);
                    unset($_POST["oldPassword"]);
                    header("Location: ./?page=profil");
                    exit();
                }
                break;
            case "ajouter_adresse":
                if(isset($_POST["streetNbAddress"]) && isset($_POST["streetAddress"]) && isset($_POST["postalCodeAddress"]) 
                    && isset($_POST["cityAddress"]) && isset($_POST["countryAddress"])) {
                    if (empty(trim($_POST["streetNbAddress"])) || empty(trim($_POST["streetAddress"])) || empty(trim($_POST["postalCodeAddress"])) 
                        || empty(trim($_POST["cityAddress"])) || empty(trim($_POST["countryAddress"]))) {
                        $_SESSION["alert"] = array("message" => "Tous les champs doivent être remplis.", 
                                                   "type" => "danger");
                    }
                    else if (!ctype_digit(trim($_POST["streetNbAddress"]))) {
                        $_SESSION["alert"] = array("message" => "Le numéro de rue doit être un nombre.", 
                                                   "type" => "danger");
                    }
                    else if (!ctype_digit(trim($_POST["postalCodeAddress"]))) {
                        $_SESSION["alert"] = array("message" => "Le code postal doit être un nombre.", 
                                                   "type" => "danger");
                    }
                    else if (!ctype_alpha(str_replace(' ', '', trim($_POST["cityAddress"])))) {
                        $_SESSION["alert"] = array("message" => "La ville ne doit contenir que des lettres.", 
                                                   "type" => "danger");
                    }
                    else if (!ctype_alpha(str_replace(' ', '', trim($_POST["countryAddress"])))) {
                        $_SESSION["alert"] = array("message" => "Le pays ne doit contenir que des lettres.", 
                                                   "type" => "danger");
                    }
                    else {
                        addAddress($_SESSION["id_users"], $_POST["streetNbAddress"], $_POST["streetAddress"], 
                                   $_POST["postalCodeAddress"], $_POST["cityAddress"], $_POST["countryAddress"]);
                        $_SESSION["addresses_users"] = getUserAddresses($_SESSION["id_users"]);
                        $_SESSION["alert"] = array("message" => "L'adresse a été ajoutée avec succès.", 
                                                   "type" => "success");
                        unset($_POST["streetNbAddress"]);
                        unset($_POST["streetAddress"]);
                        unset($_POST["postalCodeAddress"]);
                        unset($_POST["cityAddress"]);
                        unset($_POST["countryAddress"]);
                        header("Location: ./?page=profil");
                        exit();
                    }
                }
                break;
            case "modifier_adresse":
                if(isset($_POST["streetNbAddress"]) && isset($_POST["streetAddress"]) && isset($_POST["postalCodeAddress"]) 
                    && isset($_POST["cityAddress"]) && isset($_POST["countryAddress"])) {
                    if (empty(trim($_POST["streetNbAddress"])) || empty(trim($_POST["streetAddress"])) || empty(trim($_POST["postalCodeAddress"])) 
                        || empty(trim($_POST["cityAddress"])) || empty(trim($_POST["countryAddress"]))) {
                        $_SESSION["alert"] = array("message" => "Tous les champs doivent être remplis.", 
                                                   "type" => "danger");
                    }
                    else if (!ctype_digit(trim($_POST["streetNbAddress"]))) {
                        $_SESSION["alert"] = array("message" => "Le numéro de rue doit être un nombre.", 
                                                   "type" => "danger");
                    }
                    else if (!ctype_digit(trim($_POST["postalCodeAddress"]))) {
                        $_SESSION["alert"] = array("message" => "Le code postal doit être un nombre.", 
                                                   "type" => "danger");
                    }
                    else if (!ctype_alpha(str_replace(' ', '', trim($_POST["cityAddress"])))) {
                        $_SESSION["alert"] = array("message" => "La ville ne doit contenir que des lettres.", 
                                                   "type" => "danger");
                    }
                    else if (!ctype_alpha(str_replace(' ', '', trim($_POST["countryAddress"])))) {
                        $_SESSION["alert"] = array("message" => "Le pays ne doit contenir que des lettres.", 
                                                   "type" => "danger");
                    }
                    else {
                        updateAddress($_POST["addressId"], $_POST["streetNbAddress"], $_POST["streetAddress"], 
                                      $_POST["postalCodeAddress"], $_POST["cityAddress"], $_POST["countryAddress"]);
                        $_SESSION["addresses_users"] = getUserAddresses($_SESSION["id_users"]);
                        $_SESSION["alert"] = array("message" => "L'adresse a été modifiée avec succès.", 
                                                   "type" => "success");
                        unset($_POST["addressId"]);
                        unset($_POST["streetNbAddress"]);
                        unset($_POST["streetAddress"]);
                        unset($_POST["postalCodeAddress"]);
                        unset($_POST["cityAddress"]);
                        unset($_POST["countryAddress"]);
                        header("Location: ./?page=profil");
                        exit();
                    }
                }
                break;
            case "supprimer_adresse":
                if (isset($_POST["addressId"])) {
                    deleteAddress($_POST["addressId"]);
                    $_SESSION["addresses_users"] = getUserAddresses($_SESSION["id_users"]);
                    $_SESSION["alert"] = array("message" => "L'adresse a été supprimée avec succès.", 
                                               "type" => "success");
                    unset($_POST["addressId"]);
                    header("Location: ./?page=profil");
                    exit();
                }
                break;
            case "deconnexion":
                logout();
                header("Location: ./?page=profil");
                exit();
        }
    }
    $user = array(
        "name" => $_SESSION["name_users"],
        "last_name" => $_SESSION["last_name_users"],
        "login" => $_SESSION["login_users"],
        "addresses" => $_SESSION["addresses_users"],
        "role" => $_SESSION["role_users"],
        "id" => $_SESSION["id_users"]
    );
    $nbAddresses = count($user["addresses"]);

    $title = "Profil";
    include "$filePath/view/header.php";
    include "$filePath/view/viewProfile.php";
    include "$filePath/view/footer.php";
}
else {
    header("Location: ./?page=connexion");
    exit();
}
?>