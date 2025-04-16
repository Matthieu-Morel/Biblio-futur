<?php
function mainController(string $page): string{
    $controllers = array(
        "default" => "home.php",
        "accueil" => "home.php",
        "catalogue" => "catalog.php",
        "commande" => "order.php",
        "profil" => "profile.php",
        "connexion" => "profileConnection.php",
        "inscription" => "profileRegistration.php",
        "details" => "bookDetails.php",
        "anciennes_commandes" => "oldOrders.php",
    );

    if(array_key_exists($page, $controllers)){
        return $controllers[$page];
    }
    else{
        return $controllers["default"];
    }
}
?>