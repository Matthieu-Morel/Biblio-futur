        <main class="flex-grow-1" style="background-color: #dddddd;">
            <h1 class="display-5 text-center mb-3">Votre commande</h1>
            <?php if(!empty($order)){ ?>

                <div class="container d-flex flex-column row-gap-4 mb-3">
                    <?php foreach($order as $orderLine){ ?>
                        <div class="d-flex flex-row container-md border border-primary rounded p-3" style="max-width: 800px;">
                            <div class="col-3 d-flex justify-content-center">
                                <img style="height: 120px;" src="./img/books/<?= $orderLine["picture_book"] ?>" alt="image du livre">
                            </div>
                            <div class="d-flex flex-column row-gap-3 col-9">
                                <p class="text-center m-0"><span class="text-decoration-underline"><?= $orderLine["title_book"] ?></span></p>
                                <div class="d-flex flex-row column-gap-3 justify-content-around">
                                    <span>Prix unitaire : <?= $orderLine["price_book"] ?>&euro;</span>
                                    <span>Quantité : <?= $orderLine["quantity_ordered"] ?></span>
                                </div>
                                <div class="d-flex flex-row column-gap-3 justify-content-evenly">
                                    <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#updateOrderLineModal<?= $orderLine["id_orders_line"] ?>">Modifier</button>
                                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteOrderLineModal<?= $orderLine["id_orders_line"] ?>">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="d-flex flex-row container mb-3 w-auto justify-content-evenly column-gap-3">
                        <p class="mb-0">Prix total : <?= $totalPrice ?>&euro;</p>
                        <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#confirmOrderModal">Valider la commande</button>
                    </div>
                </div>

                <?php foreach($order as $orderLine){ ?>
                    <div class="modal fade" id="updateOrderLineModal<?= $orderLine["id_orders_line"] ?>" tabindex="-1">   
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <form action="./?page=commande&action=modifier_quantite" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modification de la quantité d'un article</h5>
                                        <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Quantité</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity" value="<?= $orderLine["quantity_ordered"] ?>" min="1" required>
                                        </div>
                                        <input type="hidden" name="id_orders_line" value="<?= $orderLine["id_orders_line"] ?>">
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

                <?php foreach($order as $orderLine){ ?>
                    <div class="modal fade" id="deleteOrderLineModal<?= $orderLine["id_orders_line"] ?>" tabindex="-1">   
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <form action="./?page=commande&action=supprimer_livre" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Suppression d'un article du panier</h5>
                                        <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Êtes-vous sûr de vouloir supprimer le livre "<span class="text-decoration-underline"><?= $orderLine["title_book"] ?></span>" du panier ?</p>
                                        <input type="hidden" name="id_orders_line" value="<?= $orderLine["id_orders_line"] ?>">
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

                <div class="modal fade" id="confirmOrderModal" tabindex="-1">   
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="./?page=commande&action=valider_commande" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Validation de la commande</h5>
                                    <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <label for="address">Choix de l'adresse de livraison</label>
                                    <select class="form-select mb-3" id="address" name="address_order" required>
                                        <option value="" disabled selected>Choisir une adresse</option>
                                        <?php foreach($addresses_user as $address){ ?>
                                            <option value="<?= $address["id_address"] ?>">
                                                <?= $address["street_nb_address"] ?> <?= $address["street_address"] ?>, 
                                                <?= $address["postal_code_address"] ?> <?= $address["city_address"] ?> <?= $address["country_address"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <p>Prix TTC : <?= $totalPrice*1.2 ?>&euro;</p>
                                    <input type="hidden" name="id_orders" value="<?= getCurrentIdOrder($_SESSION["id_users"]) ?>">
                                    <input type="hidden" name="price_before_tax" value="<?= $totalPrice ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            <?php } else { ?>
                <div class="container mt-5">
                    <p class="fs-4 text-center">Votre panier est vide.</p>
                </div>
            <?php } ?>

            <div class="container d-flex flex-row justify-content-center mt-4 mb-3">
                <a class="btn btn-info" href="./?page=anciennes_commandes">Consulter vos anciennes commandes</a>
            </div>
        </main>