<?php
session_start();
if(!isset($_SESSION['idUser'])){
    header('Location:../public/index.php');
}
include '../vue/header.php';
$ProduitsAvecidProd=ProduitsAvecidProd($bdd,$_GET['idprod']);// a faire la requete pour récuperer l'idprod pour afficher le prod
$AffichageCateg=AffichageCateg($bdd);
$AffichageCategAvecID=AffichageCategAvecID($bdd,$ProduitsAvecidProd['id_categ']);
$AffichageSousCateg=AffichageSousCateg($bdd);
$AffichageSousCategAvecID=AffichageSousCategAvecID($bdd, $ProduitsAvecidProd['id_souscateg']);
?>
<div class="col-10 mt-3">
    <?php 
    if(isset($_GET['message'])){
        if($_GET['message']=='modif'){
                echo '<div class="alert alert-success text-center" role="alert">
                    La modification du produit a été effectuer.
                    </div>';
        }
    }
    ?>
    <a href="../public/index.php?page=2&s=2" class="btn btn-primary"><- RETOUR</a>
    <div class="row">
        <div class="col-6 offset-2">
            <form class="form-control" action="../controller/traitement_produits.php?action=modifier" method="post" enctype="multipart/form-data">
                <input name="idprod" value="<?php echo $ProduitsAvecidProd['id_prod'] ?>" hidden>
                <input name="id_img" value="<?php echo $ProduitsAvecidProd['id_img'] ?>" hidden>
                <table class="table table-bordered table-striped">
                    <th>#</th>
                    <th>Modification</th>
                    <tr>
                        <td>Marques</td>
                        <td><input class="form-control" type="text" name="marque" value="<?php echo $ProduitsAvecidProd['marque']?>" id=""></td>
                    </tr>
                    <tr>
                        <td>Désignation</td>
                        <td><input class="form-control" type="text" name="designation" value="<?php echo $ProduitsAvecidProd['designation']?>" id=""></td>
                    </tr>
                    <tr>
                        <td>Modèle</td>
                        <td><input class="form-control" type="text" name="modele" value="<?php echo $ProduitsAvecidProd['modele']?>" id=""></td>
                    </tr>
                    <tr>
                        <td>Prix Unit</td>
                        <td><input class="form-control" type="text" name="prixunit" value="<?php echo $ProduitsAvecidProd['prix_unit']?>" id=""></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea class="form-control" type="text" name="description" id=""><?php echo $ProduitsAvecidProd['description']?></textarea></td>
                    </tr>
                    <tr>
                        <td>Catégorie</td>
                        <td>
                            <select class="form-select" name="categ" onchange="categs(this.value);">
                                <?php 
                                    foreach($AffichageCateg as $AffCateg){
                                ?>
                                <option value="<?php echo $AffCateg['id_categ']?>" <?php if($AffichageCategAvecID['id_categ']==$AffCateg['id_categ']){ ?>selected<?php }?>><?php echo $AffCateg['nom_categ']?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Sous catégorie</td>
                        <td>
                            <div id="sous-categ">
                                <label><?php echo $AffichageSousCategAvecID['nom_souscateg']?></label>
                                <input name="souscateg" value="<?php echo $AffichageSousCategAvecID['id_souscateg']?>" hidden>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Quantité Stock</td>
                        <td><input class="form-control" type="text" name="qtestock" value="<?php echo $ProduitsAvecidProd['qte_stock'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Publication</td>
                        <td>
                            <select class="form-select" name="publier" id="">
                                <?php if($ProduitsAvecidProd['publier']==0){?>
                                    <option value="0" selected>Non publié</option>
                                    <option value="1">Publié</option>
                                <?php }else{?>
                                    <option value="1" selected>Publié</option>
                                    <option value="0">Non publié</option>
                                <?php }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bolder" colspan="2">Image actuel</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bolder" colspan="2"><img class="img-fluid" width="250px" src="../../assets/images/<?php echo $ProduitsAvecidProd['fichier']?>" alt=""></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bolder" colspan="2">Changer une image</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="form-control" type="file" name="fichier" id="formFile"></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bolder" colspan="2">Enregistrer les paramètres</td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="2"><input type="submit" class="btn btn-primary" value="Enregistrer"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script>
    
</script>