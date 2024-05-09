<?php
require "../modele/connexionpdo.php";
require "../modele/fonctions.php";

$email = htmlspecialchars($_POST['email']);
$mdp = password_hash(htmlspecialchars($_POST['mdp']), PASSWORD_DEFAULT);
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$dateNaiss = htmlspecialchars($_POST['datenaiss']);
$adresse = htmlspecialchars($_POST['adresse']);
$role = 2;
$ville = htmlspecialchars($_POST['id_ville']);

$tabVille = explode('-', $ville);
$idVille = $tabVille[0];
$cp = $tabVille[1];

$idUser = createUser($bdd,$nom,$role,$prenom,$dateNaiss,$email,$mdp);

insertAdresse($bdd, $adresse, $idVille, $idUser, $cp);
header('Location:../public/index.php?page=2');



