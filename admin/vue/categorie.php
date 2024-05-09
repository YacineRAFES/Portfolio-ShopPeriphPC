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
    <a href="index.php?page=5&c=1" class="btn btn-primary">Saisi</a>
    <a href="index.php?page=5&c=2" class="btn btn-primary">Gestion</a>


<?php
if(isset($_GET['c'])) {
    if ($_GET['c'] == 1){
        include '../vue/saisicategorie.php';
    }
    if ($_GET['c'] == 2){
        include '../vue/affichagecateg.php';
    }
}else{
    include '../vue/affichagecateg.php';
}

?>
</div>