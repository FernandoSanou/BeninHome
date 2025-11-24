<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=getHouse;charset=utf8', 'root', '');
if (isset($_POST['prenom']) && isset($_POST['password'])) {
    $prenom    = $_POST['prenom'];
    $password = $_POST['password'];

    if ($prenom == 'superadmin09@gmail.com' && $password == 'kk--getHouse2024--kk') {

        $_SESSION['adminer'] = 'theBoss';
        header('location: adminPage.php?adminer=' . $_SESSION['adminer']);
    } else {
        // verifier si le prenom n'a jamais ete utilise
        $requeteCountPrenom = $bdd->prepare('SELECT COUNT(*) AS x FROM user WHERE prenom= ?');
        $requeteCountPrenom->execute(array($prenom));
      
          while ($result = $requeteCountPrenom->fetch()) {

              if ($result['x'] > 0) {
               $requete = $bdd->prepare('SELECT *  FROM user WHERE prenom = ? ');
               $requete->execute(array(htmlspecialchars($prenom)));
       
               while ($result = $requete->fetch()) {
       
            // Cryptage du mot de passe
            if (password_verify($password, $result['password'])) {


               if ($result['nom']) {
                   $id = $result['id'];
                   $nom = $result['nom'];
                   $prenom = $result['prenom'];
                   $email = $result['email'];
                   $number = $result['number'];
                   $ville = $result['ville'];
                   $type = $result['type'];
                   $password = $result['password'];

                   $_SESSION['nom'] = $nom;
                   $_SESSION['id']  = $id;
                   $_SESSION['prenom'] = $prenom;
                   $_SESSION['email'] = $email;
                   $_SESSION['number'] = $number;
                   $_SESSION['ville'] = $ville;
                   $_SESSION['type'] = $type;
                   $_SESSION['password'] = $_POST['password'];
                   $_SESSION['short'] = $result['short'];

                   // mettre le statut sur en ligne
                   $requete = $bdd->prepare('UPDATE user SET online=? WHERE id=? AND prenom=?');
                   $requete->execute(array('true', $_SESSION['id'], $_SESSION['prenom']));

                   header('location: ../php/home.php');
               }
           } else {
               header('location: ../php/login.php?error&message=Mot de passe incorrect');
               exit();
           }
       
           }
          } else {
               header('location: ../php/login.php?error&message=Prénom invalide');
               exit();
           }}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
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

.img {
    background: url(../img/imgHome.jpg);
    background-size: cover;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="img col-md-4 offset-md-4 form login-form">
                <form action="login.php" method="POST" autocomplete="">
                    <h1 class="text-center">Connexion</h1>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
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
                    <div class="form-group inputs">
                        <input class="form-control" type="prenom" name="prenom" placeholder="Prénom" required >
                    </div>
                    <div class="form-group inputs">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="passwordforget.php">Mot de apsse oublié ?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Se connecter">
                    </div>
                    <div class="link login-link text-center"><a href="signUp.php">Crée un compte</a></div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>