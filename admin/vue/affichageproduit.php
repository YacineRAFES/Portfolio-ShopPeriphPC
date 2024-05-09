
    <table class="table table-hover table-bordered table-striped mt-2">
        <thead class="text-nowrap" style="font-size: 12px;">
            <th>ID_PROD</th>
            <th>MARQUE</th>
            <th>DESIGNATION</th>
            <th>MODELE</th>
            <th>PRIX UNIT</th>
            <th>DESCRIPTION</th>
            <th>CATEGORIE</th>
            <th>SOUS-CATEG</th>
            <th>STOCK</th>
            <th>SUPPRIMER</th>
            <th>VISIBILITÉ</th>
            <th>MODIFIER</th>
        </thead>
        <tbody>
            <?php
            $Produits=Produits($bdd);
            foreach($Produits as $pds){
            ?>
            <tr id="<?php echo $pds['id_prod']?>">
                <td><?php echo $pds['id_prod']?></td>
                <td><?php echo $pds['marque']?></td>
                <td><?php echo $pds['designation']?></td>
                <td><?php echo $pds['modele']?></td>
                <td><?php echo $pds['prix_unit']?></td>
                <td class=""><?php echo $pds['description']?></td>
                <td><?php echo $pds['nom_categ']?></td>
                <td><?php echo $pds['nom_souscateg']?></td>
                <td><?php echo $pds['qte_stock']?></td>
                <td><a href="../controller/traitement_produits.php?action=suppr&idprod=<?php echo $pds['id_prod']?>" class="btn btn-danger">Supprimer</a></td>
                
                <td class="text-center"><a href="../controller/traitement_produits.php?action=visible&visibilite=<?php echo $pds['publier']?>&idprod=<?php echo $pds['id_prod']?>"><?php if($pds['publier']== 0){?><img src="../public/assets/images/eye-slash-solid.svg" width="40px" alt=""><?php }else{?><img src="../public/assets/images/eye-regular.svg" width="40px" alt=""><?php }?></a></td>
                <!--
                <td class="text-center"><a id="visible" onclick="visible(<?php echo $pds['publier']?>)" href="../controller/traitement_produits.php?action=visible&visibilite=<?php echo $pds['publier']?>&idprod=<?php echo $pds['id_prod']?>"><?php if($pds['publier']== 0){?><img src="../public/assets/images/eye-slash-solid.svg" width="40px" alt=""><?php }else{?><img src="../public/assets/images/eye-regular.svg" width="40px" alt=""><?php }?></a></td>
                -->
                <td><a class="btn btn-primary" href="../public/index.php?page=4&idprod=<?php echo $pds['id_prod']?>">Modifier</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<script>
    /*function visible(a){
        let yeux = '<img src="../public/assets/images/eye-regular.svg" width="40px" alt="">';
        let yeuxslash = '<img src="../public/assets/images/eye-slash-solid.svg" width="40px" alt="">';
        if (a == 1) {
            document.getElementById("visible").innerHTML=yeux;
        }else{
            document.getElementById("visible").innerHTML=yeuxslash;
        }
    }*/
</script>