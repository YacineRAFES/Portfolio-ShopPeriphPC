<?php /** @noinspection ForgottenDebugOutputInspection */

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once 'vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';
require '../modele/connexionpdo.php';

echo '<h1>Parse books.xslx</h1><pre>';
if ($xlsx = SimpleXLSX::parse('ClasseurImage.xlsx')) {
    $images = $xlsx->rows();
    foreach ($images as $img){
        $fichier = $img[0];
        $idSousCateg = $img[1];
        $idCateg = $img[2];
        $idProd = $img[3];
        // requete préparée INSERT INTO produits..
        //$reqInsertProd = $bdd->prepare('INSERT INTO produits(nom_produit, prix_unit) VALUES(:nomProd, :prixUnit)');
        //$reqInsertProd->execute([':nomProd'=>$nomProd, ':prixUnit'=>$prixUnit]);

        //$idCateg = $bdd->lastInsertId();

        $reqInsertProd = $bdd->prepare('INSERT INTO images(fichier, id_souscateg, id_categ, id_prod) VALUES(:fichier, :id_souscateg, :id_categ, :id_prod)');
        $reqInsertProd->execute([':fichier'=>$fichier, ':id_souscateg'=>$idSousCateg, ':id_categ'=>$idCateg, ':id_prod'=>$idProd]);
        //print_r($prod);
        //echo '<br>';
    }
    
} else {
    echo SimpleXLSX::parseError();
}
echo '<pre>';
