<div class="container">
<h1 class="text-center mt-3 text-uppercase">Les Imprimantes :</h1>
    <!--<div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Filtre
        </button>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="#">Imprimante multifonction</a>
            </li>
            <li>
                <a class="dropdown-item" href="#">Imprimante laser</a>
            </li>
            <li>
                <a class="dropdown-item" href="#">Imprimante jet d'encre</a>
            </li>
            <li>
                <a class="dropdown-item" href="#">Imprimante 3D</a>
            </li>
        </ul>
    </div>-->
    <div class="d-flex mb-3 flex-wrap justify-content-center align-content-stretch">
        <?php
        $afficherImprimante=afficherImprimante($bdd);
        foreach ($afficherImprimante as $indice => $affImprimante){
            $indice++;
        
        ?>
        <div class="card text-center m-2 pb-2" style="width: 18rem;">
        <img src="../public/assets/images/<?php echo $affImprimante['fichier'] ?>" class="card-img-top" alt="...">
            <div class="card-body ">
                
                    <h5 class="card-title text-center text-uppercase text-black"><?php echo $affImprimante['marque']?>&nbsp;<?php echo $affImprimante['modele']?></h5>
                    <p><?php echo $affImprimante['description'] ?></p>
                    
            </div>
                    <div class="prix fw-bold"><?php echo $affImprimante['prix_unit'] ?>&nbsp;€</div>

                    <form action="../controller/traitement_ajouter_produit.php?action=ajoutprod" method="post">
                    <div class="">
                        Choisir votre quantité :
                        <input type="number" min="1" class="text-center" name="quantite" value="1">
                        <input name="idprod" value="<?php echo $affImprimante['id_prod'] ?>" hidden>
                        
                        <input type="submit" class="btn btn-primary mt-2" value="Ajouter au panier">
                    </div> 
                </form>
        </div>
        <?php } ?>
    </div>
</div>