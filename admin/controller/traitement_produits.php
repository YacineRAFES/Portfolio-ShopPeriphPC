<?php
require '../modele/fonctions.php';
if($_GET['action']){
    if($_GET['action'] == 'ajouter'){
        $marques=htmlspecialchars($_POST['marques']);
        $designation=htmlspecialchars($_POST['designation']);
        $modele=htmlspecialchars($_POST['modele']);
        $prixunit=htmlspecialchars($_POST['prixunit']);
        $description=htmlspecialchars($_POST['description']);
        $categ=htmlspecialchars($_POST['categ']);
        $souscateg=htmlspecialchars($_POST['souscateg']);
        $qtestock=htmlspecialchars($_POST['qtestock']);
        $publier=htmlspecialchars($_POST['publier']);
        $idprod=ajouterProduit($bdd, $marques, $designation, $modele, $prixunit, $description, $categ, $souscateg, $qtestock, $publier);
        if(isset($_FILES['fichier'])){
            $file_name = $_FILES['fichier']['name'];
            $file_size = $_FILES['fichier']['size'];
            $file_tmp = $_FILES['fichier']['tmp_name'];
            $file_type = $_FILES['fichier']['type'];
            move_uploaded_file($file_tmp,"../../assets/images/".$file_name);
        }
        InsertImage($bdd, $file_name, $souscateg, $categ, $idprod);
        
        header('Location:../public/index.php?page=2&s=2#'.$idprod);
    }
    if($_GET['action'] == 'modifier'){
        $marques=htmlspecialchars($_POST['marque']);
        $designation=htmlspecialchars($_POST['designation']);
        $modele=htmlspecialchars($_POST['modele']);
        $prixunit=htmlspecialchars($_POST['prixunit']);
        $description=htmlspecialchars($_POST['description']);
        $categ=htmlspecialchars($_POST['categ']);
        $souscateg=htmlspecialchars($_POST['souscateg']);
        $qtestock=htmlspecialchars($_POST['qtestock']);
        $publier=htmlspecialchars($_POST['publier']);
        $idprod=htmlspecialchars($_POST['idprod']);
        $id_img=htmlspecialchars($_POST['id_img']);
    
        if($_FILES['fichier']['name'] == ""){
            $NomImageProduits=NomImageProduits($bdd,$idprod);
            $file_name=$NomImageProduits;
        }else{
            $ImageExistantProduits=ImageExistantProduits($bdd, $id_img, $idprod);
            if($ImageExistantProduits){
                $NomImageProduits=NomImageProduits($bdd,$idprod);
                unlink("../../assets/images/".$NomImageProduits);
            }
           
            if(isset($_FILES['fichier'])){
                $file_name = $_FILES['fichier']['name'];
                $file_size = $_FILES['fichier']['size'];
                $file_tmp = $_FILES['fichier']['tmp_name'];
                $file_type = $_FILES['fichier']['type'];
                move_uploaded_file($file_tmp,"../../assets/images/".$file_name);
                    
            }
        }
        ModifierProduit($bdd, $marques, $designation, $modele, $prixunit, $description, $categ, $souscateg, $qtestock, $publier, $idprod, $file_name);
        header('Location:../public/index.php?page=4&idprod='.$idprod.'&message=modif');
    }
    if($_GET['action'] == 'suppr'){
        $idprod=htmlspecialchars($_GET['idprod']);
        supprProd($bdd,$idprod);
        header('Location:../public/index.php?page=2&s=2');
    }
    if($_GET['action'] == 'visible'){
        if($_GET['visibilite'] == 1){
            $idprod=htmlspecialchars($_GET['idprod']);
            visibleProd($bdd, $idprod, 0);
            header('Location:../public/index.php?page=2&s=2#'.$_GET['idprod']);
        }
        if($_GET['visibilite'] == 0){
            $idprod=htmlspecialchars($_GET['idprod']);
            visibleProd($bdd, $idprod, 1);
            header('Location:../public/index.php?page=2&s=2#'.$_GET['idprod']);
        }
    }
}
?>