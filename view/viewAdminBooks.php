        <main class="flex-grow-1" style="background-color: #dddddd;">
            <h1 class="display-5 text-center mb-3">Administration</h1>
            <h2 class="fs-4 text-center mb-4">Panneau de gestion</h2>
            <div class="container w-75">
                <ul class="list-unstyled d-flex flex-row justify-content-around flex-wrap row-gap-2 border border-dark rounded py-3 px-2">
                    <li class="list-unstyled col-12 col-md-6 col-lg-3 px-2 d-flex justify-content-center">
                        <a href="./?page=admin&page_admin=livres" class="btn btn-primary">Gestion des livres</a>
                    </li>
                    <li class="list-unstyled col-12 col-md-6 col-lg-3 px-2 d-flex justify-content-center">
                        <a href="./?page=admin&page_admin=auteurs" class="btn btn-primary">Gestion des auteurs</a>
                    </li>
                    <li class="list-unstyled col-12 col-md-6 col-lg-3 px-2 d-flex justify-content-center">
                        <a href="./?page=admin&page_admin=categories" class="btn btn-primary">Gestion des catégories</a>
                    </li>
                    <li class="list-unstyled col-12 col-md-6 col-lg-3 px-2 d-flex justify-content-center">
                        <a href="./?page=admin&page_admin=editeurs" class="btn btn-primary">Gestion des éditeurs</a>
                    </li>
                </ul>
            </div>

            <h2 class="fs-4 text-center mb-4">Gestion des livres</h2>
            <div class="container d-flex flex-column row-gap-2 w-50">
                <?php foreach($books as $book){ ?>
                    <div class="container d-flex flex-column flex-md-row justify-content-between border border-primary rounded mb-3 p-3 column-gap-3 row-gap-3">
                        <h3 class="fs-5 text-center mb-0 d-flex align-items-center"><span class="text-decoration-underline w-100"><?= $book["title_book"] ?></span></h3>
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center column-gap-3 row-gap-3">
                            <button class="btn btn-primary" style="height: fit-content;" type="button" data-bs-toggle="modal" data-bs-target="#updateBookModal<?= $book["id_book"] ?>">Modifier</button>
                            <button class="btn btn-danger" style="height: fit-content;" type="button" data-bs-toggle="modal" data-bs-target="#removeBookModal<?= $book["id_book"] ?>">Supprimer</button>
                        </div>
                    </div>
                <?php } ?>

                <div class="container d-flex flex-row justify-content-center mb-3">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addBookModal">Ajouter un livre</button>
                </div>
            </div>

            <div class="modal fade" id="addBookModal" tabindex="-1">   
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form enctype="multipart/form-data" action="./?page=admin&page_admin=livres&action=ajouter_livre" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title">Ajout d'un livre</h5>
                                <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title_book" class="form-label">Titre du livre</label>
                                    <input name="title_book" type="text" class="form-control" id="title_book" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description_book" class="form-label">Description du livre</label>
                                    <textarea class="form-control" name="description_book" id="description_book" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="price_book" class="form-label">Prix du livre (en euros)</label>
                                    <input name="price_book" type="number" min="0" class="form-control" id="price_book" required>
                                </div>
                                <div class="mb-3">
                                    <label for="picture_book" class="form-label">Image du livre</label>
                                    <input name="picture_book" type="file" class="form-control" id="picture_book" accept="image/*" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stock_quantity" class="form-label">Quantité en stock</label>
                                    <input name="stock_quantity" type="number" min="0" class="form-control" id="stock_quantity" required>
                                </div>
                                <div class="mb-3">
                                    <label for="release_date_book" class="form-label">Date de parution</label>
                                    <input name="release_date_book" type="date" class="form-control" id="release_date_book" required>
                                </div>
                                <div class="mb-3">
                                    <label for="author" class="form-label">Auteur</label>
                                    <select name="id_author" class="form-select" id="author" required>
                                        <option value="" selected disabled>Choisir un auteur</option>
                                        <?php foreach($authors as $author){ ?>
                                            <option value="<?= $author["id_author"] ?>"><?= $author["name_author"] ?> <?= $author["last_name_author"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Catégorie</label>
                                    <select name="id_category" class="form-select" id="category" required>
                                        <option value="" selected disabled>Choisir une catégorie</option>
                                        <?php foreach($categories as $category){ ?>
                                            <option value="<?= $category["id_category"] ?>"><?= $category["title_category"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="publisher" class="form-label">Editeur</label>
                                    <select name="id_publisher" class="form-select" id="publisher" required>
                                        <option value="" selected disabled>Choisir un éditeur</option>
                                        <?php foreach($publishers as $publisher){ ?>
                                            <option value="<?= $publisher["id_publisher"] ?>"><?= $publisher["label_publisher"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php foreach($books as $book){ ?>
                <div class="modal fade" id="updateBookModal<?= $book["id_book"] ?>" tabindex="-1">   
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form enctype="multipart/form-data" action="./?page=admin&page_admin=livres&action=modifier_livre" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modification d'un livre</h5>
                                    <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="title_book" class="form-label">Titre du livre</label>
                                        <input value="<?= $book["title_book"] ?>" name="title_book" type="text" class="form-control" id="title_book" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description_book" class="form-label">Description du livre</label>
                                        <textarea class="form-control" name="description_book" id="description_book" required><?= $book["description_book"] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_book" class="form-label">Prix du livre (en euros)</label>
                                        <input value="<?= $book["price_book"] ?>" name="price_book" type="number" min="0" class="form-control" id="price_book" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="picture_book" class="form-label">Image du livre</label>
                                        <input value="" name="picture_book" type="file" class="form-control" id="picture_book" accept="image/*">
                                        <input type="text" value="Image actuelle : <?= $book["picture_book"] ?>" disabled class="form-control bg-transparent border-0">
                                        <input type="text" value="<?= $book["picture_book"] ?>" name="old_picture_book" hidden>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock_quantity" class="form-label">Quantité en stock</label>
                                        <input value="<?= $book["stock_quantity"] ?>" name="stock_quantity" type="number" min="0" class="form-control" id="stock_quantity" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="release_date_book" class="form-label">Date de parution</label>
                                        <input value="<?= $book["release_date_book"] ?>" name="release_date_book" type="date" class="form-control" id="release_date_book" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="author" class="form-label">Auteur</label>
                                        <select name="id_author" class="form-select" id="author" required>
                                            <?php foreach($authors as $author){ ?>
                                                <option value="<?= $author["id_author"] ?>" <?php if($author["id_author"] == $book["id_author"]){echo "selected";} ?>><?= $author["name_author"] ?> <?= $author["last_name_author"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Catégorie</label>
                                        <select name="id_category" class="form-select" id="category" required>
                                            <?php foreach($categories as $category){ ?>
                                                <option value="<?= $category["id_category"] ?>" <?php if($category["id_category"] == $book["id_category"]){echo "selected";} ?>><?= $category["title_category"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="publisher" class="form-label">Editeur</label>
                                        <select name="id_publisher" class="form-select" id="publisher" required>
                                            <?php foreach($publishers as $publisher){ ?>
                                                <option value="<?= $publisher["id_publisher"] ?>" <?php if($publisher["id_publisher"] == $book["id_publisher"]){echo "selected";} ?>><?= $publisher["label_publisher"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="id_book" value="<?= $book["id_book"] ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php foreach($books as $book){ ?>
                <div class="modal fade" id="removeBookModal<?= $book["id_book"] ?>" tabindex="-1">   
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="./?page=admin&page_admin=livres&action=supprimer_livre" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Suppression d'un livre</h5>
                                    <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Êtes-vous sûr de vouloir supprimer le livre <span class="text-decoration-underline"><?= $book["title_book"] ?></span> ?</p>
                                    <input type="hidden" name="id_book" value="<?= $book["id_book"] ?>">
                                    <input type="hidden" name="picture_book" value="<?= $book["picture_book"] ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </main>