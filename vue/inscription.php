<?php
$departements = affichageDepartement($bdd);
?>
<div class="container my-5">
    <div class="bg-white">
        <div class="col-md-6 offset-md-3 text-success text-center">
            <h1>Créer un compte</h1>                    
            <form method="post" action="../controller/traitement_inscription.php">
                <div class="row border border-primary rounded my-2">
                    <h5 class="my-2">Vos identifiants :</h5>
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control" id="floatingInpu1" placeholder="name@exemple.com" required>
                        <label for="floatingInput1" class="mx-2">Email</label>
                    </div>
                    <div class="form-floating col-6 my-2">
                        <input type="password" name="mdp" class="form-control" id="motdepasse1" placeholder="Mot de passe" required>
                        <label for="motdepasse1" class="mx-2">Taper votre mot de passe</label>
                        <div id="mdp1"></div>
                    </div>
                    <div class="form-floating col-6 my-2 mb-3">
                        <input type="password" name="mdp2" class="form-control" id="motdepasse2" placeholder="Confirmation mot de passe" onkeyup="mdpverif()" required>
                        <label for="motdepasse2" class="mx-2">Retaper le même mot de passe</label>
                    </div>
                    <div class="text-center">
                        <div id="mdpverif"></div>
                    </div>
                </div>
                <div class="row border border-primary rounded my-2">
                    <h5 class="my-2">Informations personnelles :</h5>
                    <div class="form-floating col-6 my-2">
                        <input type="name" name="nom" class="form-control" id="floatingInput4" placeholder="name@example.com" required>
                        <label for="floatingInput4" class="mx-2">Nom de famille</label>
                    </div>
                    <div class="form-floating col-6 my-2">
                        <input type="firstname" name="prenom" class="form-control" id="floatingInput5" placeholder="Prénom" required>
                        <label for="floatingInput5" class="mx-2">Prénom</label>
                    </div>
                    <div class="form-floating col-6 my-2 mb-3">
                        <input type="date" name="datenaiss" class="form-control" id="floatingInput6" placeholder="01/01/2023" required>
                        <label for="floatingInput6" class="mx-2">Date de naissance</label>
                    </div>
                </div>
                <div class="row border border-primary rounded my-2">
                    <h5 class="my-2">Vos adresses :</h5>
                    <div class="form-floating col-12 my-2 mb-3">
                        <input type="text" name="adresse" class="form-control" id="floatingInput7" placeholder="9 rue Jean Jaures" required>
                        <label for="floatingInput7" class="mx-2">Votre adresse</label>
                    </div>
                    <div class="form-floating col-6 my-2">
                    
                        <select name="departement" id="floatingInput8" class="form-control" onchange="departementale(this.value)" required>
                            <option value="">Sélectionner un département</option>
                        <?php
                            
                            foreach($departements as $dpt){
                            
                            
                        ?>
                            <option value="<?php echo $dpt['id_dept']?>"><?php echo $dpt['nom_departement']?></option>
                            <?php } ?>
                        </select>
                        <label for="floatingInput8" class="mx-2">Votre Département</label>
                    </div>
                    <div class="form-floating col-6 my-2" id="ville">
                        <label for="floatingInput9" class="mx-2">Votre Commune</label>
                    </div>
                </div>
                <div class="center">
                    <button type="submit" class="btn btn-primary">Créer un compte</button>
                </div>
            </form>
            <div class="mt-4">
                <a href="../public/index.php?page=9&p=connexion">Vous avez déjà un compte ?</a>
            </div>
        </div>
    </div>
</div>
