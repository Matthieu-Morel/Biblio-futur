        <main class="flex-grow-1" style="background-color: #dddddd;">
            <h1 class="display-5 text-center mb-3">Détails du livre</h1>
            <div class="container border border-primary rounded p-3 mb-3 d-flex flex-column row-gap-3">
                <div class="d-flex flex-row column-gap-3">
                    <div class="d-flex flex-column w-25">
                        <img style="min-height: 300px; max-height: 600px;" src="./img/books/<?= $book["picture_book"] ?>" alt="image du livre">
                    </div>
                    <div class="d-flex flex-column">
                        <h3 class="fs-5 text-center">
                            <span class="text-decoration-underline"><?= $book["title_book"] ?></span>
                        </h3>
                        <p class="fs-6"><strong>Auteur :</strong> <?= $book["name_author"] ?> <?= $book["last_name_author"] ?></p>
                        <p class="fs-6"><strong>Année de sortie :</strong> <?= date("Y", strtotime($book["release_date_book"]))?></p>
                        <p class="fs-6"><strong>Catégorie :</strong> <?= $book["title_category"] ?></p>
                        <p class="fs-6"><strong>Prix :</strong> <?= $book["price_book"] ?>&euro;</p>
                        <p class="fs-6"><strong>Résumé du livre :</strong> <br><?= $book["description_book"]?></p>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-center">
                    <a class="btn btn-primary" href="./?page=commande&action=ajouter_au_panier&id=<?= $book["id_book"] ?>">Ajouter au panier</a>
                </div>
            </div>
        </main>