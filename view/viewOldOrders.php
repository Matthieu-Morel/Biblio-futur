        <main class="flex-grow-1" style="background-color: #dddddd;">
            <h1 class="display-5 text-center mb-3">Vos anciennes commandes</h1>

            <?php if(!empty($oldOrders)){ ?>
                <div class="container d-flex flex-column row-gap-3 mb-3">
                    <?php foreach($oldOrders as $order){ ?>
                        <div class="container d-flex flex-column border border-primary rounded w-50 p-3">
                            <div class="d-flex flex-row">
                                <p class="fs-5 text-center w-100">Commande du <?= date("d/m/Y",strtotime($order["date_bill"])) ?></p>
                            </div>
                            <div class="d-flex flex-column flex-sm-row justify-content-evenly row-gap-2">
                                <p class="mb-0 text-center">Prix TTC : <?= $order["price_before_tax_bill"]*(1+($order["vat_bill"]/100)) ?>&euro;</p>
                                <p class="mb-0 text-center"><?= $order["NbBooks"] ?> livre<?php if($order["NbBooks"] > 1){echo "s";} ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else {?>
                <div class="container mt-5">
                    <p class="fs-4 text-center mb-3">Vous n'avez pas encore passé de commande.</p>
                </div>
            <?php } ?>
        </main>