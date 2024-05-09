<?php
require '../modele/fonctions.php';
session_start();
// $mdp = password_hash('test2', PASSWORD_DEFAULT);
// ModifIdentifiant($bdd,$mdp,2);
// die();
$VerifUser=VerifUser($bdd,htmlspecialchars($_SESSION['idUser']));
if($_GET['action']){
    /*if($_GET['action']=='verifoldmdp'){
        $oldmdp=$_POST['oldmdp'];
        $passwordHash = $VerifUser['mdp'];
        if (password_verify($oldmdp, $passwordHash)){
            echo 'ok';
        }
    }*/
    if($_GET['action']=='modifinfo'){
        $nom=htmlspecialchars($_POST['nom']);
        $datenaiss=htmlspecialchars($_POST['datenaiss']);
        $prenom=htmlspecialchars($_POST['prenom']);
        $email=htmlspecialchars($_POST['email']);
        $adresse=htmlspecialchars($_POST['adresse']);
        $ville=htmlspecialchars($_POST['id_ville']);
        $id_adresse=htmlspecialchars($_POST['idadresse']);

        $tabVille = explode('-', $ville);
        $idville = $tabVille[0];
        $cp = $tabVille[1];
        ModifInformationCompte($bdd,$nom,$prenom,$datenaiss,htmlspecialchars($_SESSION['idUser']));
        ModifAdresseCompte($bdd,$adresse,$idville,$cp,$id_adresse);
        header('Location:../public/index.php?page=11&majinfo=1');
    }
    if($_GET['action']=='modifmdp'){
        $oldmdp=htmlspecialchars($_POST['oldmdp']);
        $passwordHash = $VerifUser['mdp'];
        if (password_verify($oldmdp, $passwordHash)){
            $mdp = password_hash(htmlspecialchars($_POST['mdp2']), PASSWORD_DEFAULT);
            ModifIdentifiant($bdd,$mdp,htmlspecialchars($_SESSION['idUser']));
            header('Location:../controller/traitement_deconnexion.php');
        }else{
            header('Location:../public/index.php?page=11&erreurmdp=1');
        }
        
    }
    
}


/*ModifIdentifiant($bdd,$email,$mdp,$_SESSION['idUser']);
header('Location:../controller/traitement_deconnexion.php');*/





/*$OnVerifieSiIDuserEtIDAdresseCorrespond=OnVerifieSiIDuserEtIDAdresseCorrespond($bdd, $id_adresse, $_SESSION['idUser']);
if($OnVerifieSiIDuserEtIDAdresseCorrespond == 1){
    
    header('Location:../public/index.php?page=11&p=profil');
}else{
    $messageErreur='Erreur de modification de l\'adresse';
    header('Location:../public/index.php?page=11&p=profil&erreur='.$messageErreur);
}*/

//header('Location:../controller/traitement_deconnexion.php');


/*
if($_GET['action']){
    if($_GET['action']=='infoperso'){
        $nom=$_POST['nom'];
        $datenaiss=$_POST['datenaiss'];
        $prenom=$_POST['prenom'];
        
        ModifInformationCompte($bdd,$nom,$prenom,$datenaiss,$_SESSION['idUser']);
    }
    if($_GET['action']=='adresse'){
        $adresse=$_POST['adresse'];
        $departement=$_POST['departement'];
        $ville=$_POST['id_ville'];
        $id_adresse=$_POST['idadresse'];

        $tabVille = explode('-', $ville);
        $idville = $tabVille[0];
        $cp = $tabVille[1];

        $OnVerifieSiIDuserEtIDAdresseCorrespond=OnVerifieSiIDuserEtIDAdresseCorrespond($bdd, $id_adresse, $_SESSION['idUser']);
        if($OnVerifieSiIDuserEtIDAdresseCorrespond == 1){
            ModifAdresseCompte($bdd,$adresse,$idville,$cp,$id_adresse);
            header('Location:../public/index.php?page=11&p=profil');
        }else{
            $messageErreur='Erreur de modification de l\'adresse';
            header('Location:../public/index.php?page=11&p=profil&erreur='.$messageErreur);
        }
        
    }
    if($_GET['action']=='identifiant'){
        $email=$_POST['email'];
        
        header('Location:../controller/traitement_deconnexion.php');
    }
}*/

?>