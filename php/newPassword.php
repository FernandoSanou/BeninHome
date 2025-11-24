<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=getHouse;charset=utf8', 'root', '');

if(isset($_POST['password'])){

    $requeteGetCode = $bdd->prepare('SELECT * FROM user WHERE email=?');
    $requeteGetCode->execute(array($_SESSION['email']));
    $result = $requeteGetCode->fetch();

    if($_SESSION['codeReset'] === $result['code']){

$password1 = $_POST['password'];
$password2 = $_POST['passwordConfirm'];

if($password1 === $password2){
    $hashedPassword = password_hash($password1, PASSWORD_BCRYPT);
    $requete = $bdd->prepare("UPDATE user SET password=? WHERE code=? AND email=?");
    $requete->execute(array($hashedPassword,$_SESSION['codeReset'],$_SESSION['email']));

    $requete = $bdd->prepare("UPDATE user SET code=' ' WHEREemail=?");
    $requete->execute(array($_SESSION['email']));
    
    $_SESSION['info'] = 'Le mot de passe à été bien changé vous pouvez reconnecté'; 
    header('location: ../php/login.php');
}else{
    header('location: ../php/newPassword.php?error&message=Les mots de passe sont différent.');
            exit();
}

}
}

?>
<?php   

if(!isset($_SESSION['email']) && !isset($_SESSION['code'])){
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
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
                <form action="newPassword.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
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
                        <input class="form-control" type="password" name="password" placeholder="Entrez votre mot de passe" required>
                    </div>
                    <div class="form-group inputs">
                        <input class="form-control" type="password" name="passwordConfirm" placeholder="Confirmer le mot de passe" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-reset-otp" value="Soumettre">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>