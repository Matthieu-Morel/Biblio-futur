<?php 
include "$filePath/model/order.php";
include "$filePath/model/user.php";

if (isLogged()) {
    $oldOrders = getOldOrders($_SESSION["id_users"]);

    $title = "Anciennes commandes";
    include "$filePath/view/header.php";
    include "$filePath/view/viewOldOrders.php";
    include "$filePath/view/footer.php";
}
else {
    header("Location: ./?page=profil");
    exit();
}
?>