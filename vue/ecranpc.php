<div class="container">
<h1 class="text-center mt-3 text-uppercase">les écrans pc :</h1>
    <!--<div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Filtre
        </button>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="#">Écran neuf</a>
            </li>
            <li>
                <a class="dropdown-item" href="#">Écran reconditionné</a>
            </li>
        </ul>
    </div>-->
    <div class="d-flex mb-3 flex-wrap justify-content-center align-content-stretch">
        <?php
        $afficherEcran=afficherEcran($bdd);
            foreach ($afficherEcran as $affEcran){
        ?>
        <div class="card text-center m-2 pb-2" style="width: 18rem;" id="<?php echo $affEcran['id_prod'] ?>">
        <img src="../public/assets/images/<?php echo $affEcran['fichier'] ?>" class="card-img-top" alt="...">
            <div class="card-body ">
                
                    <h5 class="card-title text-center text-uppercase text-black"><?php echo $affEcran['designation']?></h5>
                    <p><?php echo $affEcran['description'] ?></p>
            </div>
                    <div class="">
                        <div class="prix fw-bold"><?php echo $affEcran['prix_unit'] ?>&nbsp;€</div>

                        <form action="../controller/traitement_ajouter_produit.php?action=ajoutprod" method="post">
                        <div class="">
                            Choisir votre quantité :
                            <input type="number" min="1" class="text-center" name="quantite" value="1">
                            <input name="idprod" value="<?php echo $affEcran['id_prod'] ?>" hidden>
                            
                            <input type="submit" class="btn btn-primary mt-2" <?php if($affEcran['qte_stock']<1){?> disabled value="RUPTURE DE STOCK"<?php }else{?>value="Ajouter au panier"<?php } ?>>
                        </div>
                    </div>
                </form>
            
        </div>
        <?php } ?>
    </div>
</div>