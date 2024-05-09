<div class="row">
    <div class="col-6 offset-2">
        <form action="../controller/traitement_produits.php?action=ajouter" method="post" enctype="multipart/form-data">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>#</th>
                    <th>Modification</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Marques</td>
                        <td><input class="form-control" type="text" name="marques" id=""></td>
                    </tr>
                    <tr>
                        <td>Désignation</td>
                        <td><input class="form-control" type="text" name="designation" id=""></td>
                    </tr>
                    <tr>
                        <td>Modèle</td>
                        <td><input class="form-control" type="text" name="modele" id=""></td>
                    </tr>
                    <tr>
                        <td>Prix Unit</td>
                        <td><input class="form-control" type="text" name="prixunit" id=""></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea></td>
                    </tr>
                    <tr>
                        <td>Catégories</td>
                        <td>
                            <select class="form-control" name="categ" class="form-select" id="" onchange="categs(this.value);">
                                <option selected>Sélectionner une catégorie</option>
                                <?php 
                                    foreach($AffichageCateg as $AffCateg){
                                ?>
                                    <option value="<?php echo $AffCateg['id_categ']?>" ><?php echo $AffCateg['nom_categ']?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Sous catégorie</td>
                        <td>
                            <div id="sous-categ">
                                <select class="form-control" name="souscateg" class="form-select" id="" required>
                                    <option value="" disabled selected>Veuillez définir le catégorie au-dessus</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Quantité Stock</td>
                        <td><input class="form-control" type="text" name="qtestock" id=""></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center fw-bolder">Ajouter une image</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="form-control" type="file" name="fichier" id="formFile"></td>
                    </tr>
                    <tr>
                        <td>Publication</td>
                        <td>
                            <select class="form-control" name="publier" id="">
                                <option value="0" selected>Non publié</option>
                                <option value="1">Publié</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-center fw-bolder">Enregistrer les paramètres</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center"><input type="submit" class="btn btn-primary" value="Enregistrer"></td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>