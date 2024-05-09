<div class="col-2">
    <nav class="nav nav-pills flex-column bg-body-tertiary" style="height:100vh;" data-bs-theme="light ">
        <a class="navbar-brand my-3" href="#">
           
            Shop Periph PC
        </a>
        <a class="nav-link <?php if ($_GET['page'] == 1){ ?> active <?php } ?>" <?php if ($_GET['page'] == 1){ ?> aria-current="page"<?php } ?> href="../public/index.php?page=1">Tableau de bord</a>
        <a class="nav-link <?php if ($_GET['page'] == 2){ ?> active <?php } ?>" <?php if ($_GET['page'] == 2){ ?> aria-current="page"<?php } ?> href="../public/index.php?page=2">Produits</a>
        <a class="nav-link <?php if ($_GET['page'] == 5){ ?> active <?php } ?>" <?php if ($_GET['page'] == 5){ ?> aria-current="page"<?php } ?> href="../public/index.php?page=5">Catégorie</a>
        <a class="nav-link <?php if ($_GET['page'] == 7){ ?> active <?php } ?>" <?php if ($_GET['page'] == 7){ ?> aria-current="page"<?php } ?> href="../public/index.php?page=7">Bon de réduction</a>
        <a class="nav-link <?php if ($_GET['page'] == 9){ ?> active <?php } ?>" <?php if ($_GET['page'] == 9){ ?> aria-current="page"<?php } ?> href="../public/index.php?page=9">Utilisateur</a>
        <a class="nav-link" href="../controller/traitement_deconnexion.php">Deconnexion</a>
    </nav>
</div>