<?php
    include 'header.php';
    $AffichageSousCateg=AffichageSousCateg($bdd); 
?>
<div class="col-10 mt-3">
        <div class="row">
            <div class="col-6 offset-2">
            <?php
            
            if(isset($_GET['idcateg'])){
                
                $CategAvecID=CategAvecID($bdd,$_GET['idcateg']);
                ?>
                <a href="../public/index.php?page=5&c=2" class="btn btn-primary"><- RETOUR</a>
                <?php 
                if(isset($_GET['message'])){
                    if($_GET['message']=='modif'){
                        echo '<div class="alert alert-success text-center" role="alert">
                        La modification a été bien enregistrée.
                        </div>';
                    }
                }
                ?>
                    <form class="form-control" action="../controller/traitement_categorie.php?action=modifier&type=categ" method="post" enctype="multipart/form-data">
                        <input name="id_categ" value="<?php echo $CategAvecID['id_categ'] ?>" hidden>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>#</th>
                                <th>Modification</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nom de Categorie</td>
                                    <td><input class="form-control" type="text" name="nomducateg" value="<?php echo $CategAvecID['nom_categ']?>" id=""></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center fw-bolder">Sous-catégorie</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="d-flex flex-wrap">
                                            <?php 
                                            foreach($AffichageSousCateg as $AffSousCateg){
                                                if($AffSousCateg['id_categ']==$CategAvecID['id_categ']){ ?>
                                                <a href="../public/index.php?page=6&idsouscateg=<?php echo $AffSousCateg['id_souscateg'] ?>"><h4 class="m-1" onclick=""><span class="badge bg-primary"><?php echo $AffSousCateg['nom_souscateg']; ?></span></h4></a>
                                            <?php }}?>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-center"><input type="submit" class="btn btn-primary" value="Enregistrer la modification"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
            <?php 
            }
            if(isset($_GET['idsouscateg'])){
                $SousCategAvecID=SousCategAvecID($bdd,$_GET['idsouscateg']);?>
                <a href="../public/index.php?page=6&idcateg=<?php echo $SousCategAvecID['id_categ'] ?>" class="btn btn-primary"><- RETOUR AU CATEGORIE PARENT</a>
                    <?php 
                        if(isset($_GET['message'])){
                            if($_GET['message']=='modif'){
                                echo '<div class="alert alert-success text-center" role="alert">
                                    La modification a été bien enregistrée.
                                    </div>';
                            }
                        }
                    ?>
                    <form class="form-control" action="../controller/traitement_categorie.php?action=modifier&type=souscateg" method="post" enctype="multipart/form-data">
                        <input name="id_souscateg" value="<?php echo $SousCategAvecID['id_souscateg'] ?>" hidden>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>#</th>
                                <th>Modification</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nom de Sous-Categorie</td>
                                    <td><input class="form-control" type="text" name="nomsouscateg" value="<?php echo $SousCategAvecID['nom_souscateg']?>" id=""></td>
                                </tr>                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-center"><input type="submit" class="btn btn-primary" value="Enregistrer la modification"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
            <?php
            }
            ?>
    
        </div>
    </div>
</div>
    