<?php
require '../modele/fonctions.php';
session_start();
if(isset($_POST['email']) && isset($_POST['mdp'])){
    $email = htmlspecialchars($_POST['email']); //donnée à traiter plus tard
    $motDePasse = htmlspecialchars($_POST['mdp']);//donnée à traiter plus tard
    // Si l'email saisie est égale à 'admin@cci.fr' ET le mot de passe
    $userExists=userExists($bdd, $email);
    if($userExists){ // càd il existe un user avec l'email saisie dans le formulaire
        if($userExists['id_role'] == 1){
            $passwordHash = $userExists['mdp'];
            if (password_verify($motDePasse, $passwordHash)){
                // identification réussie
                $_SESSION['idUser'] = $userExists['id_user'];
                header('Location:../public/index.php?page=1');
            }   
        }else{
            header('Location:../public/index.php?erreur=identifiants');// mot de passe incorrect
        }
    }else{ // Aucun user ne correspond à l'email saisie
        header('Location:../public/index.php?erreur=identifiants');// adresse email incorrecte
    }
}

?>