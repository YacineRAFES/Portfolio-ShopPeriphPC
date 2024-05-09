<?php
require '../modele/connexionpdo.php';
require '../modele/fonctions.php';
session_start();
// session_destroy();
// var_dump($_SESSION);
// die();
if(isset($_GET['action'])){
    if($_GET['action'] === 'ajoutprod'){
            $datecreation=date('Y-m-d H:i:s');
    // ici il manque l'idf du produit, la qtecom et le prix unit ???????????
    $recupidproduit=htmlspecialchars($_POST['idprod']); //Appelle l'id produit
    $qteCom=htmlspecialchars($_POST['quantite']);
    $prix = RecupPrixProd($bdd, $recupidproduit);
    
    $montantProd=$qteCom*$prix;

    /*$RecupLePrixUnit = RecupLePrixUnit($bdd, $recupidproduit);
    $RecupLeMontant = RecupLeMontant($bdd, $RecupLePrixUnit, $_SESSION['idPanier']); //Recupère le montant*/

    if(isset($_SESSION['idPanier'])){ //Si un panier existe
        $produitExists=produitExists($bdd, $recupidproduit, htmlspecialchars($_SESSION['idPanier']));
        if($produitExists){//Si le produit est déjà dans le panier
            /*ModifQuantiteProd($bdd, $recupidproduit, $qteCom, $_SESSION['idPanier']);//Modifier sa quantité (UPDATE ...)*/
            ModifQuantiteProd($bdd, $recupidproduit, $qteCom, htmlspecialchars($_SESSION['idPanier']));
        }else{//Sinon
            /*AjouterUnProduitAuPanier($bdd,$recupidproduit,$qteCom,$_SESSION['idPanier']);//Ajouter le produit au panier (INSERT ....)*/
            AjouterUnProduitAuPanier($bdd,$recupidproduit,$qteCom,htmlspecialchars($_SESSION['idPanier']),$prix);
        }//Fin si
        UpdateMontantDuPanier($bdd,$montantProd,htmlspecialchars($_SESSION['idPanier']));//UPDATE le montant du panier

    }else{ //Sinon
        if(isset($_SESSION['idUser'])){ //Si l’utilisateur s’est identifié alors
            /*CreerPanier($bdd, $montantProd, $datecreation, $_SESSION['idUser']); //Créer un panier avec l’id du user enregistré en session (INSET INTO panier ....)*/
            CreerPanier($bdd, $montantProd, $datecreation, htmlspecialchars($_SESSION['idUser']));
        }else{//Sinon
            CreerPanier($bdd, $montantProd, $datecreation, 0); //Créer un panier sans l’id du user (INSET INTO panier ....)
        }//Fin si
        $_SESSION['idPanier']=$bdd->lastInsertId(); //Enregistrer en session l’id (clé primaire) du panier qui vient d’être créé́
        /*AjouterUnProduitAuPanier($bdd,$recupidproduit,$qteCom,$_SESSION['idPanier']); //Ajouter le produit au panier (INSERT ....)*/
        AjouterUnProduitAuPanier($bdd,$recupidproduit,$qteCom, htmlspecialchars($_SESSION['idPanier']),$prix);
    }

    header('Location:../public/index.php?page=3&successAjout=ok');
    }

    if($_GET['action'] == 'supprProdPanier'){

        $detailProdDansPanier = recupDetailProdDansPanier($bdd, htmlspecialchars($_SESSION['idPanier']), htmlspecialchars($_GET['idprod']));
        SupprProdPanier($bdd, $_GET['idprod']);

      $nbProdsRestant = recupNbProdsPanier($bdd, htmlspecialchars($_SESSION['idPanier']));
        if($nbProdsRestant > 0){ // S'il reste des produits dans le panier en cours
            $montantProdPan = $detailProdDansPanier['qte_com']*$detailProdDansPanier['prix_unit'];
            ModifMontantDuPanierApresAvoirSupprLeProduit($bdd, $montantProdPan, htmlspecialchars($_SESSION['idPanier']));
        }else{
            supprimerPanier($bdd, htmlspecialchars($_SESSION['idPanier']));
            unset($_SESSION['idPanier']);
        }

        header('Location:../public/index.php?page=3&success=prodDeleted');
    }
    if($_GET['action'] === 'modifqtecom'){
        if($_GET['qtecom'] === 'moinsqtecom'){
            MoinsDeQteCom($bdd, htmlspecialchars($_GET['idprod']), htmlspecialchars($_SESSION['idPanier']));
            ModifPanierMoinsMontant($bdd, htmlspecialchars($_GET['prix']), htmlspecialchars($_SESSION['idPanier']));
        }
        if($_GET['qtecom'] === 'plusqtecom'){
            PlusDeQteCom($bdd, htmlspecialchars($_GET['idprod']), htmlspecialchars($_SESSION['idPanier']));
            ModifPanierPlusMontant($bdd, htmlspecialchars($_GET['prix']), htmlspecialchars($_SESSION['idPanier']));
        }

        $prixTotal=prixTotal($bdd,htmlspecialchars($_SESSION['idPanier']));

        $reponse = [];
        $reponse['montantPanier'] = $prixTotal['montant'];

        echo json_encode($reponse);
        /*$AfficherPan=AfficherDetailPanier($bdd,$_SESSION['idPanier']);
        foreach($AfficherPan as $AffPan){
            $montantProduit=$AffPan['qte_com']*$AffPan['prix_unit'];
        }
        $reqModifLeMontantDuPanier=$bdd->prepare('UPDATE panier SET montant=:montant WHERE id_panier=:id_panier');
        $reqModifLeMontantDuPanier->execute([':montant'=>$montantProduit,':id_panier'=>$_SESSION['idPanier']]);*/
    }
}


?>