<?php
require '../modele/fonctions.php';
$dateactuel=date('Y-m-d H:i:s');
if($_GET['action']){
    if($_GET['action']=='mdpoublie'){
        $email=htmlspecialchars($_POST['email']);
        $userExists=userExists($bdd, $email);
        if($userExists){
            $userExistDansMDPoublie=userExistDansMDPoublie($bdd,htmlspecialchars($_POST['email']));
            if($userExistDansMDPoublie['nb']==1){
                $VerifSiLaDemandeResetMDPestValide=VerifSiLaDemandeResetMDPestValide($bdd,htmlspecialchars($_POST['email']));
                if($VerifSiLaDemandeResetMDPestValide){
                    if(strtotime(date('Y-m-d H:i:s',$VerifSiLaDemandeResetMDPestValide['date_expiration']))<strtotime('Y-m-d H:i:s',$dateactuel)){
                        SupprMDPoublie($bdd,htmlspecialchars($_POST['email']));
                        $token=bin2hex(random_bytes(100));
                        $datecreation=date('Y-m-d H:i:s');
                        $expiration = strtotime($datecreation)+900;
                        $date_expiration=date('Y-m-d H:i:s', $expiration);
                        token($bdd, $token, $datecreation, $date_expiration, $userExists['id_user'],htmlspecialchars($_POST['email']));
                        //mail à envoyer
                        header('Location:../public/index.php?page=9&p=connexion&message=emailenvoye');
                    }else{
                        header('Location:../public/index.php?page=9&p=connexion&message=emailenvoye');
                    }
                }else{
                    header('Location:../public/index.php?page=9&p=connexion&message=emailenvoye');
                }
            }else{
                $token=bin2hex(random_bytes(100));
                $datecreation=date('Y-m-d H:i:s');
                $expiration = strtotime($datecreation)+900;
                $date_expiration=date('Y-m-d H:i:s', $expiration);
                token($bdd, $token, $datecreation, $date_expiration, $userExists['id_user'],$email);
                
                header('Location:../public/index.php?page=9&p=connexion&message=emailenvoye');
            }
        }else{
            header('Location:../public/index.php?page=9&p=connexion&message=emailenvoye');
        }
    }
    if($_GET['action']=='mdpreset'){
        $newmdp=password_hash(htmlspecialchars($_POST['mdp']), PASSWORD_DEFAULT);
        header('Location:../public/index.php?page=9&p=connexion&message=resetmdpsuccess');
    }
    if($_GET['action']=='resetmdp'){
        $iduser=$_GET['iduser'];
        $newmdp=password_hash(htmlspecialchars($_POST['newmdp']), PASSWORD_DEFAULT);
        ModifMotDePasse($bdd,$newmdp,$iduser);
        SupprTokenParIdUser($bdd,$iduser);
        header('Location:../public/index.php?page=9&p=connexion&message=resetmdpsuccess');
    }
}
