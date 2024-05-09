<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-3">
            <div class="m-3 p-3 text-center border border-primary rounded">

                <form action="../controller/traitement_mdpoublie.php?action=mdpoublie" method="post">
                    <h5>Vous avez oublié votre mot de passe ?</h5>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Adresse email</label>
                    </div>
                    <div class="">
                        <button class="btn btn-warning" type="submit">Envoyer une demande de réinistialisation</button>
                    </div>
                </form>
            </div>
            <a class="m-3 p-3 text-center" href="../public/index.php?page=9&p=connexion">Retourner à la page de connexion</a>
        </div>
    </div>
</div>