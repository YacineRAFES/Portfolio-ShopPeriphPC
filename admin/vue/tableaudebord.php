<?php
session_start();
if(!isset($_SESSION['idUser'])){
    header('Location:../public/index.php');
}
include '../vue/header.php';

?>

<div class="col-10">
    <div class="col-12 m-5 d-flex flex-wrap">
        <a href="../public/index.php?page=2" class="remove-underline">
            <div class="card text-center mx-3" style="width: 10rem;">
                <div class="card-body">
                    <h5 class="card-title">Produits</h5>
                </div>
            </div>
        </a>
        <a href="../public/index.php?page=5" class="remove-underline">
            <div class="card text-center mx-3" style="width: 10rem;">
                <div class="card-body">
                    <h5 class="card-title">Catégorie</h5>
                </div>
            </div>
        </a>
        <a href="../public/index.php?page=7" class="remove-underline">
            <div class="card text-center mx-3" style="width: 10rem;">
                <div class="card-body">
                    <h5 class="card-title">Bon de réduction</h5>
                </div>
            </div>
        </a>
    </div>
</div>