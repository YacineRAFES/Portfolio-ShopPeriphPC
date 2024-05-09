<?php 
$departements=affichageDepartement($bdd);
$AffichageRole=AffichageRole($bdd);
?>
<div class="row">
    <div class="col-6 offset-2">
        <form class="form-control" action="../controller/traitement_user.php?action=ajouter" method="post">
            <table class="table table-bordered table-striped">
                <thead class="text-uppercase text-center">
                    <th>#</th>
                    <th>à saisir</th>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" class="text-uppercase text-center fw-bolder">Information de utilisateur</td>
                    </tr>
                    <tr>
                        <td>Nom</td>
                        <td><input class="form-control"  type="text" name="nom" id=""></td>
                    </tr>
                    <tr>
                        <td>Prenom</td>
                        <td><input class="form-control"  type="text" name="prenom" id=""></td>
                    </tr>
                    <tr>
                        <td>Date de naissance</td>
                        <td><input class="form-control"  type="date" name="datenaiss" id=""></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input class="form-control"  type="text" name="email" id=""></td>
                    </tr>
                    <tr>
                        <td>MDP</td>
                        <td><input class="form-control"  type="password" name="mdp" id=""></td>
                    </tr>
                    <tr>
                        <td>Rôle</td>
                        <td>
                            <select class="form-select" name="role" id="">
                                <?php foreach($AffichageRole as $AffRole){ ?>
                                <option value="<?php echo $AffRole['id_role']?>"><?php echo $AffRole['nom_role']?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-uppercase text-center fw-bolder">Adresse</td>
                    </tr>
                    <tr>
                        <td>Adresse</td>
                        <td><input class="form-control" type="text" name="adresse" id=""></td>
                    </tr>
                    <tr>
                        
                        <td>Département</td>
                        <td>
                            <select name="departement" id="floatingInput8" class="form-select" onchange="departementale(this.value)" required>
                                <option value="">Sélectionner un département</option>
                                <?php
                                    foreach($departements as $dpt){
                                ?>
                                <option value="<?php echo $dpt['id_dept']?>"><?php echo $dpt['nom_departement']?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Ville</td>
                        <td><div id="ville"></div></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-center"><input class="btn btn-primary" type="submit" value="Créer un compte"></td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>