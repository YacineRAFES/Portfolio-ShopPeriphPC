<table class="table table-hover table-bordered table-striped mt-2">
        <thead class="text-nowrap text-uppercase text-center" style="font-size: 12px;">
            <th>ID_USER</th>
            <th>NOM</th>
            <th>rôle</th>
            <th>PRENOM</th>
            <th>DATE DE NAISSANCE</th>
            <th>EMAIL</th>
            <th>statue</th>
            <th>modifier</th>
        </thead>
        <tbody cla>
            <?php
                $AffichageUser=AffichageUser($bdd);
                foreach($AffichageUser as $AffUser){
            ?>
            <tr id="<?php echo $AffUser['id_user']?>">
                <td><?php echo $AffUser['id_user']?></td>
                <td><?php echo $AffUser['nom']?></td>
                <td><?php echo $AffUser['nom_role']?></td>
                <td><?php echo $AffUser['prenom']?></td>
                <td><?php echo $AffUser['date_naiss']?></td>
                <td class=""><?php echo $AffUser['email']?></td>
                <td class="text-center"><a href="../controller/traitement_user.php?action=disable&disabled=<?php echo $AffUser['disabled']?>&iduser=<?php echo $AffUser['id_user']?>"><?php if($AffUser['disabled']== 1){?><img src="../public/assets/images/user-slash-solid.svg" width="40px" alt=""><?php }else{?><img src="../public/assets/images/user-solid.svg" width="30px" alt=""><?php }?></a></td>
                <td class="text-center"><a class="btn btn-primary" href="../public/index.php?page=10&iduser=<?php echo $AffUser['id_user']?>">Modifier</a></td>
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