<?php
    require 'connexionpdo.php';
    
    /******************************
     * CONNEXION D'UN UTILISATEUR *
     ******************************/

     function userExists($bdd, $email){
        $req = 'SELECT * FROM utilisateur WHERE email = :mail';
        $reqUserExists = $bdd->prepare($req);
        $reqUserExists->execute([':mail'=>$email]);
        $userExists = $reqUserExists->fetch();
        
        return $userExists; // TRES IMPORTANT 
    }
    function LierIdPanierAvecIdUtilisateur($bdd, $idUser, $idPanier){
    
    $reqLierIdPanierAvecIdUtilisateur=$bdd->prepare('UPDATE panier SET id_user = :id_user WHERE id_panier= :id_panier');
    $reqLierIdPanierAvecIdUtilisateur->execute([':id_user'=>$idUser,':id_panier'=>$idPanier]);
    }
    /**********
     * PANIER *
     **********/
    function AfficherMontant($bdd, $idpanier){
        $reqAfficherMontant=$bdd->prepare('SELECT * FROM panier WHERE id_panier=:id_panier');
        $reqAfficherMontant->execute([':id_panier'=>$idpanier]);
        $AfficherMontant=$reqAfficherMontant->fetch();

        return $AfficherMontant['montant'];
    }
    function RecupLePrixUnit($bdd, $recupidproduit){
        $reqRecupLePrixUnit=$bdd->prepare("SELECT prix_unit FROM produits WHERE id_prod=:idprod");
        $reqRecupLePrixUnit->execute([':idprod'=>$recupidproduit]);
        $RecupLePrixUnit=$reqRecupLePrixUnit->fetch();

        return $RecupLePrixUnit;
    }

    function panierExists($bdd,$idUser){
        $reqPanierExists=$bdd->prepare("SELECT id_panier FROM panier WHERE id_user = :iduser");
        $reqPanierExists->execute([':iduser'=>$idUser]);
        $panierExists = $reqPanierExists->fetch();

        return $panierExists;
    }

    function ModifQuantiteProd($bdd, $idproduit, $quantite, $idpanier){
        $reqmodifiequantite=$bdd->prepare('UPDATE detail_panier SET qte_com = qte_com + :quantite WHERE id_panier=:idpanier AND id_prod = :idprod'); //Modifier sa quantité (UPDATE ...)
        $reqmodifiequantite->execute([':quantite'=>$quantite, ':idpanier'=>$idpanier, ':idprod'=>$idproduit]);     
    }
    function produitExists($bdd, $idprod, $idpanier){
        $reqProduitExists=$bdd->prepare('SELECT * FROM detail_panier WHERE id_prod=:idprod AND id_panier=:idpanier');
        $reqProduitExists->execute([':idprod'=>$idprod,':idpanier'=>$idpanier]);
        $produitExists = $reqProduitExists->fetch();
        
        return $produitExists;
    }

    function AjouterUnProduitAuPanier($bdd,$idproduit,$quantite,$idpanier,$prix){
        $reqajouter=$bdd->prepare('INSERT INTO detail_panier(id_prod, qte_com, prix_unit, id_panier) VALUES (:idprod, :quantite, :prix_unit, :idpanier)');
            $reqajouter->execute([':idprod'=>$idproduit, ':quantite'=>$quantite, ':prix_unit'=>$prix, ':idpanier'=>$idpanier]);
    }

    function RecupLeMontant($bdd, $idpanier){
        $reqRecupLeMontant=$bdd->prepare('SELECT SUM(qte_com*prix_unit) FROM detail_panier WHERE id_panier=:idpanier');
        $reqRecupLeMontant->execute([':idpanier'=>$idpanier]);
        $RecupLeMontant=$reqRecupLeMontant->fetch();

        return $RecupLeMontant;
    }

    function UpdateMontantDuPanier($bdd,$montantProd,$idpanier){
        $requpdatemontant=$bdd->prepare('UPDATE panier SET montant=montant+:montant WHERE id_panier=:idpanier');
        $requpdatemontant->execute([':montant'=>$montantProd,':idpanier'=>$idpanier]);
    }

    

    function recupQuantite($bdd, $recupidproduit, $id_panier){
        $reqRecupQuantite=$bdd->prepare('SELECT qte_com FROM detail_panier WHERE id_prod = :idprod AND id_panier=:idpanier');
        $reqRecupQuantite->execute([':idprod' => $recupidproduit, ':idpanier'=>$id_panier]);
        $resQuantite = $reqRecupQuantite->fetch();

        return $resQuantite;
    }
    function RecupPrixProd($bdd, $idprod){
        $reqRecupPrixProd=$bdd->prepare('SELECT prix_unit FROM produits WHERE id_prod=:idprod');
        $reqRecupPrixProd->execute([':idprod'=>$idprod]);
        $prix=$reqRecupPrixProd->fetch();

        return $prix['prix_unit'];
    }

    function prixtotal($bdd,$idpanier){
        $reqPrixTotal=$bdd->prepare('SELECT * FROM panier WHERE id_panier=:idpanier;');
        $reqPrixTotal->execute([':idpanier'=>$idpanier]);
        $prixTotal = $reqPrixTotal->fetch();

        return $prixTotal;
    }

    function NombreDeProduit($bdd,$idpanier){
        $reqAfficherNombreDeProduit=$bdd->prepare('SELECT COUNT(id_prod) as nbProd FROM detail_panier WHERE id_panier=:idpanier');
        $reqAfficherNombreDeProduit->execute([':idpanier'=>$idpanier]);
        $NombreDeProduit=$reqAfficherNombreDeProduit->fetch();

        return $NombreDeProduit['nbProd'];
    }

    function AfficherDetailPanier($bdd,$idpanier){
        $reqAfficherDetailPanier=$bdd->prepare('SELECT * FROM detail_panier,images,produits,panier WHERE panier.id_panier=:idpanier 
        AND detail_panier.id_prod=images.id_prod 
        AND images.id_prod=produits.id_prod 
        AND detail_panier.id_panier=panier.id_panier');
        $reqAfficherDetailPanier->execute([':idpanier'=>$idpanier]);
        $AfficherDetailPanier=$reqAfficherDetailPanier->fetchAll();

        return $AfficherDetailPanier;
    }

    /******************************************************
     * REQUETE POUR S'AFFICHER LES PRODUITS DANS UNE PAGE *
     ******************************************************/
    function afficherCateg($bdd) {
        $reqafficherCateg=$bdd->prepare('SELECT fichier as img, nom_categ as NomCategorie, link FROM categorie, images WHERE categorie.id_categ=images.id_categ GROUP BY nom_categ');
        $reqafficherCateg->execute();
        $afficherCateg=$reqafficherCateg->fetchAll();

        return $afficherCateg;
    }
    function afficherAccessoirePC($bdd) {
        $reqAfficherAccessoirePC = $bdd->prepare('SELECT * FROM produits, images WHERE produits.id_categ=6 AND produits.id_prod=images.id_prod AND produits.publier=1;');
        $reqAfficherAccessoirePC->execute();
        $afficherAccessoirePC = $reqAfficherAccessoirePC->fetchAll();

        return $afficherAccessoirePC;
    }
    
    function afficherImprimante($bdd) {
        $reqAfficherImprimante = $bdd->prepare('SELECT * FROM produits, images WHERE produits.id_categ=4 AND produits.id_prod=images.id_prod AND produits.publier=1;');
        $reqAfficherImprimante->execute();
        $afficherImprimante = $reqAfficherImprimante->fetchAll();

        return $afficherImprimante;
    }

    function afficherCasqueetmicro($bdd) {
        $reqAfficherCasqueetmicro = $bdd->prepare('SELECT * FROM produits, images WHERE produits.id_categ=1 AND produits.id_prod=images.id_prod AND produits.publier=1;');
        $reqAfficherCasqueetmicro->execute();
        $afficherCasqueetmicro = $reqAfficherCasqueetmicro->fetchAll();

        return $afficherCasqueetmicro;
    }
    
    function afficherSouris($bdd) {
        $reqAfficherSouris = $bdd->prepare('SELECT * FROM produits, images WHERE produits.id_categ=5 AND produits.id_prod=images.id_prod AND produits.publier=1;');
        $reqAfficherSouris->execute();
        $afficherSouris = $reqAfficherSouris->fetchAll();

        return $afficherSouris;
    }

    function afficherEcran($bdd) {
        $reqAfficherEcran =$bdd->prepare('SELECT * FROM produits, images WHERE produits.id_categ=7 AND produits.id_prod=images.id_prod AND produits.publier=1;');
        $reqAfficherEcran->execute();
        $afficherEcran = $reqAfficherEcran->fetchAll();

        return $afficherEcran;
    }

    function afficherClavier($bdd) {
        $reqAfficherClavier =$bdd->prepare('SELECT * FROM produits, images WHERE produits.id_categ=2 AND produits.id_prod=images.id_prod AND produits.publier=1;');
        $reqAfficherClavier->execute();
        $afficherClavier = $reqAfficherClavier->fetchAll();

        return $afficherClavier;
    }

    function createUser($bdd,$nom,$role,$prenom,$dateNaiss,$email,$mdp){
        $reqCreateUser=$bdd->prepare("INSERT INTO utilisateur(nom,role,prenom,date_naiss,email,mdp) VALUES (:nom,:role,:prenom,:date,:email,:mdp)");
        $reqCreateUser->execute([':nom'=>$nom,':role'=>$role,':prenom'=>$prenom,':date'=>$dateNaiss,':email'=>$email,':mdp'=>$mdp]);
        return $bdd->lastInsertId();    
    }

    
    function CreerPanier($bdd, $montantProd, $datecreation, $idUser){
        if($idUser == 0){
            $req = 'INSERT INTO panier(montant, date_creation) VALUES (?,?)';
            $tabValues = [$montantProd, $datecreation];
        }else{
            $req = 'INSERT INTO panier(montant, date_creation, id_user) VALUES (?,?,?)';
            $tabValues = [$montantProd, $datecreation, $idUser];
        }
        $reqInsertPanier=$bdd->prepare($req);
        $reqInsertPanier->execute($tabValues);
    }
    
    function MoinsDeQteCom($bdd, $idproduit, $idpanier){
        $reqMoinsDeQteCom=$bdd->prepare('UPDATE detail_panier SET qte_com = qte_com - :qte_com WHERE id_prod = :id_prod AND id_panier = :id_panier');
        $reqMoinsDeQteCom->execute([':qte_com'=>1,':id_prod'=>$idproduit,':id_panier'=>$idpanier]);
        
    }

    function ModifPanierMoinsMontant($bdd, $prix, $idpanier){
        $reqMoinsDeQteCom=$bdd->prepare('UPDATE panier SET montant = montant - :prix WHERE id_panier = :id_panier');
        $reqMoinsDeQteCom->execute([':prix'=>$prix,':id_panier'=>$idpanier]);
    }
    
    function PlusDeQteCom($bdd, $idproduit, $idpanier){
        $reqPlusDeQteCom=$bdd->prepare('UPDATE detail_panier SET qte_com = qte_com + :qte_com WHERE id_prod = :id_prod AND id_panier = :id_panier');
        $reqPlusDeQteCom->execute([':qte_com'=>1,':id_prod'=>$idproduit,':id_panier'=>$idpanier]);
        
    }

    function ModifPanierPlusMontant($bdd, $prix, $idpanier){
        $reqMoinsDeQteCom=$bdd->prepare('UPDATE panier SET montant = montant + :prix WHERE id_panier = :id_panier');
        $reqMoinsDeQteCom->execute([':prix'=>$prix,':id_panier'=>$idpanier]);
    }

    function SupprProdPanier($bdd, $idproduit){
        $reqSupprimerLeProduitDansLePanier=$bdd->prepare('DELETE FROM detail_panier WHERE id_prod=:id_prod');
        $reqSupprimerLeProduitDansLePanier->execute([':id_prod'=>$idproduit]);

    }

    function ModifMontantDuPanierApresAvoirSupprLeProduit($bdd, $prix, $idpanier){
        $reqModifLeMontantDuPanier=$bdd->prepare('UPDATE panier SET montant=montant-:prix WHERE id_panier=:id_panier');
        $reqModifLeMontantDuPanier->execute([':prix'=>$prix,':id_panier'=>$idpanier]);
    }

    function recupDetailProdDansPanier($bdd, $idPanier, $idprod){
        $reqDetailProdPan=$bdd->prepare("SELECT * FROM detail_panier WHERE id_panier = :id_panier AND id_prod = :idProd");
        $reqDetailProdPan->execute([':id_panier'=>$idPanier, ':idProd'=>$idprod]);
        $detailProdPan=$reqDetailProdPan->fetch();
    
        return $detailProdPan;
    }

    function recupNbProdsPanier($bdd, $idPanier){
        $reqNbProdsPanier=$bdd->prepare("SELECT COUNT(*) as nbProds FROM detail_panier WHERE id_panier = :id_panier");
        $reqNbProdsPanier->execute([':id_panier'=>$idPanier]);
        $nbProdsPanier=$reqNbProdsPanier->fetch();
    
        return $nbProdsPanier['nbProds'];
    }

    function supprimerPanier($bdd, $idPanier){
        $reqNbProdsPanier=$bdd->prepare("DELETE FROM panier WHERE id_panier = :id_panier");
        $reqNbProdsPanier->execute([':id_panier'=>$idPanier]);
    }
        /**********************
         * PARTIE INSCRIPTION *
         **********************/
    function recupVille($bdd,$iddept){
        $reqDepartement=$bdd->prepare("SELECT * FROM ville WHERE id_dept = :iddept ORDER BY nom_ville ASC");
        $reqDepartement->execute([':iddept'=>$iddept]);
        $villes=$reqDepartement->fetchAll();
    
        return $villes;
    }
    function affichageDepartement($bdd){
        $reqAffichageDepartement=$bdd->prepare('SELECT * FROM departement ORDER BY nom_departement ASC');
        $reqAffichageDepartement->execute();
        $affichageDepartement=$reqAffichageDepartement->fetchAll();

        return $affichageDepartement;
    }
    function insertAdresse($bdd, $adresse, $ville, $idUser, $cp){
        $reqCreateAdress=$bdd->prepare("INSERT INTO adresses(adresse,id_ville, cp, id_user) VALUES (?,?,?,?)");
        $reqCreateAdress->execute([$adresse,$ville,$cp,$idUser]);
    }
    /*****************
     * PARTIE COMPTE *
     *****************/
    function AffichageCompte($bdd,$idUser){
        $reqAffichageCompte=$bdd->prepare('SELECT * FROM utilisateur WHERE id_user=:id_user');
        $reqAffichageCompte->execute([':id_user'=>$idUser]);
        $AffichageCompte=$reqAffichageCompte->fetchAll();

        return $AffichageCompte;
    }

    function ModifInformationCompte($bdd,$nom,$prenom,$datenaiss,$idUser){
        $reqModifInformationCompte=$bdd->prepare('UPDATE utilisateur SET nom = :nom, prenom = :prenom, date_naiss = :datenaiss WHERE id_user = :id_user');
        $reqModifInformationCompte->execute([':nom'=>$nom,':prenom'=>$prenom,':datenaiss'=>$datenaiss,':id_user'=>$idUser]);
    }

    function AffichageAdresse($bdd,$idUser){
        $reqAffichageAdresse=$bdd->prepare('SELECT * FROM departement,ville,adresses WHERE adresses.id_user=:id_user AND adresses.id_ville=ville.id_ville AND ville.id_dept=departement.id_dept');
        $reqAffichageAdresse->execute([':id_user'=>$idUser]);
        $AffichageAdresse=$reqAffichageAdresse->fetch();
        
        return $AffichageAdresse;
    }
    
    function ModifAdresseCompte($bdd,$adresse,$ville,$cp,$id_adresse){
        $reqModifAdresseCompte=$bdd->prepare('UPDATE adresses SET adresse=:adresse, id_ville=:id_ville, cp=:cp WHERE id_adresse=:id_adresse');
        $reqModifAdresseCompte->execute([':adresse'=>$adresse,':id_ville'=>$ville,':cp'=>$cp,':id_adresse'=>$id_adresse]);
    }

    function ModifIdentifiant($bdd,$mdp,$idUser){
        $reqModifIdentifiant=$bdd->prepare('UPDATE utilisateur SET mdp=:mdp WHERE id_user=:id_user');
        $reqModifIdentifiant->execute([':mdp'=>$mdp,':id_user'=>$idUser]);
    }
    function OnVerifieSiIDuserEtIDAdresseCorrespond($bdd, $id_adresse, $idUser){
        $reqOnVerifieSiIDuserEtIDAdresseCorrespond=$bdd->prepare('SELECT COUNT(*) FROM adresses WHERE id_user=:id_user AND id_adresse=:id_adresse');
        $reqOnVerifieSiIDuserEtIDAdresseCorrespond->execute([':id_user'=>$idUser, ':id_adresse'=>$id_adresse]);
        $OnVerifieSiIDuserEtIDAdresseCorrespond=$reqOnVerifieSiIDuserEtIDAdresseCorrespond->fetchAll();

        $OnVerifieSiIDuserEtIDAdresseCorrespond;
    }

    function VerifRole($bdd,$idUser){
        $reqVerifRole=$bdd->prepare('SELECT * FROM utilisateur WHERE id_user=:id_user');
        $reqVerifRole->execute([':id_user'=>$idUser]);
        $VerifRole=$reqVerifRole->fetch();

        return $VerifRole['role'];
    }

    function AffichageUser($bdd,$idUser){
        $reqAffichageUser=$bdd->prepare('SELECT nom, prenom, email, date_naiss FROM utilisateur, adresses WHERE utilisateur.id_user=:id_user AND utilisateur.id_user=adresses.id_user');
        $reqAffichageUser->execute([':id_user'=>$idUser]);
        $AffichageUser=$reqAffichageUser->fetchAll();

        return $AffichageUser;
    }

    function VerifUser($bdd,$idUser){
        $reqVerifUser=$bdd->prepare('SELECT mdp FROM utilisateur WHERE id_user=:id_user');
        $reqVerifUser->execute([':id_user'=>$idUser]);
        $VerifUser=$reqVerifUser->fetch();

        return $VerifUser;
    }

    function token($bdd, $token, $date_creation, $date_expiration, $idUser, $email){
        $reqtoken=$bdd->prepare('INSERT INTO mdpoublie(email,date_creation,date_expiration,token,id_user) VALUES(?,?,?,?,?)');
        $reqtoken->execute([$email,$date_creation,$date_expiration,$token,$idUser]);
    }

    function VerifToken($bdd,$token){
        $reqVerifToken=$bdd->prepare('SELECT *, COUNT(*) as nb FROM mdpoublie WHERE token=:token');
        $reqVerifToken->execute([':token'=>$token]);
        $VerifToken=$reqVerifToken->fetch();

        return $VerifToken;
    }

    function SupprToken($bdd,$token){
        $reqSupprToken=$bdd->prepare('DELETE FROM mdpoublie WHERE token=:token');
        $reqSupprToken->execute([':token'=>$token]);
    }
    function ModifMotDePasse($bdd,$newmdp,$idUser){
        $reqModifMotDePasse=$bdd->prepare('UPDATE utilisateur SET mdp=:mdp WHERE id_user=:id_user');
        $reqModifMotDePasse->execute([':mdp'=>$newmdp,':id_user'=>$idUser]);
    }
    function SiLeUserExisteDansLaTableMDPoublie($bdd,$idUser){
        $reqSiLeUserExisteDansLaTableMDPoublie=$bdd->prepare('SELECT COUNT(*) FROM mdpoublie WHERE id_user=:id_user');
        $reqSiLeUserExisteDansLaTableMDPoublie->execute([':id_user'=>$idUser]);
        $SiLeUserExisteDansLaTableMDPoublie=$reqSiLeUserExisteDansLaTableMDPoublie->fetch();

        return $SiLeUserExisteDansLaTableMDPoublie;
    }

    function userExistDansMDPoublie($bdd,$email){
        $requserExistDansMDPoublie=$bdd->prepare('SELECT COUNT(*) as nb FROM mdpoublie WHERE email=:email');
        $requserExistDansMDPoublie->execute([':email'=>$email]);
        $userExistDansMDPoublie=$requserExistDansMDPoublie->fetch();

        return $userExistDansMDPoublie;
    }

    function VerifSiLaDemandeResetMDPestValide($bdd,$email){
        $reqVerifSiLaDemandeResetMDPestValide=$bdd->prepare('SELECT * FROM mdpoublie WHERE email=:email');
        $reqVerifSiLaDemandeResetMDPestValide->execute([':email'=>$email]);
        $VerifSiLaDemandeResetMDPestValide=$reqVerifSiLaDemandeResetMDPestValide->fetch();

        return $VerifSiLaDemandeResetMDPestValide;
    }
    function SupprMDPoublie($bdd,$email){
        $reqSupprMDPoublie=$bdd->prepare('DELETE FROM mdpoublie WHERE email=:email');
        $reqSupprMDPoublie->execute([':email'=>$email]);
    }
    function SupprTokenParIdUser($bdd,$idUser){
        $reqSupprTokenParIdUser=$bdd->prepare('DELETE FROM mdpoublie WHERE id_user=:id_user');
        $reqSupprTokenParIdUser->execute([':id_user'=>$idUser]);
    }

    function recupProduit($bdd, $motcle){
        $reqrecupProduit=$bdd->prepare("SELECT * FROM produits,images,categorie WHERE produits.designation LIKE :motcle AND produits.id_prod=images.id_prod AND categorie.id_categ=produits.id_categ GROUP BY produits.designation");
        $reqrecupProduit->execute([':motcle'=>$motcle.'%']);
        $recupProduit=$reqrecupProduit->fetchAll();

        return $recupProduit;
    }
    function recupDetailPanierEtInformationDeUser($bdd,$iduser){
        $reqrecupDetailPanierEtInformationDeUser=$bdd->prepare('SELECT * FROM adresses, utilisateur, ville, departement, panier, detail_panier, produits WHERE adresses.id_user=utilisateur.id_user AND adresses.id_ville=ville.id_ville AND ville.id_dept=departement.id_dept AND panier.id_user=utilisateur.id_user AND detail_panier.id_panier=panier.id_panier AND detail_panier.id_prod=produits.id_prod AND utilisateur.id_user=:id_user;');
        $reqrecupDetailPanierEtInformationDeUser->execute([':id_user'=>$iduser]);
        $recupDetailPanierEtInformationDeUser=$reqrecupDetailPanierEtInformationDeUser->fetch();

        return $recupDetailPanierEtInformationDeUser;
    }

    function createCommande($bdd,$iduser){
        $reqcreateCommande=$bdd->prepare('INSERT INTO commande');
    }
    