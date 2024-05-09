<div class="col-6 offset-2">
    <h4 class="text-center mt-2">Ajouter un nouveau catégorie</h4>
    <table class="table table-bordered  table-striped">
        <thead class="text-uppercase text-center">
            <th>#</th>
            <th>à saisir</th>
        </thead>
        <tbody>
            <form class="form-control" action="../controller/traitement_categorie.php?action=ajouter" method="post">
                <tr>
                    <td>Nom de sous-categorie</td>
                    <td><input class="form-control" name="nom_souscateg" type="text"></td>
                </tr>
                <tr>
                    <td>Catégorie parent</td>
                    <td>
                        <select class="form-select" name="idcateg" id="" required>
                            <option value="" selected disabled>Sélectionner un catégorie parent</option>
                            <?php
                            foreach($AffichageCateg as $AffCateg){
                            ?>
                            <option value="<?php echo $AffCateg['id_categ']?>" selected><?php echo $AffCateg['nom_categ']?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-center"><input class="btn btn-primary" type="submit" value="Ajouter"></td>
            </tr>
            </form>
        </tfoot>
    </table>
</div>