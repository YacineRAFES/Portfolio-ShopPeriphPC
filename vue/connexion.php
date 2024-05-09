<?php
?>
<div class="container-xl my-5">
    <div class="bg-white">
        <div class="col-md-6 offset-md-3 text-success text-center">
            <h1>Identifiez-vous</h1>
            <?php 
                if (isset($_GET['erreur'])){
                    if ($_GET['erreur'] == 'identifiants'){
                        echo '<p class="alert alert-danger" role="alert">Identifiants incorrects</p>';
                    }
                    if ($_GET['erreur'] == 'disabled'){
                        echo '<p class="alert alert-warning" role="alert">Votre compte est déactivé, veuillez contacter l\'Administrateur.</p>';
                    }
                }
                if (isset($_GET['message'])){
                    if($_GET['message'] == 'emailenvoye'){
                        echo '<p class="alert alert-success" role="alert">Un email vous a été envoyé…</p>';
                    }
                    if($_GET['message'] == 'demandemdpreset'){
                        echo '<p class="alert alert-warning" role="alert">La demande de réinistialisation n\'est pas valide.</p>';
                    }
                    if($_GET['message'] == 'demanderesetmdpvalide'){
                        echo '<p class="alert alert-warning" role="alert">La demande de réinistialisation du mot de passe est toujours valide.</p>';
                    }
                    if($_GET['message'] == 'resetmdpsuccess'){
                        echo '<p class="alert alert-success" role="alert">Le mot de passe a été changé avec succès.</p>';
                    }
                }
            ?>
            <form method="post" action="../controller/traitement_connexion.php">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"></label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"></label>
                    <input type="password" name="mdp" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="center">
                    <button type="submit" class="btn btn-success">Connexion</button>
                </div>
            </form>
            <div class="mt-4">
                <a href="../public/index.php?page=10">Vous n'avez pas un compte ? Inscrivez-vous !</a>
            </div>
            <div class="mt-4">
                <a href="../public/index.php?page=9&p=motdepasseoublie">Mot de passe oublié ? Cliquez ici !</a>
            </div>
        </div>
    </div>
</div>