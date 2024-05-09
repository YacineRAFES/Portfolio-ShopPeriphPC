<div class="container">
    <h1 class="text-center mt-3 text-uppercase">Accessoire PC :</h1>
    <div class="d-flex mb-3 flex-wrap justify-content-center">
        <?php
        $afficherAccessoirePC=afficherAccessoirePC($bdd);
        foreach ($afficherAccessoirePC as $indice => $affAccessoirePC){
            $indice++;
        
        ?>
        
        <div class="card text-center m-2 pb-2" style="width: 18rem;">
        <img src="../public/assets/images/<?php echo $affAccessoirePC['fichier'] ?>" class="card-img-top" alt="...">
            <div class="card-body ">
                <h5 class="card-title text-center text-uppercase text-black"><?php echo $affAccessoirePC['marque']?>&nbsp;<?php echo $affAccessoirePC['modele']?></h5>
                <p><?php echo $affAccessoirePC['description'] ?></p>
            </div>
                    <div class="">
                        <div class="prix fw-bold"><?php echo $affAccessoirePC['prix_unit'] ?>&nbsp;€</div>

                        <form action="../controller/traitement_ajouter_produit.php?action=ajoutprod" method="post">
                        <div class="">
                            Choisir votre quantité :
                            <input type="number" min="1" class="text-center" name="quantite" value="1">
                            <input name="idprod" value="<?php echo $affAccessoirePC['id_prod'] ?>" hidden>
                            
                            <input type="submit" class="btn btn-primary mt-2" value="Ajouter au panier">
                        </div>
                    </div>
                </form>
            
        </div>
        <?php } ?>
    </div>
</div>