        <main class="flex-grow-1" style="background-color: #dddddd;">
            <h1 class="display-5 text-center text-warning mb-3">Notre catalogue</h1>
            <div class="container w-50 d-flex flex-row column-gap-3 mb-3">
                <form action="./?page=catalogue" method="post">
                    <input type="submit" class="btn btn-secondary" value="<?= $sort?>" name="tri">
                </form>
                <input name="research" type="text" class="form-control" value="">
                <button class="btn btn-secondary" type="submit">rechercher</button>
            </div>
            <div class="container d-flex flex-row">
                <ul class="w-100 d-flex flex-row justify-content-between flex-wrap row-gap-4">
                    <?php foreach ($books as $idBook => $book) {?>
                        <li class="container list-unstyled col-4 m-0">
                            <div class="container border border-primary rounded pt-2 pb-3">
                                <h3 class="fs-5 text-center"><span class="text-decoration-underline"><?= $book["title_book"] ?></span>, <?= $book["name_author"] ?> <?= $book["last_name_author"] ?> (<?= $book["release_date_book"] ?>)</h3>
                                <div class="d-flex flex-row justify-content-around">
                                    <p class="fs-6"><?= $book["title_category"] ?></p>
                                    <p class="fs-6"><?= $book["price_book"] ?>&euro;</p>
                                </div>
                                <div class="d-flex flex-row justify-content-center">
                                    <a href="./?page=details&id=<?= $book["id_book"] ?>" class="btn btn-secondary">détails</a>
                                </div>
                            </div>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </main>