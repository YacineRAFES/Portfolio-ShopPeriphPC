<?php 
include '../vue/header.php';
$AffichageAdresse=AffichageAdresse($bdd,$_GET['iduser']);
$departements=affichageDepartement($bdd);
$AffichageUserAvecID=AffichageUserAvecID($bdd, $_GET['iduser']);
$AffichageRole=AffichageRole($bdd);
?>
<div class="col-10 mt-3">
    <a href="../public/index.php?page=9&u=2" class="btn btn-primary"><- RETOUR</a>
    <div class="row">
        <div class="col-6 offset-2">
        <?php 
            if(isset($_GET['message'])){
                if($_GET['message']=='modif'){
                        echo '<div class="alert alert-success text-center" role="alert">
                            La modification de l\'utilisateur a été effectuer.
                            </div>';
                }
            }
        ?>
            <form class="form-control" action="../controller/traitement_user.php?action=modifier" method="post">
                <input name="iduser" value="<?php echo $AffichageUserAvecID['id_user'] ?>" hidden>
                <input name="idadresse" value="<?php echo $AffichageAdresse['id_adresse']?>" hidden>
                <table class="table table-hover table-bordered table-striped mt-2">
                    <thead class="text-nowrap text-uppercase text-center">
                        <th>#</th>
                        <th>modification</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2" class="text-center text-uppercase fw-bolder">Info personnelle de l'utilisateur</td>
                        </tr>
                        <tr>
                            <td>Nom</td>
                            <td><input class="form-control" type="text" name="nom" id="" value="<?php echo $AffichageUserAvecID['nom'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Prenom</td>
                            <td><input class="form-control" type="text" name="prenom" id="" value="<?php echo $AffichageUserAvecID['prenom'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Date de naissance</td>
                            <td><input class="form-control" type="date" name="datenaiss" id="" value="<?php echo $AffichageUserAvecID['date_naiss']?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input class="form-control" type="text" name="email" id="" value="<?php echo $AffichageUserAvecID['email']?>"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center text-uppercase fw-bolder">Adresse de l'utilisateur</td>
                        </tr>
                        <tr>
                            <td>Département</td>
                            <td>
                                <select name="departement" id="floatingInput8" class="form-control" onchange="departementale(this.value)" required>
                            
                                <?php
                                    foreach($departements as $dpt){
                                ?>
                                <option value="<?php echo $dpt['id_dept']?>" <?php if($AffichageAdresse['id_dept'] == $dpt['id_dept']){ ?>selected<?php } ?>><?php echo $dpt['nom_departement']; ?></option>
                                <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Ville</td>
                            <td><div class="ville" id="ville"><input name="id_ville" value="<?php echo $AffichageAdresse['id_ville'].'-'. $AffichageAdresse['cp'] ?>" hidden><?php echo $AffichageAdresse['nom_ville']?></div></td>
                        </tr>
                        <tr>
                            <td>Adresse</td>
                            <td><input class="form-control" type="text" name="adresse" id="" value="<?php echo $AffichageAdresse['adresse']?>"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center text-uppercase fw-bolder">Rôle</td>
                        </tr>
                        <tr>
                            <td>Rôle</td>
                            <td>
                                <select class="form-select" name="role" id="">
                                    <?php 
                                    foreach ($AffichageRole as $AffRole){
                                    ?>
                                    <option value="<?php echo $AffRole['id_role']?>" <?php if($AffichageUserAvecID['id_role'] == $AffRole['id_role']){ ?>selected<?php } ?>><?php echo $AffRole['nom_role']?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-center"><input class="btn btn-primary" type="submit" value="Enregistrer la modification"></td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>