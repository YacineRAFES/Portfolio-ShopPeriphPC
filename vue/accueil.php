<div class="container">
    <h1 class="text-center mt-3 text-uppercase">Voici les catégories disponibles sur notre site :</h1>
    <div class="d-flex flex-wrap justify-content-center mb-3">
        <?php
        $affCateg=afficherCateg($bdd);
            foreach ($affCateg as $indice => $affCategorie){
                $indice++
        ?>
        <a class="text-decoration-none" href="<?php echo $affCategorie['link']?>">
            <div class="card m-2" style="width: 18rem;">
            <img src="../public/assets/images/<?php echo $affCategorie['img']?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-center text-uppercase text-black"><?php echo $affCategorie['NomCategorie'] ?></h5>
                </div>
            </div>
        </a>
        <?php } ?>
    </div>
</div>
        