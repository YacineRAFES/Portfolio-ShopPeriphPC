<div class="col-6 offset-2">
    <table class="table table-hover table-bordered table-striped mt-2">
        <thead class="text-nowrap text-uppercase text-center" style="font-size: 15px;">
            <th>Catégorie</th>
            <th>Sous-catégorie</th>
            <th>Modifier</th>
        </thead>
        <tbody>
            <?php 
            foreach($AffichageCateg as $AffCateg){
                
            ?>
            <tr>
                <td><?php echo $AffCateg['nom_categ'] ?></td>
                <td>
                    <table>
                        <?php foreach($AffichageSousCateg as $AffSousCateg){?>
                            <?php if($AffSousCateg['id_categ']==$AffCateg['id_categ']){ ?>
                                <tr>
                                    <td><?php echo $AffSousCateg['nom_souscateg']; ?></td>
                                </tr>
                            <?php }?>
                        <?php }?>
                    </table>
                <td class="text-center"><a href="../public/index.php?page=6&idcateg=<?php echo $AffCateg['id_categ']?>" class="btn btn-primary">Modifier</a></td>
            </tr>
            <?php }?>
        </tbody>
        
    </table>
</div>