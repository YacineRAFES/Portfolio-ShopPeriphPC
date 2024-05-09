<div class="container">
    <h1 class="text-center mt-3 text-uppercase">les souris :</h1>
    <div class="d-flex  mb-3 flex-wrap justify-content-center" id="produits">
        <?php
        $afficherSouris=afficherSouris($bdd);
        foreach ($afficherSouris as $indice => $affSouris){
            $indice++;
        
        ?>
        <div class="card text-center m-2 pb-2" style="width: 18rem;">
            <img src="../public/assets/images/<?php echo $affSouris['fichier'] ?>" class="card-img-top" alt="...">
            <div class="card-body ">
                <h5 class="card-title text-center text-uppercase text-black"><?php echo $affSouris['marque']?>&nbsp;<?php echo $affSouris['modele']?></h5>
                <p><?php echo $affSouris['description'] ?></p>
            </div>
            <div class="prix fw-bold"><?php echo $affSouris['prix_unit'] ?>&nbsp;€</div>
            <form action="../controller/traitement_ajouter_produit.php?action=ajoutprod" method="post">
                <div class="" >
                    Choisir votre quantité :
                    <input type="number" min="1" class="text-center" name="quantite" value="1">
                    <input name="idprod" value="<?php echo $affSouris['id_prod'] ?>" hidden>
                    <input type="submit" class="btn btn-primary mt-2" value="Ajouter au panier">
                </div> 
            </form>
        </div>
        <?php } ?>
    </div>
</div>