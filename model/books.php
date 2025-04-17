<?php
include_once "database.php";

function getBooks() : array
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM BOOK 
                                   JOIN AUTHOR ON BOOK.id_author = AUTHOR.id_author
                                   JOIN CATEGORY ON BOOK.id_category = CATEGORY.id_category");
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function getBooksBySearch($research) : array
{
    $connection = connectBDD();
    $research = htmlspecialchars($research);
    $research = "%$research%";

    $query = $connection->prepare("SELECT * FROM BOOK 
                                   JOIN AUTHOR ON BOOK.id_author = AUTHOR.id_author
                                   JOIN CATEGORY ON BOOK.id_category = CATEGORY.id_category
                                   WHERE BOOK.title_book LIKE :research
                                      OR BOOK.description_book LIKE :research
                                      OR AUTHOR.name_author LIKE :research
                                      OR AUTHOR.last_name_author LIKE :research
                                      OR CATEGORY.title_category LIKE :research");
    $query->bindValue(":research", $research, PDO::PARAM_STR);
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function getBookDetailsById($id) : array
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM BOOK 
                                   JOIN AUTHOR ON BOOK.id_author = AUTHOR.id_author
                                   JOIN CATEGORY ON BOOK.id_category = CATEGORY.id_category
                                   WHERE BOOK.id_book = :id");
    $query->bindValue(":id", $id, PDO::PARAM_STR);
    $query->execute();

    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function updateBookStockQuantity($id_book, $quantity) : void
{
    $connection = connectBDD();

    $query = $connection->prepare("UPDATE BOOK 
                                    SET stock_quantity = stock_quantity - :quantity 
                                    WHERE id_book = :id_book");
    $query->bindValue(":quantity", $quantity, PDO::PARAM_INT);
    $query->bindValue(":id_book", $id_book, PDO::PARAM_INT);
    $query->execute();
}

function getLatestBooks() : array
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM BOOK 
                                   JOIN AUTHOR ON BOOK.id_author = AUTHOR.id_author
                                   JOIN CATEGORY ON BOOK.id_category = CATEGORY.id_category
                                   ORDER BY BOOK.date_added_book DESC 
                                   LIMIT 3");
    $query->execute();

    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function getBestSellers() : array
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT BOOK.*, AUTHOR.*, CATEGORY.* FROM BOOK 
                                   JOIN AUTHOR ON BOOK.id_author = AUTHOR.id_author
                                   JOIN CATEGORY ON BOOK.id_category = CATEGORY.id_category
                                   JOIN ORDERS_LINE ON BOOK.id_book = ORDERS_LINE.id_book
                                   JOIN ORDERS ON ORDERS_LINE.id_orders = ORDERS.id_orders
                                   WHERE ORDERS.confirmed_orders = TRUE
                                   GROUP BY BOOK.id_book
                                   ORDER BY SUM(ORDERS_LINE.quantity_ordered) DESC
                                   LIMIT 3");
    $query->execute();

    $books = $query->fetchAll(PDO::FETCH_ASSOC);
    return $books;
}

function getFavoritesBooks($id_user) : array
{
    $connection = connectBDD();

    $query = $connection->prepare("SELECT BOOK.*, AUTHOR.*, CATEGORY.* FROM BOOK 
                                   JOIN AUTHOR ON BOOK.id_author = AUTHOR.id_author
                                   JOIN CATEGORY ON BOOK.id_category = CATEGORY.id_category
                                   JOIN TO_LIKE ON BOOK.id_book = TO_LIKE.id_book
                                   WHERE TO_LIKE.id_users = :id_users");
    $query->bindValue(":id_users", $id_user, PDO::PARAM_INT);
    $query->execute();

    $books = $query->fetchAll(PDO::FETCH_ASSOC);
    return $books;
}
?>