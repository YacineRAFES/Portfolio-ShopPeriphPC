<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <?php
    if (!isset($_GET['page'])){ // si $_GET['page'] n'existe pas
        echo "<title>ShopPeriphPC</title>";
    }else{ // si $_GET['page'] existe
        if ($_GET['page'] == 2){
            echo "<title>Accueil</title>";
        }
        if ($_GET['page'] == 3){
            echo "<title>Ecran PC</title>";
        }
        if ($_GET['page'] == 4){
            echo "<title>Clavier</title>";
        }
        if ($_GET['page'] == 5){
            echo "<title>Souris</title>";
        }
        if ($_GET['page'] == 6){
            echo "<title>Casque et micro</title>";
        }
        if ($_GET['page'] == 7){
            echo "<title>Imprimante</title>";
        }
        if ($_GET['page'] == 8){
            echo "<title>Accessoire PC</title>";
        }
        if ($_GET['page'] == 9){
            echo "<title>Connexion</title>";
        }
        if ($_GET['page'] == 10){
            echo "<title>Inscription</title>";
        }
        if ($_GET['page'] == 11){
            echo "<title>Profil</title>";
        }
    }
    ?>
</head>
<body class="d-flex flex-column min-vh-100">
<?php
    session_start();
    require "../modele/fonctions.php";
    // si le id user existe dans la table mdpoublier, cacher le header et le footer
    /*']);
    if($SiLeUserExisteDansLaTableMDPoublie){
        echo '';
    }else{
        include "../vue/header.php";
    }*/
    include "../vue/header.php";
    if (!isset($_GET['page'])){ // si $_GET['page'] n'existe pas
        include ('../vue/accueil.php');
    }else{ // si $_GET['page'] existe
        if ($_GET['page'] == 2){
            include ('../vue/accueil.php');
        }
        if ($_GET['page'] == 3){
            include ('../vue/ecranpc.php');
        }
        if ($_GET['page'] == 4){
            include ('../vue/clavier.php');
        }
        if ($_GET['page'] == 5){
            include ('../vue/souris.php');
        }
        if ($_GET['page'] == 6){
            include ('../vue/casqueetmicro.php');
        }
        if ($_GET['page'] == 7){
            include ('../vue/imprimante.php');
        }
        if ($_GET['page'] == 8){
            include ('../vue/accessoirepc.php');
        }
        if ($_GET['page'] == 9){
            if ($_GET['p'] == 'connexion'){
                include ('../vue/connexion.php');
            }
            if ($_GET['p'] == 'motdepasseoublie'){
                include ('../vue/motdepasseoublie.php');
            }
        }
        if ($_GET['page'] == 10){
            include ('../vue/inscription.php');
        }
        if(isset($_SESSION['idUser'])){
            if ($_GET['page'] == 11){
                include ('../vue/monProfil.php');
            }
        }

        if($_GET['page'] == 'veriflienvalide'){
            include ('../vue/verifSiTokenEstValide.php');
        }
        if($_GET['page'] == 'valide'){
            include ('../vue/mdpreset.php');
        }
        
        if ($_GET['page'] == 12){
            include ('../vue/commander.php');
        }
    }
    /*if($SiLeUserExisteDansLaTableMDPoublie){
        echo '';
    }else{
        include "../vue/footer.php";
    }*/
    include "../vue/footer.php";
?>
<script src="assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>