<?php
session_start();
if(!isset($_SESSION['idUser'])){
    header('Location:../public/index.php');
}
include '../vue/header.php';
$AffichageCateg=AffichageCateg($bdd);
$AffichageSousCateg=AffichageSousCateg($bdd);
?>
<div class="col-10 mt-3">
    <a href="index.php?page=2&s=1" class="btn btn-primary">Saisi</a>
    <a href="index.php?page=2&s=2" class="btn btn-primary">Gestion</a>


<?php
if(isset($_GET['s'])) {
    if ($_GET['s'] == 1){
        include '../vue/saisiproduits.php';
    }
    if ($_GET['s'] == 2){
        include '../vue/affichageproduit.php';
    }
}else{
    include '../vue/affichageproduit.php';
}

?>
</div>