<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=getHouse;charset=utf8', 'root', '');

    if(isset($_POST['number'])){
        $number =$_POST['number'];
        $requete = $bdd->prepare('SELECT COUNT(*) AS x FROM user WHERE number= ?');
        $requete->execute(array($number));
      while ($result = $requete->fetch()) {
            if ($result['x'] > 0) {
              
                   // Génération d'un code de réinitialisation aléatoire de 4 chiffres
        $code = "";
        for ($i = 0; $i < 4; $i++) {
            $code .= mt_rand(0, 9);
        }

        $requete = $bdd->prepare("UPDATE user SET code=? WHERE number=?");
        $requete->execute(array($code,$number));

        // Envoi de l'e-mail avec le code de réinitialisation
        $sujet = "Réinitialisation de mot de passe";
        $message = "Votre code de réinitialisation de mot de passe est : $code";
        $headers = "BéniHome229@gmail.com";

        // if (mail($_POST['email'], $sujet, $message, $headers)) {
        //     $info= "Un e-mail de réinitialisation a été envoyé à votre adresse e-mail.";
        //     $_SESSION['info']=$info;
        //     $_SESSION['email'] = $_POST['email'];
        //     header('location: ../php/resetPassword.php');
        // } else {
        
        //     header('location: ../php/passwordforget.php?error&message=Échec de l\'envoi de l\'e-mail.');
        //     exit();
        // }
    } else {
        header('location: ../php/passwordforgetNumber.php?error&message=Votre numéro est incorrect');
        exit();
    }
} }

 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BéniHome</title>
    <link rel="stylesheet" href="../style/bootstrap.rtl.min.css">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <style>
     @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
html,body{
    background: #6665ee;
    font-family: 'Poppins', sans-serif;
}
::selection{
    color: #fff;
    background: #6665ee;
}
.container{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.container .form{
    background: #fff;
    padding: 30px 35px;
    border-radius: 5px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    padding: 15px 30px;
}
.container .form form .form-control{
    height: 40px;
    font-size: 15px;
}
.container .form form .forget-pass{
     margin: -10px 0 5px 0;
}
.container .form form .forget-pass a{
   font-size: 15px;
}
.container .form form .button{
    background: #6665ee;
    color: #fff;
    font-size: 17px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.container .form form .button:hover{
    background: #5757d1;
}
.container .form form .link{
    padding: 5px 0;
}
.container .form form .link a{
    color: #6665ee;
    text-decoration:none;
}
.container .login-form form p{
    font-size: 14px;
}
.container .row .alert{
    font-size: 14px;
}
.inputs {
    margin: 11px 0px;
}


    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="passwordforgetNumber.php" method="POST" autocomplete="">
                    <h2 class="text-center">Mot de passe oublié</h2>
                    <p class="text-center">Enter votre numéro de téléphone</p>
                    <?php
                        if(isset($_GET['error'])){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                        echo $_GET['message'];
                               
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control inputs" type="number" name="number" placeholder="Numéro" required>
                    </div> 
                    <div class="link forget-pass text-left"><a href="passwordforget.php">Utilisez l'email .</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Continuez">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>