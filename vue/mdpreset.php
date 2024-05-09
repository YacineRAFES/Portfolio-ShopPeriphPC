<?php 
// Lien : index.php?mdpreset=valide

?>

<div class="container">
    <div class="row">
        <div class="col-5 offset-3 text-center mt-5">
            <form action="../controller/traitement_mdpoublie.php?action=resetmdp&iduser=<?php echo $_GET['iduser']; ?>" method="post">
                <h5>Réinitialiser votre mot de passe</h5>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="motdepasse1" placeholder="Nouveau mot de passe" onkeyup="mdpverif()" required>
                    <label for="motdepasse1">Nouveau mot de passe</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="newmdp" class="form-control my-3" id="motdepasse2" placeholder="Retaper le même mot de passe" onkeyup="mdpverif()" required disabled>
                    <label for="motdepasse2">Retaper le même mot de passe</label>
                </div>
                <div id="mdpverif"></div>
                <div class="my-3 text-center" id="boutonSiLeMDPestValide">
                    <!--<input type="submit" class="btn btn-warning" value="Mettre à jour l\'\identifiant">-->
                </div>
            </form>
        </div>
    </div>
</div>