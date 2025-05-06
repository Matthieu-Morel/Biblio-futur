<?php 
include_once "$filePath/model/user.php";
include_once "$filePath/model/author.php";
include_once "$filePath/model/books.php";
include_once "$filePath/model/category.php";
include_once "$filePath/model/publisher.php";

if(isLogged()){
    if($_SESSION["role_users"] == "admin"){

        if(isset($_GET["action"])){
            switch ($_GET["action"]) {
                case "ajouter_livre":
                    if(isset($_POST["title_book"]) && isset($_POST["description_book"]) && isset($_POST["price_book"]) &&
                       isset($_POST["stock_quantity"]) && isset($_POST["release_date_book"]) && isset($_POST["id_author"]) &&
                       isset($_POST["id_category"]) && isset($_POST["id_publisher"]))
                    {
                        if(empty($_POST["title_book"]) || empty($_POST["description_book"]) || empty($_POST["price_book"]) || 
                           empty($_POST["stock_quantity"]) || empty($_POST["release_date_book"]) || 
                           empty($_POST["id_author"]) || empty($_POST["id_category"]) || empty($_POST["id_publisher"])){
                            $_SESSION["alert"] = array("message" => "Veuillez remplir tous les champs.", 
                                                        "type" => "danger");
                        } else if(!ctype_digit($_POST["price_book"])){
                            $_SESSION["alert"] = array("message" => "Le prix doit être un nombre entier supérieur à 0.", 
                                                        "type" => "danger");
                        } else if(!ctype_digit($_POST["stock_quantity"])){
                            $_SESSION["alert"] = array("message" => "La quantité en stock doit être un nombre entier supérieur à 0.", 
                                                        "type" => "danger");
                        } else if(!isset($_FILES["picture_book"]) || $_FILES["picture_book"]["error"] != UPLOAD_ERR_OK){
                            $_SESSION["alert"] = array("message" => "Il y a eu une erreur lors du téléchargement de l'image.", 
                                                        "type" => "danger");
                        } else if (file_exists("$filePath/img/books/".basename($_FILES["picture_book"]["name"]))) {
                            $_SESSION["alert"] = array("message" => "Le nom de l'image existe déjà. Veuillez choisir un autre nom.", 
                                                        "type" => "danger");
                        } else if($_FILES["picture_book"]["size"] > 5000000){
                            $_SESSION["alert"] = array("message" => "La taille de l'image ne doit pas dépasser 5 Mo.", 
                                                        "type" => "danger");
                        } else if(!in_array($_FILES["picture_book"]["type"], ["image/jpeg", "image/png", "image/gif"])){
                            $_SESSION["alert"] = array("message" => "Les formats d'image autorisés sont JPEG, PNG et GIF.", 
                                                        "type" => "danger");
                        } else if ($_POST["release_date_book"] > date("Y-m-d")){
                            $_SESSION["alert"] = array("message" => "La date de parution doit être une date passée.", 
                                                        "type" => "danger");
                        } else {
                            $target_dir = "$filePath/img/books/";
                            $target_file = $target_dir . basename($_FILES["picture_book"]["name"]);
                            move_uploaded_file($_FILES["picture_book"]["tmp_name"], $target_file);
    
                            $pictureBook = basename($_FILES["picture_book"]["name"]);
                            $_POST["date_added_book"] = date("Y-m-d");
    
                            addBook($_POST["title_book"], $_POST["description_book"], $_POST["price_book"], $pictureBook, 
                                    $_POST["stock_quantity"], $_POST["release_date_book"], $_POST["date_added_book"], 
                                    $_POST["id_author"], $_POST["id_category"], $_POST["id_publisher"]);
                            $_SESSION["alert"] = array("message" => "Le livre a été ajouté avec succès.", 
                                                        "type" => "success");
                        }
                    } else {
                        $_SESSION["alert"] = array("message" => "Erreur lors de l'ajout du livre.", 
                                                    "type" => "danger");
                    }
                    break;
                case "modifier_livre":
                    if(isset($_POST["id_book"]) && isset($_POST["title_book"]) && isset($_POST["description_book"]) && 
                       isset($_POST["price_book"]) && isset($_POST["stock_quantity"]) && isset($_POST["release_date_book"]) && 
                       isset($_POST["id_author"]) && isset($_POST["id_category"]) && isset($_POST["id_publisher"]))
                    {
                        if(empty($_POST["title_book"]) || empty($_POST["description_book"]) || empty($_POST["price_book"]) || 
                           empty($_POST["stock_quantity"]) || empty($_POST["release_date_book"]) || 
                           empty($_POST["id_author"]) || empty($_POST["id_category"]) || empty($_POST["id_publisher"]))
                        {
                            $_SESSION["alert"] = array("message" => "Veuillez remplir tous les champs.", 
                                                        "type" => "danger");
                        } else if(!ctype_digit($_POST["price_book"])){
                            $_SESSION["alert"] = array("message" => "Le prix doit être un nombre entier supérieur à 0.", 
                                                        "type" => "danger");
                        } else if(!ctype_digit($_POST["stock_quantity"])){
                            $_SESSION["alert"] = array("message" => "La quantité en stock doit être un nombre entier supérieur à 0.", 
                                                        "type" => "danger");
                        } else if ($_POST["release_date_book"] > date("Y-m-d")){
                            $_SESSION["alert"] = array("message" => "La date de parution doit être une date passée.", 
                                                        "type" => "danger");
                        } else {
                            $pictureBook = $_POST["old_picture_book"];
                            if (isset($_FILES["picture_book"]) && $_FILES["picture_book"]["error"] == UPLOAD_ERR_OK) {
                                if (file_exists("$filePath/img/books/".basename($_FILES["picture_book"]["name"])) 
                                    && $_POST["old_picture_book"] != $_FILES["picture_book"]["name"]) {
                                    $_SESSION["alert"] = array("message" => "Le nom de l'image existe déjà. Veuillez choisir un autre nom.", 
                                                                "type" => "danger");
                                } else if($_FILES["picture_book"]["size"] > 5000000){
                                    $_SESSION["alert"] = array("message" => "La taille de l'image ne doit pas dépasser 5 Mo.", 
                                                                "type" => "danger");
                                } else if(!in_array($_FILES["picture_book"]["type"], ["image/jpeg", "image/png", "image/gif"])){
                                    $_SESSION["alert"] = array("message" => "Les formats d'image autorisés sont JPEG, PNG et GIF.", 
                                                                "type" => "danger");
                                } else {
                                    $target_dir = "$filePath/img/books/";
                                    $target_file = $target_dir . basename($_FILES["picture_book"]["name"]);
                                    move_uploaded_file($_FILES["picture_book"]["tmp_name"], $target_file);
                                    $pictureBook = basename($_FILES["picture_book"]["name"]);
                                }
                            }
                            updateBook($_POST["id_book"], $_POST["title_book"], $_POST["description_book"], $_POST["price_book"], 
                                        $pictureBook, $_POST["stock_quantity"], $_POST["release_date_book"], 
                                        $_POST["id_author"], $_POST["id_category"], $_POST["id_publisher"]);
                            if ($_POST["old_picture_book"] != $pictureBook) {
                                unlink("$filePath/img/books/".$_POST["old_picture_book"]);
                            }
                            $_SESSION["alert"] = array("message" => "Le livre a été modifié avec succès.", 
                                                        "type" => "success");
                        }
                    } else {
                        $_SESSION["alert"] = array("message" => "Erreur lors de la modification du livre.", 
                                                    "type" => "danger");
                    }
                    break;
                case "supprimer_livre":
                    if(isset($_POST["id_book"])){
                        removeBook($_POST["id_book"]);
                        unlink("$filePath/img/books/".$_POST["picture_book"]);
                        $_SESSION["alert"] = array("message" => "Le livre a été supprimé avec succès.", 
                                                    "type" => "success");
                    } else {
                        $_SESSION["alert"] = array("message" => "Erreur lors de la suppression du livre.", 
                                                    "type" => "danger");
                    }
                    break;
                case "ajouter_auteur":
                    if(isset($_POST["name_author"]) && isset($_POST["last_name_author"])){
                        if(empty($_POST["name_author"]) || empty($_POST["last_name_author"])){
                            $_SESSION["alert"] = array("message" => "Veuillez remplir tous les champs.", 
                                                        "type" => "danger");
                        }
                        else if(!ctype_alpha(str_replace(" ", "", $_POST["name_author"])) || !ctype_alpha(str_replace(" ", "", $_POST["last_name_author"]))){
                            $_SESSION["alert"] = array("message" => "Le nom et le prénom de l'auteur doivent contenir uniquement des lettres.", 
                                                        "type" => "danger");
                        }
                        else if (strlen($_POST["name_author"]) > 50 || strlen($_POST["last_name_author"]) > 50) {
                            $_SESSION["alert"] = array("message" => "Le nom et le prénom de l'auteur ne doivent pas dépasser 50 caractères.", 
                                                        "type" => "danger");
                        }
                        else {
                            addAuthor($_POST["name_author"], $_POST["last_name_author"]);
                            $_SESSION["alert"] = array("message" => "L'auteur a été ajouté avec succès.", 
                                                        "type" => "success");
                        }
                    } else {
                        $_SESSION["alert"] = array("message" => "Erreur lors de l'ajout de l'auteur.", 
                                                    "type" => "danger");
                    }
                    break;
                case "modifier_auteur":
                    if(isset($_POST["id_author"] ) && isset($_POST["name_author"]) && isset($_POST["last_name_author"])){
                        if(empty($_POST["name_author"]) || empty($_POST["last_name_author"])){
                            $_SESSION["alert"] = array("message" => "Veuillez remplir tous les champs.", 
                                                        "type" => "danger");
                        }
                        else if(!ctype_alpha(str_replace(" ", "", $_POST["name_author"])) || !ctype_alpha(str_replace(" ", "", $_POST["last_name_author"]))){
                            $_SESSION["alert"] = array("message" => "Le nom et le prénom de l'auteur doivent contenir uniquement des lettres.", 
                                                        "type" => "danger");
                        }
                        else if (strlen($_POST["name_author"]) > 50 || strlen($_POST["last_name_author"]) > 50) {
                            $_SESSION["alert"] = array("message" => "Le nom et le prénom de l'auteur ne doivent pas dépasser 50 caractères.", 
                                                        "type" => "danger");
                        }
                        else {
                            updateAuthor($_POST["id_author"], $_POST["name_author"], $_POST["last_name_author"]);
                            $_SESSION["alert"] = array("message" => "L'auteur a été modifié avec succès.", 
                                                        "type" => "success");
                        }
                    } else {
                        $_SESSION["alert"] = array("message" => "Erreur lors de la modification de l'auteur.", 
                                                    "type" => "danger");
                    }
                    break;
                case "supprimer_auteur":
                    if(isset($_POST["id_author"])){
                        removeAuthor($_POST["id_author"]);
                        $_SESSION["alert"] = array("message" => "L'auteur a été supprimé avec succès.", 
                                                    "type" => "success");
                    } else {
                        $_SESSION["alert"] = array("message" => "Erreur lors de la suppression de l'auteur.", 
                                                    "type" => "danger");
                    }
                    break;
                case "ajouter_categorie":
                    if(isset($_POST["title_category"])){
                        if(empty($_POST["title_category"])){
                            $_SESSION["alert"] = array("message" => "Veuillez indiquer le nom de la catégorie.", 
                                                        "type" => "danger");
                        } else if (strlen($_POST["title_category"]) > 50) {
                            $_SESSION["alert"] = array("message" => "Le nom de la catégorie ne doit pas dépasser 50 caractères.", 
                                                        "type" => "danger");
                        } else {
                            addCategory($_POST["title_category"]);
                            $_SESSION["alert"] = array("message" => "La catégorie a été ajoutée avec succès.", 
                                                        "type" => "success");
                        }
                    } else {
                        $_SESSION["alert"] = array("message" => "Erreur lors de l'ajout de la catégorie.", 
                                                    "type" => "danger");
                    }
                    break;
                case "modifier_categorie":
                    if(isset($_POST["id_category"] ) && isset($_POST["title_category"])){
                        if(empty($_POST["title_category"])){
                            $_SESSION["alert"] = array("message" => "Veuillez indiquer le nom de la catégorie.", 
                                                        "type" => "danger");
                        } else if (strlen($_POST["title_category"]) > 50) {
                            $_SESSION["alert"] = array("message" => "Le nom de la catégorie ne doit pas dépasser 50 caractères.", 
                                                        "type" => "danger");
                        } else {
                            updateCategory($_POST["id_category"], $_POST["title_category"]);
                            $_SESSION["alert"] = array("message" => "La catégorie a été modifiée avec succès.", 
                                                        "type" => "success");
                        }
                    } else {
                        $_SESSION["alert"] = array("message" => "Erreur lors de la modification de la catégorie.", 
                                                    "type" => "danger");
                    }
                    break;
                case "supprimer_categorie":
                    if(isset($_POST["id_category"])){
                        removeCategory($_POST["id_category"]);
                        $_SESSION["alert"] = array("message" => "La catégorie a été supprimée avec succès.", 
                                                    "type" => "success");
                    } else {
                        $_SESSION["alert"] = array("message" => "Erreur lors de la suppression de la catégorie.", 
                                                    "type" => "danger");
                    }
                    break;
                case "ajouter_editeur":
                    if(isset($_POST["label_publisher"])){
                        if(empty($_POST["label_publisher"])){
                            $_SESSION["alert"] = array("message" => "Veuillez indiquer le nom de l'éditeur.", 
                                                        "type" => "danger");
                        } else if (strlen($_POST["label_publisher"]) > 50) {
                            $_SESSION["alert"] = array("message" => "Le nom de l'éditeur ne doit pas dépasser 50 caractères.", 
                                                        "type" => "danger");
                        } else {
                            addPublisher($_POST["label_publisher"]);
                            $_SESSION["alert"] = array("message" => "L'éditeur a été ajouté avec succès.", 
                                                        "type" => "success");
                        }
                    } else {
                        $_SESSION["alert"] = array("message" => "Erreur lors de l'ajout de l'éditeur.", 
                                                    "type" => "danger");
                    }
                    break;
                case "modifier_editeur":
                    if(isset($_POST["label_publisher"]) && isset($_POST["id_publisher"])){
                        if(empty($_POST["label_publisher"])){
                            $_SESSION["alert"] = array("message" => "Veuillez indiquer le nom de l'éditeur.", 
                                                        "type" => "danger");
                        } else if (strlen($_POST["label_publisher"]) > 50) {
                            $_SESSION["alert"] = array("message" => "Le nom de l'éditeur ne doit pas dépasser 50 caractères.", 
                                                        "type" => "danger");
                        } else {
                            updatePublisher($_POST["id_publisher"], $_POST["label_publisher"]);
                            $_SESSION["alert"] = array("message" => "L'éditeur a été modifié avec succès.", 
                                                        "type" => "success");
                        }
                    } else {
                        $_SESSION["alert"] = array("message" => "Erreur lors de la modification de l'éditeur.", 
                                                    "type" => "danger");
                    }
                    break;
                case "supprimer_editeur":
                    if(isset($_POST["id_publisher"])){
                        removePublisher($_POST["id_publisher"]);
                        $_SESSION["alert"] = array("message" => "L'éditeur a été supprimé avec succès.", 
                                                    "type" => "success");
                    } else {
                        $_SESSION["alert"] = array("message" => "Erreur lors de la suppression de l'éditeur.", 
                                                    "type" => "danger");
                    }
                    break;
            }
            unset($_POST);
        }

        if (isset($_GET["page_admin"])){
            switch ($_GET["page_admin"]) {
                case "livres":
                    $books = getBooks();
                    $authors = getAuthors();
                    $categories = getCategories();
                    $publishers = getPublishers();
                    $title = "Administration - Livres";
                    $view = "viewAdminBooks";
                    break;
                case "auteurs":
                    $authors = getAuthors();
                    $title = "Administration - Auteurs";
                    $view = "viewAdminAuthor";
                    break;
                case "categories":
                    $categories = getCategories();
                    $title = "Administration - Catégories";
                    $view = "viewAdminCategory";
                    break;
                case "editeurs":
                    $publishers = getPublishers();
                    $title = "Administration - Editeurs";
                    $view = "viewAdminPublisher";
                    break;
                default:
                    $books = getBooks();
                    $authors = getAuthors();
                    $categories = getCategories();
                    $publishers = getPublishers();
                    $title = "Administration - Livres";
                    $view = "viewAdminBooks";
                    break;
            }
        }
        else {
            $books = getBooks();
            $authors = getAuthors();
            $categories = getCategories();
            $publishers = getPublishers();
            $title = "Administration - Livres";
            $view = "viewAdminBooks";
        }
        include "$filePath/view/header.php";
        include "$filePath/view/$view.php";
        include "$filePath/view/footer.php";
    }else{
        header("Location: ./?page=accueil");
        exit();
    }
}
?>