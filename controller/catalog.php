<?php
include "$filePath/model/books.php";

if (!isset($_POST["tri"])) {
    $_POST["tri"] = "trier par défaut";
}

if ($_POST["tri"] == "trier par défaut") {
    $sort = "trier par prix";
    $books = getBooks();
}
else {
    $sort = "trier par défaut";
    $books = getBooksSortedByPrice();
}

if (isset($_POST["research"])) {
    $books = getBooksBySearch($_POST["research"]);
}

$title = "Catalogue";
include "$filePath/view/header.php";
include "$filePath/view/viewCatalog.php";
include "$filePath/view/footer.php";
?>