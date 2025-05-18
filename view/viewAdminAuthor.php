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

            <h2 class="fs-4 text-center mb-4">Gestion des auteurs</h2>
            <div class="container d-flex flex-column row-gap-2 w-50">
                <?php foreach($authors as $author){ ?>
                    <div class="container d-flex flex-column flex-md-row justify-content-between border border-primary rounded mb-3 p-3 column-gap-3 row-gap-3">
                        <h3 class="fs-5 text-center mb-0 d-flex align-items-center align-self-center"><?= $author["name_author"] ?> <?= $author["last_name_author"] ?></h3>
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center column-gap-3 row-gap-3">
                            <button class="btn btn-primary" style="height: fit-content;" type="button" data-bs-toggle="modal" data-bs-target="#updateAuthorModal<?= $author["id_author"] ?>">Modifier</button>
                            <button class="btn btn-danger" style="height: fit-content;" type="button" data-bs-toggle="modal" data-bs-target="#removeAuthorModal<?= $author["id_author"] ?>">Supprimer</button>
                        </div>
                    </div>
                <?php } ?>

                <div class="container d-flex flex-row justify-content-center mb-3">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addAuthorModal">Ajouter un auteur</button>
                </div>
            </div>

            <div class="modal fade" id="addAuthorModal" tabindex="-1">   
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="./?page=admin&page_admin=auteurs&action=ajouter_auteur" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title">Ajout d'un auteur</h5>
                                <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name_author" class="form-label">Prénom de l'auteur</label>
                                    <input name="name_author" type="text" class="form-control" id="name_author" required>
                                </div>
                                <div class="mb-3">
                                    <label for="last_name_author" class="form-label">Nom de l'auteur</label>
                                    <input name="last_name_author" type="text" class="form-control" id="last_name_author" required>
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

            <?php foreach($authors as $author){ ?>
                <div class="modal fade" id="updateAuthorModal<?= $author["id_author"] ?>" tabindex="-1">   
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="./?page=admin&page_admin=auteurs&action=modifier_auteur" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modification d'un auteur</h5>
                                    <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name_author" class="form-label">Prénom de l'auteur</label>
                                        <input name="name_author" value="<?= $author["name_author"] ?>" type="text" class="form-control" id="name_author" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name_author" class="form-label">Nom de l'auteur</label>
                                        <input name="last_name_author" value="<?= $author["last_name_author"] ?>" type="text" class="form-control" id="last_name_author" required>
                                    </div>
                                    <input type="hidden" name="id_author" value="<?= $author["id_author"] ?>">
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

            <?php foreach($authors as $author){ ?>
                <div class="modal fade" id="removeAuthorModal<?= $author["id_author"] ?>" tabindex="-1">   
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="./?page=admin&page_admin=auteurs&action=supprimer_auteur" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Suppression d'un auteur</h5>
                                    <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Êtes-vous sûr de vouloir supprimer l'auteur <?= $author["name_author"] ?> <?= $author["last_name_author"] ?> ?</p>
                                    <input type="hidden" name="id_author" value="<?= $author["id_author"] ?>">
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