<?php
include_once "$filePath/model/books.php";
include_once "$filePath/model/favorites.php";
include_once "$filePath/model/user.php";
include_once "$filePath/model/favorites.php";

if(isLogged()){
    if (!isset($_POST["tri"])) {
        $_POST["tri"] = "trier par défaut";
    }
    
    if ($_POST["tri"] == "trier par défaut") {
        $sort = "trier par favoris";
        $books = getBooks();
    }
    else {
        $sort = "trier par défaut";
        $books = getFavoritesBooks($_SESSION["id_users"]);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "ajouter_favori" && isset($_GET["id"])) {
        addBookToFavorites($_GET["id"], $_SESSION["id_users"]);
        header("Location: ./?page=catalogue");
        exit();
    }
    else if(isset($_GET["action"]) && $_GET["action"] == "supprimer_favori" && isset($_GET["id"])) {
        removeBookFromFavorites($_GET["id"], $_SESSION["id_users"]);
        header("Location: ./?page=catalogue");
        exit();
    }

    $favorites = getFavoritesByUserId($_SESSION["id_users"]);
}

if (isset($_POST["research"])) {
    $books = getBooksBySearch($_POST["research"]);
}
else if(!isset($books)){
    $books = getBooks();
}

$title = "Catalogue";
include "$filePath/view/header.php";
include "$filePath/view/viewCatalog.php";
include "$filePath/view/footer.php";
?>