<?php 
require '../modele/connexionpdo.php';
require '../modele/fonctions.php';

$idDept = $_GET['dept'];

$villes = recupVille($bdd, $idDept);

echo json_encode($villes);
    
?>