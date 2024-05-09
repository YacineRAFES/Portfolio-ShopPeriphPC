<?php
require '../modele/connexionpdo.php';

function userExists($bdd, $email){
    $req = 'SELECT * FROM utilisateur WHERE email = :mail';
    $reqUserExists = $bdd->prepare($req);
    $reqUserExists->execute([':mail'=>$email]);
    $userExists = $reqUserExists->fetch();
    
    return $userExists; // TRES IMPORTANT 
}

function produits($bdd){
    $reqProduits=$bdd->prepare('SELECT * FROM produits p, categorie c, sous_categorie sc WHERE delected=0 AND p.id_categ=c.id_categ AND p.id_souscateg = sc.id_souscateg ORDER BY id_prod ASC;');
    $reqProduits->execute();
    $produits=$reqProduits->fetchAll();
    
    return $produits;
}

function ProduitsAvecidProd($bdd,$idprod){
    $reqProduitsAvecidProd=$bdd->prepare('SELECT * FROM produits p LEFT JOIN images i ON p.id_prod=i.id_prod WHERE p.id_prod=:idprod');
    $reqProduitsAvecidProd->execute([':idprod'=>$idprod]);
    $ProduitsAvecidProd=$reqProduitsAvecidProd->fetch();

    return $ProduitsAvecidProd;
}

function AffichageSousCateg($bdd){
    $reqAffichageSousCateg=$bdd->prepare('SELECT * FROM sous_categorie');
    $reqAffichageSousCateg->execute();
    $AffichageSousCateg=$reqAffichageSousCateg->fetchAll();

    return $AffichageSousCateg;
}

function AffichageSousCategAvecID($bdd, $idsouscateg){
    $reqAffichageSousCategAvecID=$bdd->prepare('SELECT * FROM sous_categorie WHERE id_souscateg=:idsouscateg');
    $reqAffichageSousCategAvecID->execute([':idsouscateg'=>$idsouscateg]);
    $AffichageSousCategAvecID=$reqAffichageSousCategAvecID->fetch();

    return $AffichageSousCategAvecID;
}

function AffichageCateg($bdd){
    $reqAffichageCateg=$bdd->prepare('SELECT * FROM categorie');
    $reqAffichageCateg->execute();
    $AffichageCateg=$reqAffichageCateg->fetchAll();

    return $AffichageCateg;
}

function AffichageCategAvecID($bdd,$id_categ){
    $reqAffichageCategAvecID=$bdd->prepare('SELECT * FROM categorie wHERE id_categ=:id_categ');
    $reqAffichageCategAvecID->execute([':id_categ'=>$id_categ]);
    $AffichageCategAvecID=$reqAffichageCategAvecID->fetch();

    return $AffichageCategAvecID;
}

function visibleProd($bdd, $idprod, $visible){
    $reqvisibleProd=$bdd->prepare('UPDATE produits SET publier=:publier WHERE id_prod=:idprod');
    $reqvisibleProd->execute([':publier'=>$visible,':idprod'=>$idprod]);
}
function supprProd($bdd,$idprod){
    $reqsupprProd=$bdd->prepare('UPDATE produits SET delected=1 WHERE id_prod=:idprod');
    $reqsupprProd->execute([':idprod'=>$idprod]);
}

function RecupCateg($bdd, $idcateg){
    $reqRecupCateg=$bdd->prepare('SELECT * FROM sous_categorie WHERE id_categ=:id_categ');
    $reqRecupCateg->execute([':id_categ'=>$idcateg]);
    $RecupCateg=$reqRecupCateg->fetchAll();

    return $RecupCateg;
}

function ModifierProduit($bdd, $marques, $designation, $modele, $prixunit, $description, $categ, $souscateg, $qtestock, $publier, $idprod,$file_name){

    $reqModifierProduit=$bdd->prepare('UPDATE produits p
                                       JOIN images ON images.id_prod=p.id_prod
                                       SET p.marque=:marque,
                                       p.designation=:designation,
                                       p.modele=:modele,
                                       p.prix_unit=:prixunit,
                                       p.description=:desc,
                                       p.id_souscateg=:souscateg,
                                       p.id_categ=:categ,
                                       p.qte_stock=:qtestock,
                                       p.publier=:publier,
                                       images.fichier=:fichier
                                       WHERE p.id_prod=:id_prod');
    $reqModifierProduit->execute([':marque'=>$marques,':designation'=>$designation,':modele'=>$modele,':prixunit'=>$prixunit,':desc'=>$description,':categ'=>$categ,':souscateg'=>$souscateg,':qtestock'=>$qtestock,':publier'=>$publier,':id_prod'=>$idprod,':fichier'=>$file_name]);
}

function NomImageProduits($bdd,$id_prod){
    $reqNomImageProduits=$bdd->prepare('SELECT fichier FROM images WHERE id_prod=:id_prod');
    $reqNomImageProduits->execute([':id_prod'=>$id_prod]);
    $NomImageProduits=$reqNomImageProduits->fetch();

    return $NomImageProduits['fichier'];
}
function ImageExistantProduits($bdd, $id_img, $id_prod){
    $reqImageExistantProduits=$bdd->prepare('SELECT COUNT(fichier) FROM images WHERE id_img=:id_img AND id_prod=:id_prod');
    $reqImageExistantProduits->execute([':id_img'=>$id_img,':id_prod'=>$id_prod]);
    $ImageExistantProduits=$reqImageExistantProduits->fetch();

    return $ImageExistantProduits;
}

function ajouterProduit($bdd, $marques, $designation, $modele, $prixunit, $description, $categ, $souscateg, $qtestock, $publier){
    $reqajouterProduit=$bdd->prepare('INSERT INTO produits(marque,designation,modele,prix_unit,description,id_souscateg,id_categ,qte_stock,publier) VALUES(?,?,?,?,?,?,?,?,?)');
    $reqajouterProduit->execute([$marques,$designation,$modele,$prixunit,$description,$souscateg,$categ,$qtestock,$publier]);
    return $bdd->lastInsertId();
}
function InsertImage($bdd, $file_name, $souscateg, $categ, $idprod){
    $reqInsertImage=$bdd->prepare('INSERT INTO images(fichier, id_souscateg, id_categ, id_prod) VALUES(:fichier,:souscateg,:categ,:idprod)');
    $reqInsertImage->execute([':fichier'=>$file_name,':souscateg'=>$souscateg,':categ'=>$categ,':idprod'=>$idprod]);
}
function CategAvecID($bdd,$idcateg){
    $reqCategAvecID=$bdd->prepare('SELECT * FROM categorie c, sous_categorie sc WHERE c.id_categ=:id_categ AND c.id_categ=sc.id_categ');
    $reqCategAvecID->execute([':id_categ'=>$idcateg]);
    $CategAvecID=$reqCategAvecID->fetch();

    return $CategAvecID;
}

function nbSousCateg($bdd){
    $reqnbSousCateg=$bdd->prepare('SELECT c.id_categ as id_categ, COUNT(`id_souscateg`) as nbSousCateg FROM categorie c, sous_categorie sc WHERE c.id_categ=sc.id_categ GROUP BY c.nom_categ;');
    $reqnbSousCateg->execute();
    $nbSousCateg=$reqnbSousCateg->fetch();

    return $nbSousCateg;
}
function SupprSousCateg($bdd, $idsouscateg){
    $reqSupprSousCateg=$bdd->prepare('DELETE FROM sous_categorie WHERE id_souscateg=:id_souscateg');
    $reqSupprSousCateg->execute([':id_souscateg'=>$idsouscateg]);
}

function SousCategAvecID($bdd,$idsouscateg){
    $reqSousCategAvecID=$bdd->prepare('SELECT * FROM sous_categorie WHERE id_souscateg=:id_souscateg');
    $reqSousCategAvecID->execute([':id_souscateg'=>$idsouscateg]);
    $SousCategAvecID=$reqSousCategAvecID->fetch();

    return $SousCategAvecID;
}
function CategModif($bdd, $idcateg, $nomcateg){
    $reqCategModif=$bdd->prepare('UPDATE categorie SET nom_categ=:nom_categ WHERE id_categ=:id_categ');
    $reqCategModif->execute([':id_categ'=>$idcateg,':nom_categ'=>$nomcateg]);
}
function SousCategModif($bdd, $idsouscateg, $nomsouscateg){
    $reqSousCategModif=$bdd->prepare('UPDATE sous_categorie SET nom_souscateg=:nom_souscateg WHERE id_souscateg=:id_souscateg');
    $reqSousCategModif->execute([':id_souscateg'=>$idsouscateg, ':nom_souscateg'=>$nomsouscateg]);
}
function AjoutSousCateg($bdd, $nomsouscateg,$idcateg){
    $reqAjoutSousCateg=$bdd->prepare('INSERT INTO sous_categorie(nom_souscateg, id_categ) VALUES(:nom_souscateg,:id_categ)');
    $reqAjoutSousCateg->execute([':nom_souscateg'=>$nomsouscateg,':id_categ'=>$idcateg]);
}
function AjoutBonReduc($bdd, $idprod, $nb_article_min, $taux, $datedebut, $datefin){
    $reqAjoutBonReduc=$bdd->prepare('INSERT INTO bon_reduction(id_prod,nb_article_min,taux,date_debut,date_fin) VALUES(?,?,?,?,?)');
    $reqAjoutBonReduc->execute([$idprod, $nb_article_min, $taux, $datedebut, $datefin]);
}
function AffichageBonReduc($bdd){
    $reqAffichageBonReduc=$bdd->prepare('SELECT * FROM bon_reduction');
    $reqAffichageBonReduc->execute();
    $AffichageBonReduc=$reqAffichageBonReduc->fetchAll();

    return $AffichageBonReduc;
}
function AffichageUser($bdd){
    $reqAffichageUser=$bdd->prepare("SELECT * FROM utilisateur u, role r WHERE u.id_role=2 AND u.id_role=r.id_role");
    $reqAffichageUser->execute();
    $AffichageUser=$reqAffichageUser->fetchAll();

    return $AffichageUser;
}
function DisabledUser($bdd, $iduser, $disable){
    $reqDisabledUser=$bdd->prepare('UPDATE utilisateur SET disabled=:disabled WHERE id_user=:id_user');
    $reqDisabledUser->execute([':disabled'=>$disable,':id_user'=>$iduser]);
}
function SupprUser($bdd, $iduser){
    $reqSupprUser=$bdd->prepare('UPDATE utilisateur SET delected=1 WHERE id_user=:id_user');
    $reqSupprUser->execute([':id_user'=>$iduser]);
}
function AffichageUserAvecID($bdd, $iduser){
    $reqAffichageUserAvecID=$bdd->prepare('SELECT * FROM utilisateur u, adresses a WHERE u.id_user=:iduser AND u.id_user=a.id_user');
    $reqAffichageUserAvecID->execute([':iduser'=>$iduser]);
    $AffichageUserAvecID=$reqAffichageUserAvecID->fetch();

    return $AffichageUserAvecID;
}
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
function AffichageAdresse($bdd,$idUser){
    $reqAffichageAdresse=$bdd->prepare('SELECT * FROM departement,ville,adresses WHERE adresses.id_user=:id_user AND adresses.id_ville=ville.id_ville AND ville.id_dept=departement.id_dept');
    $reqAffichageAdresse->execute([':id_user'=>$idUser]);
    $AffichageAdresse=$reqAffichageAdresse->fetch();
    
    return $AffichageAdresse;
}
function AffichageRole($bdd){
    $reqAffichageRole=$bdd->prepare('SELECT * FROM role');
    $reqAffichageRole->execute();
    $AffichageRole=$reqAffichageRole->fetchAll();

    return $AffichageRole;
}
function ModifInformationCompte($bdd,$email,$nom,$prenom,$datenaiss,$idUser,$role){
    $reqModifInformationCompte=$bdd->prepare('UPDATE utilisateur SET email = :email, nom = :nom, prenom = :prenom, date_naiss = :datenaiss, id_role=:role WHERE id_user = :id_user');
    $reqModifInformationCompte->execute([':email'=>$email,':nom'=>$nom,':prenom'=>$prenom,':datenaiss'=>$datenaiss,':id_user'=>$idUser, ':role'=>$role]);
}
function ModifAdresseCompte($bdd,$adresse,$ville,$cp,$id_adresse){
    $reqModifAdresseCompte=$bdd->prepare('UPDATE adresses SET adresse=:adresse, id_ville=:id_ville, cp=:cp WHERE id_adresse=:id_adresse');
    $reqModifAdresseCompte->execute([':adresse'=>$adresse,':id_ville'=>$ville,':cp'=>$cp,':id_adresse'=>$id_adresse]);
}
function createUser($bdd,$nom,$role,$prenom,$dateNaiss,$email,$mdp){
    $reqCreateUser=$bdd->prepare("INSERT INTO utilisateur(nom,id_role,prenom,date_naiss,email,mdp) VALUES (:nom,:role,:prenom,:date,:email,:mdp)");
    $reqCreateUser->execute([':nom'=>$nom,':role'=>$role,':prenom'=>$prenom,':date'=>$dateNaiss,':email'=>$email,':mdp'=>$mdp]);
    return $bdd->lastInsertId();
}
function insertAdresse($bdd, $adresse, $ville, $idUser, $cp){
    $reqCreateAdress=$bdd->prepare("INSERT INTO adresses(adresse,id_ville, cp, id_user) VALUES (?,?,?,?)");
    $reqCreateAdress->execute([$adresse,$ville,$cp,$idUser]);
}
?>