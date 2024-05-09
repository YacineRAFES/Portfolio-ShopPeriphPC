<?php /** @noinspection ForgottenDebugOutputInspection */

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once 'vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';
require '../modele/connexionpdo.php';

echo '<h1>Parse books.xslx</h1><pre>';
if ($xlsx = SimpleXLSX::parse('Classeur.xlsx')) {
    $produits = $xlsx->rows();
    foreach ($produits as $prod){
        $nomMarque = $prod[0];
        $nomModele = $prod[1];
        $designation = $prod[2];
        $prixUnit = $prod[3];
        $desc = $prod[4];
        $idSousCateg = $prod[5];
        $idCateg =$prod[6];
        $QteStock = $prod[7];
        // requete préparée INSERT INTO produits..
        //$reqInsertProd = $bdd->prepare('INSERT INTO produits(nom_produit, prix_unit) VALUES(:nomProd, :prixUnit)');
        //$reqInsertProd->execute([':nomProd'=>$nomProd, ':prixUnit'=>$prixUnit]);

        //$idCateg = $bdd->lastInsertId();

        $reqInsertProd = $bdd->prepare('INSERT INTO produits(marque, modele, designation, prix_unit, description, id_souscateg, id_categ, qte_stock) VALUES(:nomMarque, :nomModele, :designation, :prixUnit, :desc, :idSousCateg, :idCateg, :qte_stock)');
        $reqInsertProd->execute([':nomMarque'=>$nomMarque, ':nomModele'=>$nomModele, ':designation'=>$designation, ':prixUnit'=>$prixUnit, ':desc'=>$desc, ':idSousCateg'=>$idSousCateg, ':idCateg'=>$idCateg, ':qte_stock'=>$QteStock]);
        //print_r($prod);
        //echo '<br>';
    }
    
} else {
    echo SimpleXLSX::parseError();
}
echo '<pre>';
