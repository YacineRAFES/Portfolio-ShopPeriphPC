<?php
    $AffichageBonReduc=AffichageBonReduc($bdd);
?>
<div class="col-6 offset-2">
    <table class="table table-hover table-bordered table-striped mt-2">
        <thead class="text-nowrap text-uppercase text-center">
            <th>id_bon</th>
            <th>id_prod</th>
            <th>nb_article_min</th>
            <th>taux</th>
            <th>date_debut</th>
            <th>date_fin</th>
            <th>Modifier</th>
        </thead>
        <tbody>
            <?php
            foreach($AffichageBonReduc as $AffBonReduc){
            ?>
            <tr>
                <td><?php echo $AffBonReduc['id_bon']?></td>
                <td><?php echo $AffBonReduc['id_prod']?></td>
                <td><?php echo $AffBonReduc['nb_article_min']?></td>
                <td><?php echo $AffBonReduc['taux']?></td>
                <td><?php $date = new DateTime($AffBonReduc['date_debut']); echo $date->format('d/m/Y')?></td>
                <td><?php $date = new DateTime($AffBonReduc['date_fin']); echo $date->format('d/m/Y')?></td>
                <td><a href="../public/index.php?page=8&idbon=<?php echo $AffBonReduc['id_bon']?>" class="btn btn-primary">Modifier</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>    
</div>