<?php
require '../modele/fonctions.php';

$motcle = htmlspecialchars($_GET['motcle']);

$produits = recupProduit($bdd, $motcle);

echo json_encode($produits);