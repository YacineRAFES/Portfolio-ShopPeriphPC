<div class="bg-light bg-gradient d-flex flex-column min-vh-100 ">
    <div class="container">
        <div class="row ">
            <div class="col-6 offset-3">
                <?php
                    if(isset($_GET['erreur'])){
                        if($_GET['erreur']=='identifiants'){
                            echo '<p class="alert alert-danger" role="alert">Identifiants incorrects</p>';
                        }
                    }
                ?>
                <form class="p-3 bg-white rounded-2 border border-2 mt-5" action="../controller/traitement_connexion.php" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Adresse email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                        <input type="password" name="mdp" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary " value="Connecter">                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>