<?php
    include 'header.php';
    
?>
<div class="col-10 mt-3">
    <a href="index.php?page=7&c=1" class="btn btn-primary">Saisi</a>
    <a href="index.php?page=7&c=2" class="btn btn-primary">Gestion</a>


<?php
if(isset($_GET['c'])) {
    if ($_GET['c'] == 1){
        include '../vue/saisibondereduc.php';
    }
    if ($_GET['c'] == 2){
        include '../vue/affichagebondereduc.php';
    }
}else{
    include '../vue/affichagebondereduc.php';
}

?>