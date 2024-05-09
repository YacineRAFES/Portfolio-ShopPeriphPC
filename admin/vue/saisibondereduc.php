<div class="col-6 offset-2">
    <form action="../controller/traitement_bondereduc.php?action=ajouter" method="post">
        <table class="table table-hover table-bordered table-striped mt-2">
            <thead class="text-nowrap text-uppercase text-center">
                <th>#</th>
                <th>à saisir</th>
            </thead>
            <tbody>
                <tr>
                    <td>Produit concerné</td>
                    <td>
                        <select class="form-select" name="idprod" id="">
                            <?php $Produits=Produits($bdd);
                            foreach($Produits as $pds){
                            ?>
                            <option value="<?php echo $pds['id_prod']?>">
                                    <?php echo $pds['designation']?>
                            </option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Nombre article min</td>
                    <td><input type="text" name="nb_article_min" class="form-control" id=""></td>
                </tr>
                <tr>
                    <td>Taux</td>
                    <td><div class="input-group"><input type="number" class="form-control" name="taux" id="">
                    <span class="input-group-text">%</span></div></td>
                </tr>
                <tr>
                    <td>date debut</td>
                    <td><input type="date" class="form-control" name="datedebut" id=""></td>
                </tr>
                <tr>
                    <td>date fin</td>
                    <td><input type="date" class="form-control" name="datefin" id=""></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-center"><input type="submit" class="btn btn-primary" value="Ajouter"></td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>