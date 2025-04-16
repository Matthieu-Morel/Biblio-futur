<?php
include "$filePath/model/order.php";
include "$filePath/model/user.php";
include "$filePath/model/books.php";

if(isLogged()){
    if(isset($_GET['action'])){
        switch($_GET['action']){
            case 'ajouter_au_panier':
                if(empty(getCurrentOrder($_SESSION['id_users']))){
                    createOrder($_SESSION['id_users']);
                }
                if(isset($_GET['id'])){
                    $orderLine = getOrderLineByBook($_GET['id'], $_SESSION['id_users']);
                    if($orderLine != false){
                        updateBookInOrder($orderLine['quantity_ordered'] + 1, $orderLine['id_orders_line']);
                        $_SESSION["alert"] = array("message" => "La quantité du livre a été mise à jour.", 
                                                   "type" => "success");
                    }
                    else{
                        addBookToOrder(1, $_GET['id'], getCurrentIdOrder($_SESSION['id_users']));
                        $_SESSION["alert"] = array("message" => "Le livre a été ajouté au panier.", 
                                                   "type" => "success");
                    }
                }
                break;
            case 'modifier_quantite':
                if(isset($_POST['quantity']) && isset($_POST['id_orders_line'])){
                    if(empty($_POST['quantity'])){
                        $_SESSION["alert"] = array("message" => "Veuillez remplir tous les champs.", 
                                                   "type" => "danger");
                    }
                    else if($_POST['quantity'] < 1){
                        $_SESSION["alert"] = array("message" => "La quantité doit être supérieure à 0.", 
                                                   "type" => "danger");
                    }
                    else{
                        updateBookInOrder($_POST['quantity'], $_POST['id_orders_line']);
                        $_SESSION["alert"] = array("message" => "La quantité du livre a été mise à jour.", 
                                                   "type" => "success");
                    }
                }
                break;
            case 'supprimer_livre':
                if(isset($_POST['id_orders_line'])){
                    deleteBookFromOrder($_POST['id_orders_line']);
                    $_SESSION["alert"] = array("message" => "Le livre a été supprimé du panier.", 
                                               "type" => "success");
                }
                break;
            case 'valider_commande':
                if(isset($_POST['address_order'])){
                    $order = getCurrentOrder($_SESSION['id_users']);
                    $canConfirm = true;
                    foreach($order as $orderLine){
                        if($orderLine["stock_quantity"] <= 0){
                            $_SESSION["alert"] = array("message" => "Le livre <span class='text-decoration-underline'>".$orderLine["title_book"]."</span> 
                            n'est plus disponible.", 
                                                       "type" => "danger");
                            $canConfirm = false;
                            break;
                        }
                        else if($orderLine["quantity_ordered"] > $orderLine["stock_quantity"]){
                            $_SESSION["alert"] = array("message" => "La quantité du livre <span class='text-decoration-underline'>".$orderLine["title_book"]."</span> 
                            est supérieure à la quantité disponible qui est de ".$orderLine["stock_quantity"].".", 
                                                       "type" => "danger");
                            $canConfirm = false;
                            break;
                        }
                    }
                    if($canConfirm){
                        confirmOrder($_SESSION['id_users'], $_POST['address_order'], $_POST["price_before_tax"], getCurrentIdOrder($_SESSION['id_users']));
                        foreach($order as $orderLine){
                            updateBookStockQuantity($orderLine['id_book'], $orderLine['quantity_ordered']);
                        }
                        $_SESSION["alert"] = array("message" => "La commande a été validée.", 
                                                   "type" => "success");
                    }
                }
        }
        header("Location: ./?page=commande");
        exit();
    }

    $order = getCurrentOrder($_SESSION['id_users']);
    
    $totalPrice = 0;
    foreach($order as $orderLine){
        $totalPrice += $orderLine['price_book'] * $orderLine['quantity_ordered'];
    }

    $addresses_user = $_SESSION['addresses_users'];

    $title = "Commande";
    include "$filePath/view/header.php";
    include "$filePath/view/viewOrder.php";
    include "$filePath/view/footer.php";
}
else{
    header("Location: ./?page=profil");
    exit();
}
?>