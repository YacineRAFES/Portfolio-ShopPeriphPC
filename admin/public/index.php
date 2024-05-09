<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>ADMIN</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            
    <?php
    require '../modele/fonctions.php';
    if (!isset($_GET['page'])){ // si $_GET['page'] n'existe pas
        include ('../vue/connexion.php');
    }else{
        if($_GET['page'] == 1){
            include ('../vue/tableaudebord.php');
        }
        if($_GET['page'] == 2){
            include ('../vue/produits.php');
        }
        if($_GET['page'] == 4){
            include ('../vue/gestionproduit.php');
        }
        if($_GET['page'] == 5){
            include ('../vue/categorie.php');
        }
        if($_GET['page'] == 6){
            include ('../vue/gestioncateg.php');
        }
        if($_GET['page'] == 7){
            include ('../vue/bondereduc.php');
        }
        if($_GET['page'] == 8){
            include ('../vue/gestionbondereduc.php');
        }
        if($_GET['page'] == 9){
            include ('../vue/user.php');
        }
        if($_GET['page'] == 10){
            include ('../vue/usermodifier.php');
        }
    }
    ?>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>