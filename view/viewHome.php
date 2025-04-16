        <main class="flex-grow-1" style="background-color: #dddddd;">
            <h2 class="display-5 text-center mb-3">Nouveautés</h2>
            <div class="container d-flex flex-row ps-0">
                <ul class="w-100 d-flex flex-row justify-content-between column-gap-3 ps-0">
                    <?php foreach($latestBooks as $book){ ?>
                        <li class="container list-unstyled col-12 col-md-6 col-lg-4 m-0 px-0">
                            <div class="container d-flex flex-column border border-primary rounded pt-2 pb-3">
                                <div class="d-flex flex-row column-gap-3">
                                    <img style="width: 75px; height: 113px;" src="./img/books/<?= $book["picture_book"] ?>" alt="image">
                                    <div class="d-flex flex-column">
                                        <h3 class="fs-5 text-center">
                                            <span class="text-decoration-underline"><?= $book["title_book"] ?></span>, <?= $book["name_author"] ?> <?= $book["last_name_author"] ?> (<?= date("Y", strtotime($book["release_date_book"])) ?>)
                                        </h3>
                                        <p class="fs-6 text-center"><?= $book["title_category"] ?></p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-evenly">
                                    <p class="fs-6 m-0 align-self-center"><?= $book["price_book"] ?>&euro;</p>
                                    <a href="./?page=details&id=<?= $book["id_book"] ?>" class="btn btn-secondary align-self-center">détails</a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <h2 class="display-5 text-center mb-3">Meilleures ventes</h2>
            <div class="container d-flex flex-row ps-0">
                <ul class="w-100 d-flex flex-row justify-content-between column-gap-3 ps-0">
                    <?php foreach($bestSellers as $book){ ?>
                        <li class="container list-unstyled col-12 col-md-6 col-lg-4 m-0 px-0">
                            <div class="container d-flex flex-column border border-primary rounded pt-2 pb-3">
                                <div class="d-flex flex-row column-gap-3">
                                    <img style="width: 75px; height: 113px;" src="./img/books/<?= $book["picture_book"] ?>" alt="image">
                                    <div class="d-flex flex-column">
                                        <h3 class="fs-5 text-center">
                                            <span class="text-decoration-underline"><?= $book["title_book"] ?></span>, <?= $book["name_author"] ?> <?= $book["last_name_author"] ?> (<?= date("Y", strtotime($book["release_date_book"])) ?>)
                                        </h3>
                                        <p class="fs-6 text-center"><?= $book["title_category"] ?></p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-evenly">
                                    <p class="fs-6 m-0 align-self-center"><?= $book["price_book"] ?>&euro;</p>
                                    <a href="./?page=details&id=<?= $book["id_book"] ?>" class="btn btn-secondary align-self-center">détails</a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </main>