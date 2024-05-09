<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=shopperippc;charset=UTF8","root","");
    //echo 'connexion ok';
}catch(PDOException $e){
    echo $e->getMessage();
    die();
}
?>