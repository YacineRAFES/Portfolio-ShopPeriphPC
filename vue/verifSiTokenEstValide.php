<?php
//Lien : index.php?page=veriflienvalide&token=b775e015bace63679634334d76d8a4f103f5f430bd85a0220e75a26e994371d4c6638f2c75fdee4a29f2456dbf218fddbeeac72e0b878e2c05c48ca828d7cfda19569d0d7c22beaf5181262d256f692387be1206309685a87f3c1ff6cafc500f7bf673d2
$dateactuel=date('Y-m-d H:i:s');
$token=$_GET['token'];
$VerifToken=VerifToken($bdd,$token);
if($VerifToken['nb']==1){
    if(date('Y-m-d H:i:s',strtotime($VerifToken['date_expiration']))<=date('Y-m-d H:i:s',strtotime($dateactuel))){
        SupprToken($bdd,$token);
        header('Location:../public/index.php?page=9&p=motdepasseoublie');
    }else{
        $iduser=$VerifToken['id_user'];
        header('Location:../public/index.php?page=valide&iduser='.$iduser);
    }
}else{
    header('Location:../public/index.php?page=9&p=motdepasseoublie');
}

?>
<!--
<div class="container">
    <div class="row">
        <div class="text-center">
            <div class="col-5 offset-3">
                <form class="" action="">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInputGroup1" placeholder="Username">
                        <label for="floatingInputGroup1">Username</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
-->
