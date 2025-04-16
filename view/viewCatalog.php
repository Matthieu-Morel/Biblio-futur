        <main class="flex-grow-1" style="background-color: #dddddd;">
            <h1 class="display-5 text-center mb-3">Notre catalogue</h1>
            <div class="container w-50 d-flex flex-row column-gap-3 mb-3">
                <form action="" method="post">
                    <input type="submit" class="btn btn-secondary" value="<?= $sort?>" name="tri">
                </form>
                <form class="d-flex flex-row flex-fill column-gap-3" action="" method="post">
                    <input name="research" type="text" class="form-control" value="">
                    <button class="btn btn-transparent border border-0 p-0" type="submit"><i class="bi bi-search fs-4"></i></button>
                </form>
            </div>
            <div class="container d-flex flex-row">
                <ul class="w-100 d-flex flex-row justify-content-between flex-wrap row-gap-4">
                    <?php foreach ($books as $book) {?>
                        <li class="container list-unstyled col-12 col-md-6 col-lg-4 m-0">
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
                                <div class="d-flex flex-row justify-content-around">
                                    <p class="fs-6 m-0 align-self-center"><?= $book["price_book"] ?>&euro;</p>
                                    <a href="./?page=details&id=<?= $book["id_book"] ?>" class="btn btn-secondary align-self-center">détails</a>
                                    <button class="btn btn-transparent p-0 border border-0"><i class="bi bi-heart fs-3"></i></button>
                                </div>
                            </div>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </main>