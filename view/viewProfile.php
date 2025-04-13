        <main class="flex-grow-1" style="background-color: #dddddd;">
            <h1 class="display-5 text-center mb-3">Votre profil</h1>
            <div class="container w-50 p-3 py-5 mb-4 border border-secondary rounded">
                
                <div class="mb-4 d-flex flex-row w-100">
                    <p class="col-8 ps-5 mb-0 d-flex align-items-center">Prénom : <?= htmlspecialchars($user["name"]) ?></p>
                    <div class="col-4 d-flex flex-row justify-content-center">
                        <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#nameModal">Modifier</button>
                    </div>
                </div>

                <div class="mb-4 d-flex flex-row w-100">
                    <p class="col-8 ps-5 mb-0 d-flex align-items-center">Nom : <?= htmlspecialchars($user["last_name"]) ?></p>
                    <div class="col-4 d-flex flex-row justify-content-center">
                        <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#lastNameModal">Modifier</button>
                    </div>
                </div>

                <div class="mb-4 d-flex flex-row w-100">
                    <p class="col-8 ps-5 mb-0 d-flex align-items-center">Adresse mail : <?= htmlspecialchars($user["login"]) ?></p>
                    <div class="col-4 d-flex flex-row justify-content-center">
                        <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Modifier</button>
                    </div>
                </div>

                <div class="mb-4 d-flex flex-column w-100">
                    <div class="mb-4 d-flex flex-row w-100">
                        <p class="col-8 ps-5 mb-0 d-flex align-items-center">Adresse<?php if($nbAddresses > 1){echo "s";} ?> : <?php if($nbAddresses == 0){echo "Vous n'avez pas défini d'adresse.";} ?></p>
                        <div class="col-4 d-flex flex-row justify-content-center">
                            <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#addAddressModal">Ajouter une adresse</button>
                        </div>
                    </div>

                    <?php if($nbAddresses > 0){ ?>
                        <table class="d-flex flex-row table px-5 w-100">
                            <tbody class="w-100">
                                <?php foreach($user["addresses"] as $address) { ?>
                                    <tr class="d-flex flex-row w-100">
                                        <td class="col-7 fs-6 bg-transparent d-flex align-items-center"><?php echo htmlspecialchars($address["street_nb_address"])." ".
                                                                    htmlspecialchars($address["street_address"]).", ".
                                                                    htmlspecialchars($address["postal_code_address"])." ".
                                                                    htmlspecialchars($address["city_address"])." ".
                                                                    htmlspecialchars($address["country_address"]);?></td>
                                        <td class="col-5 d-flex flex-row column-gap-2 justify-content-around bg-transparent">
                                            <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#updateAddressModal<?= $address["id_address"] ?>">Modifier</button>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteAddressModal<?= $address["id_address"] ?>">Supprimer</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>

                <div class="d-flex flex-row w-100 justify-content-center col-12">
                    <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#passwordModal">Modifier le mot de passe</button>
                </div>

            </div>
            <div class="container w-50 d-flex flex-row justify-content-center mb-4">
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#logoutModal">Se déconnecter</button>
            </div>

            <div class="modal fade" id="nameModal" tabindex="-1">   
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="./?page=profil&action=modifier_prenom" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title">Modifier votre prénom</h5>
                                <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">Nouveau prénom</label>
                                    <input name="firstName" type="text" class="form-control" id="firstName" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="lastNameModal" tabindex="-1">   
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="./?page=profil&action=modifier_nom" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title">Modifier votre nom</h5>
                                <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Nouveau nom</label>
                                    <input name="lastName" type="text" class="form-control" id="lastName" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="loginModal" tabindex="-1">   
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="./?page=profil&action=modifier_mail" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title">Modifier votre adresse mail</h5>
                                <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="mail" class="form-label">Nouvelle adresse mail</label>
                                    <input name="login" type="email" class="form-control" id="mail" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="passwordModal" tabindex="-1">   
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="./?page=profil&action=modifier_mdp" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title">Modifier votre mot de passe</h5>
                                <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="oldPassword" class="form-label">Ancien mot de passe</label>
                                    <input name="oldPassword" type="password" class="form-control" id="oldPassword" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Nouveau mot de passe</label>
                                    <input name="password" type="password" class="form-control" id="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirmation du nouveau mot de passe</label>
                                    <input name="confirmPassword" type="password" class="form-control" id="confirmPassword" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="logoutModal" tabindex="-1">   
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content container">
                        <div class="modal-header">
                            <h5 class="modal-title">Déconnexion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Êtes-vous sûr de vouloir vous déconnecter ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <a href="./?page=profil&action=deconnexion" class="btn btn-danger">Se déconnecter</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addAddressModal" tabindex="-1">   
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="./?page=profil&action=ajouter_adresse" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title">Ajouter une adresse</h5>
                                <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="streetNbAddress" class="form-label">Numéro de rue</label>
                                    <input name="streetNbAddress" type="text" class="form-control" id="streetNbAddress" required>
                                </div>
                                <div class="mb-3">
                                    <label for="streetAddress" class="form-label">Nom de rue</label>
                                    <input name="streetAddress" type="text" class="form-control" id="streetAddress" required>
                                </div>
                                <div class="mb-3">
                                    <label for="postalCode" class="form-label">Code postal</label>
                                    <input name="postalCodeAddress" type="text" class="form-control" id="postalCode" required>
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">Ville</label>
                                    <input name="cityAddress" type="text" class="form-control" id="city" required>
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Pays</label>
                                    <input name="countryAddress" type="text" class="form-control" id="country" required>
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

            <?php foreach($user["addresses"] as $address){ ?>
                <div class="modal fade" id="updateAddressModal<?= $address["id_address"] ?>" tabindex="-1">   
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="./?page=profil&action=modifier_adresse" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modifier une adresse</h5>
                                    <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="streetNbAddress" class="form-label">Numéro de rue</label>
                                        <input value="<?= htmlspecialchars($address["street_nb_address"]) ?>" name="streetNbAddress" type="text" class="form-control" id="streetNbAddress" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="streetAddress" class="form-label">Nom de rue</label>
                                        <input value="<?= htmlspecialchars($address["street_address"]) ?>" name="streetAddress" type="text" class="form-control" id="streetAddress" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="postalCodeAddress" class="form-label">Code postal</label>
                                        <input value="<?= htmlspecialchars($address["postal_code_address"]) ?>" name="postalCodeAddress" type="text" class="form-control" id="postalCodeAddress" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cityAddress" class="form-label">Ville</label>
                                        <input value="<?= htmlspecialchars($address["city_address"]) ?>" name="cityAddress" type="text" class="form-control" id="cityAddress" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="countryAddress" class="form-label">Pays</label>
                                        <input value="<?= htmlspecialchars($address["country_address"]) ?>" name="countryAddress" type="text" class="form-control" id="countryAddress" required>
                                    </div>
                                    <input type="hidden" name="addressId" value="<?= $address["id_address"] ?>">
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

            <?php foreach($user["addresses"] as $address){ ?>
                <div class="modal fade" id="deleteAddressModal<?= $address["id_address"] ?>" tabindex="-1">   
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="./?page=profil&action=supprimer_adresse" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer une adresse</h5>
                                    <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="addressId" value="<?= $address["id_address"] ?>">
                                    <p>Êtes-vous sûr de vouloir supprimer l'adresse "<?php echo htmlspecialchars($address["street_nb_address"])." ".
                                                                    htmlspecialchars($address["street_address"]).", ".
                                                                    htmlspecialchars($address["postal_code_address"])." ".
                                                                    htmlspecialchars($address["city_address"])." ".
                                                                    htmlspecialchars($address["country_address"]);?>" ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Supprimer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </main>