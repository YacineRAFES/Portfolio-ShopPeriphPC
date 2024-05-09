<?php 
require '../modele/connexionpdo.php';
require '../modele/fonctions.php';
session_start();
if(isset($_POST['email']) && isset($_POST['mdp'])){
    $email = htmlspecialchars($_POST['email']); //donnée à traiter plus tard
    $motDePasse = htmlspecialchars($_POST['mdp']);//donnée à traiter plus tard
    // Si l'email saisie est égale à 'admin@cci.fr' ET le mot de passe
    $userExists=userExists($bdd, $email);
    if($userExists){ // càd il existe un user avec l'email saisie dans le formulaire
        $passwordHash = $userExists['mdp'];
        if (password_verify($motDePasse, $passwordHash)){
            // identification réussie
            if($userExists['disabled']==0){
                $_SESSION['idUser'] = $userExists['id_user'];// $_SESSION[']
                if(isset($_SESSION['idPanier'])){
                    LierIdPanierAvecIdUtilisateur($bdd, $_SESSION['idUser'], $_SESSION['idPanier']);
                }
                header('Location:../public/index.php?page=2');
            }else{
                header('Location:../public/index.php?page=9&p=connexion&erreur=disabled');
            }
        }else{
            header('Location:../public/index.php?page=9&p=connexion&erreur=identifiants');// mot de passe incorrect
        }
    }else{ // Aucun user ne correspond à l'email saisie
        header('Location:../public/index.php?page=9&p=connexion&erreur=identifiants');// adresse email incorrecte
    }
}
?>