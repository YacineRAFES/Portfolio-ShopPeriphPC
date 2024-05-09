<?php

if(isset($_SESSION['idPanier'])){
$AfficherDetailPanier=AfficherDetailPanier($bdd,$_SESSION['idPanier']);
}
?>
<link rel="stylesheet" href="../public/assets/css/header.css">
<header class="d-flex container-fluid bg-primary justify-content-center">
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand text-white" href="#">ShopPeriphPC</a>
            <div class="navbar-collapse collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../public/index.php?page=2">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../public/index.php?page=3">Écran PC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../public/index.php?page=4">Clavier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../public/index.php?page=5">Souris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../public/index.php?page=6">Casque & Micro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../public/index.php?page=7">Imprimante</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../public/index.php?page=8">Accessoire PC</a>
                    </li>
                    <?php
                        if(!isset($_SESSION['idUser'])){
                            echo '';
                        }else{
                            echo '<li class="nav-item"><a class="nav-link" href="../public/index.php?page=11">Mon profil</a></li>';
                        }
                    ?>
                    <li class="nav-item">
                        <?php 
                            if (!isset($_SESSION['idUser'])){
                                echo '<a class="nav-link" href="../public/index.php?page=9&p=connexion">Connexion</a>';
                            }else{
                                echo '<a class="nav-link text-danger" href="../controller/traitement_deconnexion.php">Deconnexion</a>';
                            }
                        ?>
                    </li>
                    
                </ul>
                <div>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" onkeyup="recherche(this.value)" placeholder="Rechercher">
                    </form>
                        <!--<div class="row">
                            <div class="col-md-4">
                            <img src="assets/images/acer215led.jpg" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Nom de produit</h5>
                                </div>
                            </div>
                        </div>-->
                    <div id="prod"></div>
                </div>
            </div>
    </nav>
    <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Panier <span class="badge text-bg-secondary"><?php if (isset($_SESSION['idPanier'])){ $NombreDeProduit=NombreDeProduit($bdd,$_SESSION['idPanier']); echo $NombreDeProduit; }?></span>
    </button>
    <div class="offcanvas offcanvas-end <?php if(isset($_GET['success'])){ if($_GET['success'] == 'prodDeleted'){ ?>show<?php } } ?>" data-bs-scroll="true" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Panier</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
   
        <?php
        
        if(!isset($_SESSION['idPanier'])){
            echo '<p class="alert alert-danger text-center mt-5">Votre panier est vide</p>';
        }else{
            ?>
    <div class="offcanvas-body text-center">
        <table class="table table-striped table-hover" style="vertical-align:middle;">
            <thead>
                <tr class="table-active table-secondary">
                    <th colspan="2" style="width: 40%;">Nom du produit</th>
                    <th colspan="3">Quantité</th>
                    <th>Prix</th>
                    <th>Suppr</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
               
                $AfficherDetailPanier=AfficherDetailPanier($bdd,$_SESSION['idPanier']);
                foreach ($AfficherDetailPanier as $AffPanier){
                ?>
                <tr>
                    <td><img src="../public/assets/images/<?php echo $AffPanier['fichier']?>" width="50px" alt=""></td>
                    <td><?php echo $AffPanier['designation']?></td>
                    <td id="tdBtnMoins<?php echo $AffPanier['id_prod']; ?>">
                    <?php 
                    if($AffPanier['qte_com'] == 1){
                        echo '<div class="border border-grey fw-bolder" >-</div>';
                    }else{
                        echo '<div class="border border-primary fw-bolder btn btn-outline-primary" onclick="ModifQuantite(' .  $AffPanier['id_prod'] .','. $AffPanier['prix_unit'] . ', \'moins\')">-</div>';
                    }
                    ?>
                    </td>
                    <td id="tdQteCom<?php echo $AffPanier['id_prod']; ?>"><?php echo $AffPanier['qte_com'] ?></td>
                    <td><div class="border border-primary fw-bolder btn btn-outline-primary" onclick="ModifQuantite(<?php echo $AffPanier['id_prod']?>,<?php echo $AffPanier['prix_unit']?>, 'plus')">+</div></td>
                    <td id="totalProduit<?php echo $AffPanier['id_prod']; ?>"><?php echo $AffPanier['prix_unit']*$AffPanier['qte_com']; ?></td>
                    <td><a  href="../controller/traitement_ajouter_produit.php?action=supprProdPanier&idprod=<?php echo $AffPanier['id_prod']?>"><img src="assets/images/trash-solid.svg" alt="" width="25px"></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="row align-items-center">
            <div class="col-6 d-flex justify-content-center">
                <div class="">Total : </div>
                <div class="ps-1 fw-bolder" id="divMontantPanier">
                <?php
               
                $prixTotal=prixTotal($bdd,$_SESSION['idPanier']);echo $prixTotal['montant']; ?>€
                </div>
            </div>
            <div class="col-3">
                <a href="../public/index.php?page=12" class="border rounded-pill px-2 btn btn-primary fw-bolder text-uppercase">Commander</a>
            </div>
        </div>
    </div>

    <?php } ?>

    </div>


</header>