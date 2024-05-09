<?php 
if(isset($_SESSION['idUser'])){
    
}else{
    header('Location:../public/index.php?page=9&p=connexion');
}
$AfficherDetailPanier=AfficherDetailPanier($bdd,$_SESSION['idPanier']);
?>
<style>
    .borderless td{
        border: none;
    }
</style>
<h3 class="mt-3 text-center text-uppercase">votre Panier</h3>
<div class="container mt-2">
    <div class="row">
    <div class="col-8">
        <table class="table table-hover table-bordered table-striped">
            <thead class="text-nowrap text-uppercase text-center">
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Prix Unit</th>
            </thead>
            <tbody>
                <?php 
                foreach ($AfficherDetailPanier as $AffDetailPanier){
                ?>
                <tr>
                    <td><?php echo $AffDetailPanier['designation']?></td>
                    <td><?php echo $AffDetailPanier['qte_com']; ?></td>
                    <td><?php echo $AffDetailPanier['prix_unit']*$AffDetailPanier['qte_com']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-4 rounded-5 p-5 border border-black">
        <table class="text-center mx-auto">
            <form class="form-control" action="">
                <tr>
                    <td><h4 class="opacity-75">Prix HT :</h4></td>
                </tr>
                <tr>
                    <td class="fw-bold fs-3"><?php $prixTotal=prixTotal($bdd,$_SESSION['idPanier']);echo $prixTotal['montant']; ?> €</td>
                </tr>
                <tr>
                    <td class="text-center"><input type="checkbox" name="" id="">Accepter les conditions.</td>
                </tr>
                <tr class="m-5">
                    <td class="text-center"><input type="submit" class=" mt-5 border rounded-pill fs-4 px-2 btn btn-primary fw-bolder text-uppercase" value="Payer"></td>
                </tr>
            </form>
        </table>
    </div>
    </div>
</div>
