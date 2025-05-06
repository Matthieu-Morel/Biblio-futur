        <main class="flex-grow-1" style="background-color: #dddddd;">
            <h1 class="display-5 text-center mb-3">Administration</h1>
            <h2 class="fs-4 text-center mb-4">Panneau de gestion</h2>
            <div class="container w-75">
                <ul class="list-unstyled d-flex flex-row justify-content-around flex-wrap row-gap-2 border border-dark rounded py-3 px-2">
                    <li class="list-unstyled">
                        <a href="./?page=admin&page_admin=livres" class="btn btn-primary">Gestion des livres</a>
                    </li>
                    <li class="list-unstyled">
                        <a href="./?page=admin&page_admin=auteurs" class="btn btn-primary">Gestion des auteurs</a>
                    </li>
                    <li class="list-unstyled">
                        <a href="./?page=admin&page_admin=categories" class="btn btn-primary">Gestion des catégories</a>
                    </li>
                    <li class="list-unstyled">
                        <a href="./?page=admin&page_admin=editeurs" class="btn btn-primary">Gestion des éditeurs</a>
                    </li>
                </ul>
            </div>

            <h2 class="fs-4 text-center mb-4">Gestion des catégories</h2>
            <div class="container d-flex flex-column row-gap-2 w-50">
                <?php foreach($categories as $categorie){ ?>
                    <div class="container d-flex flex-row justify-content-between border border-primary rounded mb-3 p-3 column-gap-3">
                        <h3 class="fs-5 text-center mb-0 d-flex align-items-center"><?= $categorie["title_category"]  ?></h3>
                        <div class="d-flex flex-row align-items-center column-gap-3">
                            <button class="btn btn-primary" style="height: fit-content;" type="button" data-bs-toggle="modal" data-bs-target="#updateCategoryModal<?= $categorie["id_category"] ?>">Modifier</button>
                            <button class="btn btn-danger" style="height: fit-content;" type="button" data-bs-toggle="modal" data-bs-target="#removeCategoryModal<?= $categorie["id_category"] ?>">Supprimer</button>
                        </div>
                    </div>
                <?php } ?>

                <div class="container d-flex flex-row justify-content-center mb-3">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Ajouter une catégorie</button>
                </div>
            </div>

            <div class="modal fade" id="addCategoryModal" tabindex="-1">   
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="./?page=admin&page_admin=categories&action=ajouter_categorie" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title">Ajout d'une catégorie</h5>
                                <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title_category" class="form-label">Nom de la catégorie</label>
                                    <input name="title_category" type="text" class="form-control" id="title_category" required>
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

            <?php foreach($categories as $categorie){ ?>
                <div class="modal fade" id="updateCategoryModal<?= $categorie["id_category"] ?>" tabindex="-1">   
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="./?page=admin&page_admin=categories&action=modifier_categorie" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modification d'une catégorie</h5>
                                    <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="title_category" class="form-label">Prénom de l'auteur</label>
                                        <input name="title_category" value="<?= $categorie["title_category"] ?>" type="text" class="form-control" id="title_category" required>
                                    </div>
                                    <input type="hidden" name="id_category" value="<?= $categorie["id_category"] ?>">
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

            <?php foreach($categories as $categorie){ ?>
                <div class="modal fade" id="removeCategoryModal<?= $categorie["id_category"] ?>" tabindex="-1">   
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="./?page=admin&page_admin=categories&action=supprimer_categorie" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Suppression d'une catégorie</h5>
                                    <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Êtes-vous sûr de vouloir supprimer la catégorie <?= $categorie["title_category"] ?> ?</p>
                                    <input type="hidden" name="id_category" value="<?= $categorie["id_category"] ?>">
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