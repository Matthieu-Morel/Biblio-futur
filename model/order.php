<?php
include_once "database.php";

function createOrder($id_user) : void
{
    $connection = connectBDD();

    $query = $connection->prepare("INSERT INTO ORDERS (date_created_orders, confirmed_orders, id_users) 
                                    VALUES (:date_created_orders, :confirmed_orders, :id_users)");
    $query->bindValue(":date_created_orders", date("Y-m-d"), PDO::PARAM_STR);
    $query->bindValue(":confirmed_orders", FALSE, PDO::PARAM_BOOL);
    $query->bindValue(":id_users", $id_user, PDO::PARAM_INT);
    $query->execute();
}

function addBookToOrder($quantity, $id_book,  $id_order) : void
{
    $connection = connectBDD();

    $query = $connection->prepare("INSERT INTO ORDERS_LINE (quantity_ordered, id_book, id_orders) 
                                    VALUES (:quantity_ordered, :id_book, :id_orders)");
    $query->bindValue(":quantity_ordered", $quantity, PDO::PARAM_INT);
    $query->bindValue(":id_book", $id_book, PDO::PARAM_INT);
    $query->bindValue(":id_orders", $id_order, PDO::PARAM_INT);
    $query->execute();
}

function updateBookInOrder($quantity, $id_orders_line) : void
{
    $connection = connectBDD();

    $query = $connection->prepare("UPDATE ORDERS_LINE SET quantity_ordered = :quantity_ordered WHERE id_orders_line = :id_orders_line");
    $query->bindValue(":quantity_ordered", $quantity, PDO::PARAM_INT);
    $query->bindValue(":id_orders_line", $id_orders_line, PDO::PARAM_INT);
    $query->execute();
}

function deleteBookFromOrder($id_orders_line) : void
{
    $connection = connectBDD();

    $query = $connection->prepare("DELETE FROM ORDERS_LINE WHERE id_orders_line = :id_orders_line");
    $query->bindValue(":id_orders_line", $id_orders_line, PDO::PARAM_INT);
    $query->execute();
}

function getCurrentOrder($id_user) : array
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM ORDERS 
                                    JOIN ORDERS_LINE ON ORDERS.id_orders = ORDERS_LINE.id_orders
                                    JOIN BOOK ON ORDERS_LINE.id_book = BOOK.id_book
                                    WHERE ORDERS.id_users = :id_users AND confirmed_orders = FALSE");
    $query->bindValue(":id_users", $id_user, PDO::PARAM_INT);
    $query->execute();

    $order = $query->fetchAll(PDO::FETCH_ASSOC);
    return $order;
}

function getCurrentIdOrder($id_user){
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM ORDERS 
                                    WHERE id_users = :id_users 
                                    AND confirmed_orders = FALSE");
    $query->bindValue(":id_users", $id_user, PDO::PARAM_INT);
    $query->execute();

    $order = $query->fetch(PDO::FETCH_ASSOC);
    return $order['id_orders'];
}

function confirmOrder($id_user, $address, $price_before_tax, $id_order) : void
{
    $connection = connectBDD();

    $query = $connection->prepare("UPDATE ORDERS 
                                    SET confirmed_orders = TRUE, id_address = :id_address
                                    WHERE id_users = :id_users 
                                    AND confirmed_orders = FALSE;
                                    
                                    INSERT INTO BILL (date_bill, vat_bill, price_before_tax_bill, id_orders)
                                    VALUES (:date_bill, :vat_bill, :price_before_tax_bill, :id_orders)");
    $query->bindValue(":id_address", $address, PDO::PARAM_INT);
    $query->bindValue(":id_users", $id_user, PDO::PARAM_INT);
    $query->bindValue(":date_bill", date("Y-m-d"), PDO::PARAM_STR);
    $query->bindValue(":vat_bill", 20, PDO::PARAM_INT);
    $query->bindValue(":price_before_tax_bill", $price_before_tax, PDO::PARAM_STR);
    $query->bindValue(":id_orders", $id_order, PDO::PARAM_INT);
    $query->execute();
}

function getOldOrders($id_user) : array
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT date_bill, vat_bill, price_before_tax_bill, SUM(ORDERS_LINE.quantity_ordered) AS NbBooks 
                                    FROM BILL
                                    JOIN ORDERS ON BILL.id_orders = ORDERS.id_orders
                                    JOIN ORDERS_LINE ON ORDERS.id_orders = ORDERS_LINE.id_orders
                                    WHERE ORDERS.id_users = :id_users AND confirmed_orders = TRUE
                                    GROUP BY ORDERS.id_orders");
    $query->bindValue(":id_users", $id_user, PDO::PARAM_INT);
    $query->execute();

    $oldOrders = $query->fetchAll(PDO::FETCH_ASSOC);
    return $oldOrders;
}

function getOrderLineByBook($id_book, $id_user) : mixed
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM ORDERS_LINE 
                                    JOIN ORDERS ON ORDERS.id_orders = ORDERS_LINE.id_orders
                                    JOIN BOOK ON BOOK.id_book = ORDERS_LINE.id_book
                                    WHERE ORDERS.id_users = :id_users 
                                    AND confirmed_orders = FALSE
                                    AND ORDERS_LINE.id_book = :id_book");
    $query->bindValue(":id_users", $id_user, PDO::PARAM_INT);
    $query->bindValue(":id_book", $id_book, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
}
?>