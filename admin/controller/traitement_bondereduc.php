<?php
require '../modele/fonctions.php';

if($_GET['action']){
    if($_GET['action']=='ajouter'){
        $idprod=$_POST['idprod'];
        $nb_article_min=$_POST['nb_article_min'];
        $taux=$_POST['taux'];
        $datedebut=$_POST['datedebut'];
        $datefin=$_POST['datefin'];
        AjoutBonReduc($bdd, $idprod, $nb_article_min, $taux, $datedebut, $datefin);
        // header('Location:../public/index.php?page=7&c=2');
    }
}