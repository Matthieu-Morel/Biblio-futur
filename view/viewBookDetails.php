        <main class="flex-grow-1" style="background-color: #dddddd;">
            <h1 class="display-5 text-center text-warning mb-3">Détails du livre</h1>
            <div class="container border border-primary rounded pt-2 pb-3">
                <h3 class="fs-5 text-center"><span class="text-decoration-underline"><?= $book["title_book"] ?></span>, <?= $book["name_author"] ?> <?= $book["last_name_author"] ?> (<?= $book["release_date_book"] ?>)</h3>
                <p class="fs-6">Catégorie : <?= $book["title_category"] ?></p>
                <p class="fs-6">Prix : <?= $book["price_book"] ?>&euro;</p>
                <p class="fs-6">Résumé du livre: <br><?= $book["description_book"]?></p>
            </div>
        </main>