<?php
require '../modele/fonctions.php';
if($_GET['action']){
    if($_GET['action']=='ajouter'){
        $nomsouscateg=$_POST['nom_souscateg'];
        $idcateg=$_POST['idcateg'];
        AjoutSousCateg($bdd, $nomsouscateg,$idcateg);
        header('Location:../public/index.php?page=5&c=2');
    }
    if($_GET['action']=='modifier'){
        if($_GET['type']=='categ'){
            $idcateg=$_POST['id_categ'];
            $nomcateg=$_POST['nomducateg'];
            CategModif($bdd, $idcateg, $nomcateg);
            header('Location:../public/index.php?page=6&idcateg='.$idcateg.'&message=modif');
        }
        if($_GET['type']=='souscateg'){
            $idsouscateg=$_POST['id_souscateg'];
            $nomsouscateg=$_POST['nomsouscateg'];
            SousCategModif($bdd, $idsouscateg, $nomsouscateg);
            header('Location:../public/index.php?page=6&idsouscateg='.$idsouscateg.'&message=modif');
        }
    }
    // if($_GET['action']=='supprimer'){
    //     if($_GET['type']){
    //         if($_GET['type']=='categ'){

    //         }
    //         if($_GET['type']=='souscateg'){
    //             $idsouscateg=$_GET['idsouscateg'];
    //             SupprSousCateg($bdd, $idsouscateg);
    //         }
    //     }
    // }
}
?>