<?php 

?>
<div class="container">
    <div class="row">
        <?php
            include '../vue/navMonProfil.php';
        ?>
        <div class="col-10 d-flex justify-content-center">
            <form action="" method="post">
                
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <img src="../public\assets\images\acer215led.jpg" class="img-fluid rounded-start">
                        </div>
                        <p>
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Link with href
                            </a>
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Button with data-bs-target
                            </button>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <div class="row">
                                    <form action="">
                                    <div class="col-3">
                                        <input type="text" value="marque">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" value="designation">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" value="modele">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" value="prix_unit">
                                    </div>
                                    <div class="col-3">
                                        <input type="text">
                                    </div>
                                    <div class="col-3">

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>