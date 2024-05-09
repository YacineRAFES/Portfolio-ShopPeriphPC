<?php
session_start();
if(!isset($_SESSION['idUser'])){
    header('Location:../public/index.php');
}
include '../vue/header.php';

?>
<div class="col-10 mt-3">
    <a href="index.php?page=9&u=1" class="btn btn-primary">Saisi</a>
    <a href="index.php?page=9&u=2" class="btn btn-primary">Gestion</a>
    <?php
        if(isset($_GET['u'])) {
            if ($_GET['u'] == 1){
                include '../vue/usersaisi.php';
            }
            if ($_GET['u'] == 2){
                include '../vue/useraffichage.php';
            }
        }else{
            include '../vue/useraffichage.php';
        }
    ?>
</div>