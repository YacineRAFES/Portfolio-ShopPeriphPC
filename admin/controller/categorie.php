<?php 

require '../modele/fonctions.php';

$idcateg=$_GET['idcateg'];

$RecupCateg=RecupCateg($bdd, $idcateg);

echo json_encode($RecupCateg);