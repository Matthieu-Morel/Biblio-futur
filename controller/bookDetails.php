<?php
include "$filePath/model/books.php";

$id = $_GET["id"];

$book = getBookDetailsById($id);

$title = "Détails";
include "$filePath/view/header.php";
include "$filePath/view/viewBookDetails.php";
include "$filePath/view/footer.php";
?>