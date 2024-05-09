<?php 
if(isset($_SESSION['idUser'])){
    
}else{
    header('Location:../public/index.php?page=9&p=connexion');
}
$departements = affichageDepartement($bdd); 
?>
<div class="container" id="MyGroup">
    <div class="d-flex justify-content-center">
        <?php
            if (isset($_GET['erreur'])){
                echo '<p class="alert alert-danger">'. $_GET['erreur'].'</p>';
            } 
        ?>

    </div>
    <div class="row mt-5">
        <div class="col-lg-2 mt-2">
            <nav class="nav flex-column text-center">
            <button class="btn btn-primary " type="button" data-bs-toggle="collapse" data-bs-target="#InfoPerso" aria-expanded="false" aria-controls="InfoPerso" onclick="afficherItem('InfoPerso');">Informations personnelles</button>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#facture" aria-expanded="false" aria-controls="facture"  onclick="afficherItem('facture')">Factures</button>
        </div>
        
        <div class="col-lg-10">
        <div class="collapse show<?php if(isset($_GET['majinfo']) or isset($_GET['erreurmdp'])){ ?>show<?php } ?>" id="InfoPerso" data-bs-parent="#myGroup">
            <?php 
                $AffichageUser=AffichageUser($bdd,$_SESSION['idUser']);
                foreach ($AffichageUser as $AffUser){
            ?>
            <form class="mb-3" action="../controller/traitement_compte.php?action=modifinfo" method="post">
                <div class="row border border-primary rounded my-2">
                <h4 class="text-center mt-3 text-uppercase">Mes informations personnelles</h4>
                    <div class="form-floating col-6 my-2">
                        <input type="text" name="nom" class="form-control" id="floatingInput4" value="<?php echo $AffUser['nom'] ?>" required>
                        <label for="floatingInput4" class="mx-2">Nom de famille</label>
                    </div>
                    <div class="form-floating col-6 my-2">
                        <input type="text" name="prenom" class="form-control" id="floatingInput5" value="<?php echo $AffUser['prenom'] ?>" required>
                        <label for="floatingInput5" class="mx-2">Prénom</label>
                    </div>
                    <div class="form-floating col-6 my-2 mb-3">
                        <input type="date" name="datenaiss" class="form-control" id="floatingInput6" value="<?php echo $AffUser['date_naiss'] ?>" required>
                        <label for="floatingInput6" class="mx-2">Date de naissance</label>
                    </div>
                    <div class="form-floating col-6 my-2">
                        <input type="email" name="email" value="<?php echo $AffUser['email']?>" class="form-control" id="floatingInpu1" placeholder="name@exemple.com" required>
                        <label for="floatingInput1" class="mx-2">Email</label>
                    </div>
                </div>
                
                
            <?php 
            $AffichageAdresse=AffichageAdresse($bdd,$_SESSION['idUser']);
           
            ?>
            <div class="row border border-primary rounded my-2">
                    <h4 class="text-center mt-3 text-uppercase">Vos adresses :</h4>
                    <input name="idadresse" value="<?php echo $AffichageAdresse['id_adresse'] ?>" hidden>
                    <div class="form-floating col-12 my-2 mb-3">
                        <input type="text" name="adresse" value="<?php echo $AffichageAdresse['adresse'] ?>" class="form-control" id="floatingInput7" placeholder="9 rue Jean Jaures" required>
                        <label for="floatingInput7" class="mx-2">Votre adresse</label>
                    </div>
                    <div class="form-floating col-6 my-2">
                        <select name="departement" id="floatingInput8" class="form-control" onchange="departementale(this.value)" required>
                            
                        <?php
                            foreach($departements as $dpt){
                        ?>
                            <option value="<?php echo $dpt['id_dept']?>" <?php if($AffichageAdresse['id_dept'] == $dpt['id_dept']){ ?>selected<?php } ?>><?php echo $dpt['nom_departement']; ?></option>
                            <?php } ?>
                        </select>
                        <label for="floatingInput8" class="mx-2">Votre Département</label>
                    </div>
                    <div class="form-floating col-6 my-2" id="ville">
                        <label for="floatingInput9" class="mx-2"><?php echo $AffichageAdresse['nom_ville']?></label>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Modifier les informations">
                </div>
            </form>
           
            <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#modifmdp" aria-expanded="false" aria-controls="collapseExample">
                Modifier l'identifiant
            </button>
            <div class="collapse <?php if(isset($_GET['erreurmdp'])){ ?>show<?php } ?>" id="modifmdp">
                    <div class="border border-primary rounded my-2">
                        <h4 class="text-center mt-3 text-uppercase">Vos identifiants :</h4>
                        <?php if(isset($_GET['erreurmdp'])){
                        
                        if($_GET['erreurmdp'] == 1){
                            echo '<p class="alert alert-danger text-center">Le mot de passe saisi est incorrect</p>';
                        }
                             } ?>
                        <form action="../controller/traitement_compte.php?action=modifmdp" method="post">
                            <div class="row mx-2">
                                <div class="form-floating col-12">
                                    <input type="password" name="oldmdp" class="form-control" id="oldmdp" placeholder="Saisir votre mot de passe actuel" required>
                                    <label for="oldmdp" class="mx-2">Saisir votre mot de passe actuel</label>
                                </div>
                                <div class="form-floating col-6 my-2">
                                    <input type="password" name="mdp" class="form-control" id="motdepasse1" placeholder="Mot de passe" onkeyup="mdpverif()" required>
                                    <label for="motdepasse1" class="mx-2">Taper votre nouveau mot de passe</label>
                                </div>
                                <div class="form-floating col-6 my-2 mb-3">
                                    <input type="password" name="mdp2" class="form-control" id="motdepasse2" placeholder="Confirmation mot de passe" onkeyup="mdpverif()" disabled required>
                                    <label for="motdepasse2" class="mx-2">Retaper le même mot de passe</label>
                                </div>
                            </div>
                            <div class="text-center">
                                    <div id="mdpverif">

                                    </div>
                                </div>
                            <div class="my-3 text-center" id="boutonSiLeMDPestValide">
                                <!--<input type="submit" class="btn btn-warning" value="Mettre à jour l\'\identifiant">-->
                            </div>
                        </form>
                    </div>
                    <?php } ?>
                </form>
            </div>
        </div>
            <div class="collapse" id="facture" data-bs-parent="#myGroup">
                <table class="table table-hover text-center">
                    <thead>
                        <tr class="table-active">
                            <th scope="col">Date</th>
                            <th scope="col">N°commande</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>28/03/2023</th>
                            <td>69898961</td>
                            <td>251 €</td>
                            <td class="text-success fw-bolder">En cours de livraison</td>
                        </tr>
                        <tr>
                            <th>10/02/2023</th>
                            <td>5165165161</td>
                            <td>21 €</td>
                            <td class="text-success fw-bolder">Expédié</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
</script>







                                   