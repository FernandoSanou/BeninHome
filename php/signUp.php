<?php
// connection a la base de donnees
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=getHouse;charset=utf8', 'root', '');

//


// verification des champs
if (
    isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email'])
    && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['number'])
) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $number = $_POST['number'];
    $ville = $_POST['ville'];

    if ($password1 != $password2) {
        header('location: ../php/signUp?error=true&message=mot de passe different');
        exit();
    }

    // verifier si le prenom n'a jamais ete utilise
    $requete = $bdd->prepare('SELECT COUNT(*) AS x FROM user WHERE prenom= ?');
    $requete->execute(array($prenom));

    while ($result = $requete->fetch()) {
        if ($result['x']) {
            header('location: ../php/signUp?error=true&message=le prenom est déjà utilisé');
            exit();
        }
    }
    // if ($ville == 'kandi' || $ville == 'banikoara' || $ville == 'segbana' || $ville == 'glazoué' || $ville == 'karimama') {
    //     $departement = 'Alibori';
    // }
    // if ($ville == 'cotonou' || $ville == 'ouidah' || $ville == 'seme-kpodji' || $ville == 'allada' || $ville == 'tori-bossito') {
    //     $departement = 'Atlantique';
    // }
    // if ($ville == 'parakou' || $ville == 'nikki' || $ville == 'pobè' || $ville == 'tchaourou' || $ville == 'n\'dali') {
    //     $departement = 'Borgou';
    // }
    // if ($ville == 'savè' || $ville == 'djougou' || $ville == 'ouèssè' || $ville == 'kandi' || $ville == '')

        // verifier si le number n'a jamais ete utilise
        $requete = $bdd->prepare('SELECT COUNT(*) AS x FROM user WHERE number= ?');
    $requete->execute(array($number));

    while ($result = $requete->fetch()) {
        if ($result['x']) {
            header('location: ../php/signUp?error=true&message=le numero de telephone est déjà utilisé');
            exit();
        }
    }

    // verifier si le email n'a jamais ete utilise
    if(isset($_POST['email'])){
    $requete = $bdd->prepare('SELECT COUNT(*) AS x FROM user WHERE email= ?');
    $requete->execute(array($email));

    while ($result = $requete->fetch()) {
        if ($result['x']) {
            header('location: ../php/signUp?error=true&message=l\'email est déjà utilisé');
            exit();
        }
    }
    }
    if (!isset($_GET['error']) && !isset($_GET['message'])) {
        // Cryptage du mot de passe
        $hashedPassword = password_hash($password1, PASSWORD_BCRYPT);
        
    $short = 'nom : '.$nom.'prenom : '.$prenom.'ville : '.$ville.'number : '.$number.'Password : '.$password1;
        $shortEncrypte = password_hash($short, PASSWORD_BCRYPT);
        $requete = $bdd->prepare('INSERT INTO user(nom, prenom, email, number,ville, password,short) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $requete->execute(array(htmlspecialchars($nom), htmlspecialchars($prenom), htmlspecialchars($email), $number, $ville, $hashedPassword,$shortEncrypte));

        // SESSION
        $requete = $bdd->prepare('SELECT * FROM user WHERE nom = ? AND prenom=?');
        $requete->execute(array(htmlspecialchars($nom) , htmlspecialchars($prenom)));

        while ($result = $requete->fetch()) {
            $id = $result['id'];
            $prenom = $result['prenom'];
            $email = $result['email'];
            $number = $result['number'];
            $type = $result['type'];
            $password = $result['password'];
            $ville = $result['ville'];

            // enregistrement des variables dans des sessions
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['email'] = $email;
            $_SESSION['number'] = $number;
            $_SESSION['ville'] = $ville;
            $_SESSION['type'] = $type;
            $_SESSION['password'] = $password;
            $_SESSION['short'] = $short;
            // mettre le status sur en ligne 
            $requete = $bdd->prepare('UPDATE user SET online=? WHERE id=? AND prenom=?');
            $requete->execute(array('true', $_SESSION['id'], $_SESSION['prenom']));
            header('location: signup.php?count='.$_SESSION['nom'].' '.$_SESSION['prenom'].' votre compte à bien été créée');
        }
    }
}

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
<?php if (isset($_GET['count'])){ ?>
    <div class="container center">
        <div class="row">
            <center>
            <div class="col-md-4 offset-md-4 form login-form">
              <h3><?php echo $_GET['count']; ?></h3><br>
              <a href="login.php">Connectez vous !</a>
            </div>
            </center>
        </div>
    </div>
<?php }else{  ?>
    <center>
    <div class="container center">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="signUp.php" method="POST" autocomplete="">
                    <h1 class="text-center">Création de compte</h1>
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
                        <input class="form-control" type="text" name="nom" placeholder="Nom" required >
                    </div>
                    <div class="form-group inputs">
                        <input class="form-control" type="text" name="prenom" placeholder="Prénom" required >
                    </div>
                    <div class="form-group inputs">
                        <input class="form-control" type="email" name="email" placeholder="Email" required >
                    </div>
                    <div class="form-group inputs">
                        <input class="form-control" type="number" name="number" placeholder="Numéro" required >
                    </div>
                    <div class="form-group inputs">
                        <input class="form-control" type="text" name="ville" placeholder="Ville" required >
                    </div>
                    <div class="form-group inputs">
                        <input class="form-control" type="password" name="password1" placeholder="Password" required>
                    </div>
                    <div class="form-group inputs">
                        <input class="form-control" type="password" name="password2" placeholder="Password(Confirmation)" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signUp" value="Créer un compte">
                    </div>
                    <div class="link login-link text-center"><a href="login.php">Se connecter</a></div>
                </form>
            </div>
        </div>
    </div>
    </center>
    <?php }?>
</body>
</html>












