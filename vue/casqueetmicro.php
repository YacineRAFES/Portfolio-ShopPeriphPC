<div class="container">
    <h1 class="text-center mt-3 text-uppercase">les casques et micro :</h1>
    <div class="d-flex mb-3 flex-wrap justify-content-center">
    <?php
        $afficherCasqueetmicro=afficherCasqueetmicro($bdd);
        foreach ($afficherCasqueetmicro as $indice => $affCasqueetmicro){
            $indice++;
        
        ?>
        <div class="card text-center m-2 pb-2" style="width: 18rem;">
        <img src="../public/assets/images/<?php echo $affCasqueetmicro['fichier'] ?>" class="card-img-top" alt="...">
            <div class="card-body ">
                
                    <h5 class="card-title text-center text-uppercase text-black"><?php echo $affCasqueetmicro['marque']?>&nbsp;<?php echo $affCasqueetmicro['modele']?></h5>
                    <p><?php echo $affCasqueetmicro['description'] ?></p>
            </div>
                    <div class="prix fw-bold"><?php echo $affCasqueetmicro['prix_unit'] ?>&nbsp;€</div>

                    <form action="../controller/traitement_ajouter_produit.php?action=ajoutprod" method="post">
                    <div class="">
                        Choisir votre quantité :
                        <input type="number" min="1" class="text-center" name="quantite" value="1">
                        <input name="idprod" value="<?php echo $affCasqueetmicro['id_prod'] ?>" hidden>
                        
                        <input type="submit" class="btn btn-primary mt-2" value="Ajouter au panier">
                    </div> 
                </form>
            
        </div>
        <?php } ?>
    </div>
</div>