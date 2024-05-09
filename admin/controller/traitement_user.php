<?php 
require '../modele/fonctions.php';
session_start();
if($_GET['action']){
    if($_GET['action']=='ajouter'){
        $email = htmlspecialchars($_POST['email']);
        $mdp = password_hash(htmlspecialchars($_POST['mdp']), PASSWORD_DEFAULT);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $dateNaiss = htmlspecialchars($_POST['datenaiss']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $role = htmlspecialchars($_POST['role']);
        $ville = htmlspecialchars($_POST['id_ville']);

        $tabVille = explode('-', $ville);
        $idVille = $tabVille[0];
        $cp = $tabVille[1];

        $idUser = createUser($bdd,$nom,$role,$prenom,$dateNaiss,$email,$mdp);

        insertAdresse($bdd, $adresse, $idVille, $idUser, $cp);
        header('Location:../public/index.php?page=9&u=2');
    }
    if($_GET['action']=='modifier'){
        /* Partie du recu de user */
        $iduser=htmlspecialchars(($_POST['iduser']));
        $nom=htmlspecialchars($_POST['nom']);
        $datenaiss=htmlspecialchars($_POST['datenaiss']);
        $prenom=htmlspecialchars($_POST['prenom']);
        $email=htmlspecialchars($_POST['email']);
        $role=htmlspecialchars($_POST['role']);
        /* Partie du recu de adresse */
        $adresse=htmlspecialchars($_POST['adresse']);
        $ville=htmlspecialchars($_POST['id_ville']);
        $id_adresse=htmlspecialchars($_POST['idadresse']);
        

        $tabVille = explode('-', $ville);
        $idville = $tabVille[0];
        $cp = $tabVille[1];
        ModifInformationCompte($bdd,$email, $nom,$prenom,$datenaiss,$iduser,$role);
        ModifAdresseCompte($bdd,$adresse,$idville,$cp,$id_adresse);
        header('Location:../public/index.php?page=10&iduser='.$iduser.'&message=modif');
    }
    if($_GET['action']=='disable'){

    }
    if($_GET['action'] == 'disable'){
        if($_GET['disabled'] == 0){
            $iduser=htmlspecialchars($_GET['iduser']);
            DisabledUser($bdd, $iduser, 1);
            header('Location:../public/index.php?page=9&u=2#'.$_GET['iduser']);
        }
        if($_GET['disabled'] == 1){
            $iduser=htmlspecialchars($_GET['iduser']);
            DisabledUser($bdd, $iduser, 0);
            header('Location:../public/index.php?page=9&u=2#'.$_GET['iduser']);
        }
    }
}
?>