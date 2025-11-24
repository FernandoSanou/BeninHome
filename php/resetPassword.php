<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=getHouse;charset=utf8', 'root', '');

if(isset($_POST['otp'])){

    // recuperatuion du code ecrtit par l'utilisateur
$code = $_POST['otp'];
if(isset($_SESSION['email'])){

// RECUPERATION enresgistrer dans la bsase de donne mysql
$requeteGetCode = $bdd->prepare('SELECT * FROM user WHERE email=?');
$requeteGetCode->execute(array($_SESSION['email']));
$result = $requeteGetCode->fetch();

}
if(isset($_SESSION['number'])){
    
    // RECUPERATION enresgistrer dans la bsase de donne mysql
    $requeteGetCode = $bdd->prepare('SELECT * FROM user WHERE number=?');
    $requeteGetCode->execute(array($_SESSION['number']));
    $result = $requeteGetCode->fetch();
    
    }
    if($code === $result['code']){
        $_SESSION['codeReset'] = $code;
        $info= "Vérificaions terminées. Vous pouvez changer votre mot de passe";
        $_SESSION['info']=$info;
        header('Location: newPassword.php');
    }


}

?>
<?php   

if(!isset($_SESSION['email']) || !isset($_SESSION['number'])){
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
                <form action="resetPassword.php" method="POST" autocomplete="off">
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
                           
                                echo $message;
                            
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group inputs">
                        <input class="form-control" type="number" name="otp" placeholder="Entrez le code" required>
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