<?php
include_once "$filePath/model/books.php";

$latestBooks = getLatestBooks();
$bestSellers = getBestSellers();

$title = "Accueil";
include "$filePath/view/header.php";
include "$filePath/view/viewHome.php";
include "$filePath/view/footer.php";
?>