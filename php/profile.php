<?php
require('includes/require.php');


if (isset($_GET['seeImage'])) {

     header('location: seeImage.php?seeImage=true&image=' . $_GET['images'] . '&nomAuteur=' . $_GET['nomAuteur'] . '&idAuteur=' . $_GET['idAuteur'] . '&link=' . $_GET['link']);
}
if (isset($_GET['seeImageProfile'])) {

     header('location: seeImage.php?seeImageProfile=true&image=' . $_GET['images'] . '&nomAuteur=' . $_GET['nomAuteur'] . '&idAuteur=' . $_GET['idAuteur'] . '&link=' . $_GET['link']);
}

if (isset($_POST['changingOfUserName'])) {
     $nom = $_POST['nom'];
     $prenom = $_POST['prenom'];
     $holdPassword = $_POST['holdPassword'];
     if ($_SESSION['password'] == $holdPassword) {


          if ($_SESSION['type'] == 'Locataire') {
               $requeteGetDemande = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur= ? AND prenomAuteur=?');
               $requeteGetDemande->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom']));
               while ($resultatsGetDemande = $requeteGetDemande->fetch()) {
                    $requete = $bdd->prepare('UPDATE demande SET nomAuteur=?,prenomAuteur=? WHERE id=? AND idAuteur=?');
                    $requete->execute(array($nom, $prenom, $resultatsGetDemande['id'], $_SESSION['id']));
               }
          }
          if ($_SESSION['type'] == 'Proprietaire') {
               $holdPassword = $_POST['holdPassword'];
               $requeteGetOffrre = $bdd->prepare('SELECT * FROM offre WHERE idAuteur=? AND nomAuteur= ? AND prenomAuteur=?');
               $requeteGetOffrre->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom']));
               while ($resultatsGetOffre = $requeteGetOffrre->fetch()) {
                    $requete = $bdd->prepare('UPDATE offre SET nomAuteur=?,prenomAuteur=? WHERE id=? AND idAuteur=?');
                    $requete->execute(array($nom, $prenom, $resultatsGetOffre['id'], $_SESSION['id']));

                    // pour photo des offres

                    $requeteGetImages = $bdd->prepare('SELECT * FROM imagesdemande WHERE idAuteur=? AND idRequete=?');
                    $requeteGetImages->execute(array($_SESSION['id'], $resultatsGetOffre['id']));
                    while ($resultatsGetImages = $requeteGetImages->fetch()) {
                         $requete = $bdd->prepare('UPDATE imagesdemande SET nomAuteur=? WHERE idRequete=? AND idAuteur=?');
                         $requete->execute(array($nom, $resultatsGetOffre['id'], $_SESSION['id']));
                    }
               }
          }
          // modification du nomAuteur pour les photo de profile 
          $requete = $bdd->prepare('UPDATE images SET nomAuteur=? WHERE idAuteur=? AND raison=?');
          $requete->execute(array($nom, $_SESSION['id'], 'profile'));

          // systeme de blockage
          $requeteGetBlockage = $bdd->prepare('SELECT * FROM blocked WHERE idAuteur=? OR idVictim= ? ');
          $requeteGetBlockage->execute(array($_SESSION['id'], $_SESSION['id']));
          while ($resultatsGetBlockage = $requeteGetBlockage->fetch()) {
               if ($resultatsGetBlockage['idAuteur'] == $_SESSION['id']) {
                    $requete = $bdd->prepare('UPDATE blocked SET nomAuteur=? WHERE id=? AND idAuteur=?');
                    $requete->execute(array($nom, $prenom, $resultatsGetBlockage['id'], $_SESSION['id']));
               }
               if ($resultatsGetBlockage['idVictim'] == $_SESSION['id']) {
                    $requete = $bdd->prepare('UPDATE blocked SET nomVictim=? WHERE id=? AND idVictim=?');
                    $requete->execute(array($nom, $resultatsGetBlockage['id'], $_SESSION['id']));
               }
          }
          // systeme de signalement
          $requeteGetSignalement = $bdd->prepare('SELECT * FROM signalement WHERE idAuteur=? OR idVictim= ? ');
          $requeteGetSignalement->execute(array($_SESSION['id'], $_SESSION['id']));
          while ($resultatsGetSignalement = $requeteGetSignalement->fetch()) {
               if ($resultatsGetSignalement['idAuteur'] == $_SESSION['id']) {
                    $requete = $bdd->prepare('UPDATE signalement SET nomAuteur=? WHERE id=? AND idAuteur=?');
                    $requete->execute(array($nom, $resultatsGetSignalement['id'], $_SESSION['id']));
               }
               if ($resultatsGetSignalement['idVictim'] == $_SESSION['id']) {
                    $requete = $bdd->prepare('UPDATE signalement SET nomVictim=? WHERE id=? AND idVictim=?');
                    $requete->execute(array($nom, $resultatsGetSignalement['id'], $_SESSION['id']));
               }
          }
          //  chat
          $requeteGetChat = $bdd->prepare('SELECT * FROM chat WHERE idMessager=? OR idCorrespondant= ? ');
          $requeteGetChat->execute(array($_SESSION['id'], $_SESSION['id']));
          while ($resultatsGetChat = $requeteGetChat->fetch()) {
               if ($resultatsGetChat['idMessager'] == $_SESSION['id']) {
                    $requete = $bdd->prepare('UPDATE chat SET nomMessager=? WHERE id=? AND idMessager=?');
                    $requete->execute(array($nom, $resultatsGetChat['id'], $_SESSION['id']));
               }
               if ($resultatsGetChat['idCorrespondant'] == $_SESSION['id']) {
                    $requete = $bdd->prepare('UPDATE chat SET nomCorrespondant=? WHERE id=? AND idCorrespondant=?');
                    $requete->execute(array($nom, $resultatsGetChat['id'], $_SESSION['id']));
               }
          }
          //   messages
          $requeteGetMessage = $bdd->prepare('SELECT * FROM messages WHERE idAuteur=? OR idCorrespondant= ? ');
          $requeteGetMessage->execute(array($_SESSION['id'], $_SESSION['id']));
          while ($resultatsGetMessage = $requeteGetMessage->fetch()) {
               if ($resultatsGetMessage['idAuteur'] == $_SESSION['id']) {
                    $requete = $bdd->prepare('UPDATE messages SET nomAuteur=?,prenomAuteur=? WHERE id=? AND idAuteur=?');
                    $requete->execute(array($nom, $prenom, $resultatsGetMessage['id'], $_SESSION['id']));
               }
               if ($resultatsGetMessage['idCorrespondant'] == $_SESSION['id']) {
                    $requete = $bdd->prepare('UPDATE messages SET nomCorrespondant=? ,prenomCorrespondant=? WHERE id=? AND idCorrespondant=?');
                    $requete->execute(array($nom, $prenom, $resultatsGetBlockage['id'], $_SESSION['id']));
               }
          }
          $requeteGetMessage = $bdd->prepare('SELECT * FROM pulications WHERE idAuteur=? AND nomAuteur= ? ');
          $requeteGetMessage->execute(array($_SESSION['id'], $_SESSION['nom']));
          while ($resultatsGetMessage = $requeteGetMessage->fetch()) { 
                    $requete = $bdd->prepare('UPDATE pulications SET nomAuteur=?,prenomAuteur=? WHERE idAuteur=? AND nomAuteur=?');
                    $requete->execute(array($nom, $prenom, $_SESSION['id'], $_SESSION['nom']));
          }
          $requeteGetMessage = $bdd->prepare('SELECT * FROM notification WHERE idVictim=? AND nomVictim= ? ');
          $requeteGetMessage->execute(array($_SESSION['id'], $_SESSION['nom']));
          while ($resultatsGetMessage = $requeteGetMessage->fetch()) { 
                    $requete = $bdd->prepare('UPDATE notification SET nomVictim=?,prenomVictim=? WHERE idVictim=? AND nomVictim=?');
                    $requete->execute(array($nom, $prenom, $_SESSION['id'], $_SESSION['nom']));
          }

          $requete = $bdd->prepare('UPDATE user SET nom=?,prenom=? WHERE id=?');
          $requete->execute(array($nom, $prenom, $_SESSION['id']));
          $_SESSION['nom'] = $nom;
          $_SESSION['prenom'] = $prenom;
          // header('location: profile.php');
     } else {
          header('location: profile.php?settings=userName&errormessage=Le mot de passe d\'origine est incorrect.');
     }
}
if (isset($_POST['changingOfEmail'])) {
     $email = $_POST['email'];
     $holdPassword = $_POST['holdPassword'];
     if ($_SESSION['password'] == $holdPassword) {


          $requete = $bdd->prepare('UPDATE user SET email=? WHERE  id=?');
          $requete->execute(array($email, $_SESSION['id']));
          $_SESSION['email'] = $email;
          header('location: profile.php');
     } else {
          header('location: profile.php?settings=email&errormessage=Le mot de passe d\'origine est incorrect.');
     }
}
if (isset($_POST['changingOfTypeOfCompte'])) {
     $holdPassword = $_POST['holdPassword'];
     if ($_SESSION['password'] == $holdPassword) {


          if (isset($_POST['typeLocataire'])) {
               $holdPassword = $_POST['holdPassword'];
               $typeLocataire = "Locataire"; 
               $requete = $bdd->prepare('SELECT * FROM offre WHERE idAuteur=? AND nomAuteur=?');
               $requete->execute(array($_SESSION['id'],$_SESSION['nom']));
               while ($resultats=$requete->fetch()) {
                        $requete = $bdd->prepare('DELETE FROM offre WHERE idAuteur=? AND nomAuteur=? AND short=? ');
               $requete->execute(array( $resultats['idAuteur'], $resultats['nomAuteur'],$resultats['short'])); 
               }
       
               $requete = $bdd->prepare('UPDATE user SET type=? WHERE nom=? AND  id=?');
               $requete->execute(array($typeLocataire, $_SESSION['nom'], $_SESSION['id']));
               $_SESSION['type'] = $typeLocataire; 
          }

          if (isset($_POST['typeProprietaire'])) {
               $typeLocataire = "Proprietaire";
               $requete = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur=?');
               $requete->execute(array($_SESSION['id'],$_SESSION['nom']));
               while ($resultats=$requete->fetch()) {
                        $requete = $bdd->prepare('DELETE FROM demande WHERE  idAuteur=? AND nomAuteur=? ');
               $requete->execute(array( $resultats['idAuteur'] , $resultats['nomAuteur'] )); 
               }
               $requete = $bdd->prepare('UPDATE user SET type=? WHERE nom=? AND  id=?');
               $requete->execute(array($typeLocataire, $_SESSION['nom'], $_SESSION['id']));
               $_SESSION['type'] = $typeLocataire; 
          }
     } else {
          header('location: profile.php?settings=type&errormessage=Le mot de passe d\'origine est incorrect.');
     }
}
if (isset($_POST['changingOfVille'])) {
     $holdPassword = $_POST['holdPassword'];
     $ville = $_POST['ville'];
     if ($_SESSION['password'] == $holdPassword) {
          $requete = $bdd->prepare('UPDATE user SET ville=? WHERE  id=?');
          $requete->execute(array($ville, $_SESSION['id']));
          $_SESSION['ville'] = $ville;
          header('location: profile.php');
     } else {
          header('location: profile.php?settings=ville&errormessage=Le mot de passe d\'origine est incorrect.');
     }
}
if (isset($_POST['changingOfNumber'])) {
     $number = $_POST['number'];
     $holdPassword = $_POST['holdPassword'];
     if ($_SESSION['password'] == $holdPassword) {


          $requete = $bdd->prepare('UPDATE user SET number=? WHERE  id=?');
          $requete->execute(array($number, $_SESSION['id']));
          $_SESSION['number'] = $number;
          header('location: profile.php');
     } else {
          header('location: profile.php?settings=number&errormessage=Le mot de passe d\'origine est incorrect.');
     }
}
if (isset($_POST['changingOfPassword'])) {
     $newPassword = $_POST['newPassword'];
     $newPasswordconfirm = $_POST['newPasswordConfirm'];
     $holdPassword = $_POST['holdPassword'];
     if ($_SESSION['password'] == $holdPassword) {
          if ($newPassword == $newPasswordconfirm) {
               $hashedPassword = password_hash($newPasswordconfirm, PASSWORD_BCRYPT);
               $requete = $bdd->prepare('UPDATE user SET password=? WHERE  id=?');
               $requete->execute(array($hashedPassword, $_SESSION['id']));
               $_SESSION['password'] = $newPasswordconfirm;
               header('location: profile.php');
          } else {
               header('location: profile.php?settings=mdp&errormessage=Les deux mot de passe ne sont pas correspondant.');
          }
     } else {
          header('location: profile.php?settings=mdp&errormessage=Le mot de passe d\'origine est incorrect.');
     }
}


if (isset($_POST['valider'])) {
     // verifier si l'image est bien recu
     // echo $_FILES['images'];
     if (isset($_FILES['images'])) {
          $raison = 'profile';
          $informationImage = pathinfo($_FILES['images']['name']);
          $exetionImage = $informationImage['extension'];
          $exetionArray = array('jpg', 'jpeg', 'png', 'gif');
          $adress = '../images/' . time() . rand();
          // echo 'pas mal !!!';
          if (in_array($exetionImage, $exetionArray)) {
               move_uploaded_file($_FILES['images']['tmp_name'], $adress);
               $requete = $bdd->prepare('INSERT INTO images(raison,idAuteur,nomAuteur,name, bin, types, size) VALUES (?,   ?,?,?,?,?,?)');
               $requete->execute(array($raison, $_SESSION['id'], $_SESSION['nom'], $_FILES['images']['name'], $adress, $_FILES['images']['type'], $_FILES['images']['size']));
               // header('location: ../php/profile.php');
          }
     } else {
          // header('location: profile.php?message= pas possible');

     }
}

if (isset($_GET['logOut'])) {
     $requete = $bdd->prepare('UPDATE user SET online=? WHERE id=? AND prenom=?');
     $requete->execute(array('false', $_SESSION['id'], $_SESSION['prenom']));
     $_SESSION = [];
     session_destroy();
     header('location: ../php/login.php');
}




?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <title>BéniHome</title>
    <style>
    .textColor {
        display: inline-block;
        margin: 10px 10px;
        font-size: 1.4em;
    }

    .spanText {
        font-size: 1.1em;
    }

    .textColored4 {
        text-align: center;
        color: #5e7ddb;
        font-size: 2.0em;
        margin-left: 10px;
        margin: 0;

    }
p{
     margin:0px;
}
    .textColored4::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        height: 4px;
        width: 50px;
        border-radius: 2px;
        background-color: #5e7ddb;
        margin: 10px 0;

    }

    .allRequete {
        /* padding: 20px 10px; */
        border: 1px #9d9d9d solid;

        border-radius: 5px;
    }

    .requete {
        display: inline-block;
        margin: 10px 0;
    }

    img.images {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    background: none;
               }
               .circle{
                width:100px;
                height:100px;
                border-radius:50px;
                background-color:#555;
               }

               .hideForm {
                    visibility: hidden;
                    display: none;
               }
               .allRequete {
                    padding: 15px 15px;
                    border: 1px #d9d8d8 solid;
                    border-radius: 5px;
               }

               .requete {
                    display: inline-block;
                    margin: 10px 0;
               }

               img.images {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    background: none;
               }

               .hideForm {
                    visibility: hidden;
                    display: none;
               }
               .custom-btn {
        background-color: #e10e49;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom-btn:hover {
        background-color: #ff4d80;
    }

    .custom-price {
        color: #e10e49;
    }

    .hideElements {
        display: none;
    }

    button.buttonTypePost {
        padding: 7px 10px;
        border: none;
        font-size: 1.4em;
        color: white;
        background: #5e7bdd;
        border-radius: 5px;
    }

    .buttonTypePost2 {
        border: none;
        font-size: 1.4em;
        color: white;
        background: #5e7bdd;
        border-radius: 5px;
    }

    .postText {
        width: 130px;
        padding: 20px 0;
        border: solid 1px #555;
        margin: 2px 0;
        display: inline-block;
    }

    .template1 {
        background: #37474F;
        color: white;
    }

    .template2 {
        background: #E53935;
        color: white;
    }

    .template3 {
        background: #2196F3;
        color: white;
    }

    .template4 {
        background: #EF6C00;
        color: white;
    }

    .template5 {
        background: #673AB7;
        color: white;
    }

    .template6 {
        background: #388E3C;
        color: white;
    }

    .template7 {
        color: white;
        background: linear-gradient(to left, #FF9800, #60bbdf);
    }

    .template8 {
        color: white;
        background: linear-gradient(to right, #F44336, #009688);
    }

    .template9 {
        background: #FDD835;
        color: #555;
    }

    .template10 {
        background: #555;
        color: wheat;
    }

    .textPostInput {
        text-align: center;
        padding: 13px 5px;
        font-size: 1.05em;
        width: 250px;
        height: 50px;
        border: none;
        font-family: sans-serif;
        background: #EEEEEE;
    }

    button.buttonPostText {
        padding: 7px 10px;
        font-size: 0.9em;
        width: 261px;
        color: white;
        background: #4527A0;
        border: none;
        font-family: sans-serif;
    }

    .templateApercuText {
        width: 100%;
        padding: 10px 0px;
        margin-bottom: 10px;
    }

    .post {
        width: 300px;
        margin: 0 auto;
        border: solid 1px #555;
    }

    .checkProfilePost {
        background-color: transparent;
        border: none;
        cursor: pointer;
        color: #555;
        font-family: sans-serif;
        font-size: 0.9em;
        padding: 0;
        margin-left: auto;
    }

    h2 {
        padding: 0 0 10px;
        width: 150px;
        margin-bottom: 10px;
        display: inline-block;
        font-size: 1.1em;
    }

    .pubs {
        padding: 45px 20px;
        font-size: 1.24em;
        text-align: center;
    }

    img.userImagePost {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .userPost {
        border: none;
        background: transparent;
        height: auto;
        width: 100%;
        text-align: left;
        color: #555;
        font-size: 0.9em;
    }

    .imagePost {
        border-top: 1px solid #d6cece;
    }
    path.userPath {
    fill: white;
}
svg.userSvg {
    height: 78px;
    width: 78px;
    margin-top: 22px;
    border-bottom-right-radius: 25px;
    border-bottom-left-radius: 25px;
}
.photo {
                    width: 40px;
                    display: inline-block;
                    position: relative;
                    top: 5px;
                    height: 40px;
                    background: #9E9E9E;
                    border-radius: 50%;
                    text-align:center;
                    margin-top:10px;
                }
                .userSvgPosts{
    height: 35px;
    margin-top: 5px;
    border-bottom-right-radius: 13px;
    border-bottom-left-radius: 13px;
                }

    </style>
    <?php
     $requeteGetMode = $bdd->prepare('SELECT mode FROM  user WHERE id=? AND nom=?');
     $requeteGetMode->execute(array($_SESSION['id'], $_SESSION['nom']));
     $resultsGetMode = $requeteGetMode->fetch();
     if ($resultsGetMode['mode'] == 'light') {


     ?>
    <link rel="stylesheet" href="../style/homePageStyle.css">
    <?php }
     if ($resultsGetMode['mode'] == 'dark') { ?>
    <link rel="stylesheet" href="../style/homePageStyle.css">
    <link rel="stylesheet" href="../style/styleDark.css">
    <?php
     }
     ?>
</head>

<body onclick="" class="homePage">
    <?php require('includes/navbar.php'); ?>
    <div class='container'>
        <center>
            <div class="profile">
                <div class="DESC">
                              <h3 class="">Profil</h3>
                              <br>
                    <?php
                         // Compter le nombre de questions de l'auteur
                         $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE raison=? AND idAuteur = ? AND nomAuteur = ? ');
                         $requeteCountImage->execute(array('profile', $_SESSION['id'], $_SESSION['nom']));
                         $imageCount = $requeteCountImage->fetch()['image_count'];

                         if ($imageCount == 0) { ?>
                    <form action="profile.php" style="border: none; padding:0px; margin:0px;" method="get">

                        <div class="circle"><svg class="userSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                         48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                

                    <?php  } else {
                              $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE raison=? AND idAuteur = ? AND nomAuteur = ?  ORDER BY id DESC LIMIT 1  ');
                              $requeteGetImage->execute(array('profile', $_SESSION['id'], $_SESSION['nom']));
                              while ($result = $requeteGetImage->fetch()) { ?>

                    <form action="profile.php" style="border: none; padding:0px; margin:0px;" method="get">
                        <button name="seeImageProfile" style="border: none;padding:0px;margin:0px;background: none;"
                            class="button10">
                            <div class="image"><img class="images" src="<?php echo $result['bin']; ?>" alt="image">
                            </div>
                            <input name="nomAuteur" class="hide" type="text" value="<?php echo $_SESSION['nom']; ?>">
                            <input name="idAuteur" class="hide" type="text" value="<?php echo $_SESSION['id']; ?>">
                            <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">
                        </button>
                        <?php }
                         }  ?>
                    </form>

                    <form action="profile.php" enctype="multipart/form-data" method="post">
                        <div>
                            <div class="hideForm" id="hideForm">
                                <!-- <input type="file" class="inputFile" name="images" placeholder="choisissez une image" id="images" required> -->
                                <input type="file" class="inputfile" name="images" placeholder="choisissez une image"
                                    id="images" required>
                                <br>
                                <button class="button11" name="valider">Envoyer</button><br>
                            </div>
                        </div>
                    </form>
                    <div class="DESC">
                                             <h5 class="span1"><?php echo $_SESSION['nom'] . ' ' . $_SESSION['prenom']; ?></h5>
                                             <?php
                                        if ($_SESSION['type'] == 'Locataire') {

                                             // Compter le nombre de demande de l'auteur
                                             $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM demande WHERE idAuteur = ? AND nomAuteur = ? ');
                                             $requeteCountImage->execute(array($_SESSION['id'], $_SESSION['nom']));
                                             $imageCount = $requeteCountImage->fetch()['image_count'];
                                        ?>
                                             <header class="d-flex border-top border-bottom justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item px-2"><a href="profile.php?argument=Demandes" class="nav-link  px-0 <?php if (isset($_GET['argument'])) { if ($_GET['argument'] == 'Demandes') { ?> active px-2 <?php } } ?>" aria-current="page">Demandes</a></li>
        <li class="nav-item px-2"><a href="profile.php?argument=Info" class="nav-link px-0 <?php if (isset($_GET['argument'])) {if ($_GET['argument'] == 'Info') { ?> active px-2 <?php }}if (!isset($_GET['argument']) && !isset($_GET['settings'])) { ?> textColor3 <?php } ?>">Infos</a></li>
        <li class="nav-item px-2"><a href="profile.php?argument=Paramètres" class="nav-link px-0<?php if (isset($_GET['argument'])) {if ($_GET['argument'] == 'Paramètres') { ?>  active px-2 <?php }}if (isset($_GET['settings'])) { ?> active <?php } ?>">Paramètres</a></li>
      </ul>
    </header>                     
     

                        <br>
                        <?php if (isset($_GET['argument'])) {
                                                       if ($_GET['argument'] == 'Demandes') { ?>

                            <?php
                                                                 $requeteGetDemande = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur= ? AND prenomAuteur=?');
                                                                 $requeteGetDemande->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom']));
                                                                 while ($resultatsGetDemande = $requeteGetDemande->fetch()) {  ?>

<div class="col-md-5 col-lg-5 col-sm-10 my-2">
<div class="card">

<div class="card-header">
     <h5 class="card-title"><?php echo $resultatsGetDemande['typeDemande']; ?></h5>
</div>
<div class="card-body">
     <div class="d-flex justify-content-center text-left">
          <h6 class="card-text my-0 py-0">Chambre : </h6><span class=""><?php echo $resultatsGetDemande['typeDeChambre']; ?></span>
     </div>
     <div class="d-flex justify-content-center  text-left">
          <h6 class="card-text my-0 py-0">Quartier : </h6><span class=""><?php echo $resultatsGetDemande['quartier']; ?></span>
     </div>
     <div class="d-flex justify-content-center">
          <h6 class="card-text my-0 py-0">Paticularité : </h6><span class=""><?php echo $resultatsGetDemande['IndicationParticulaire']; ?></span>
     </div>
     <div class="d-flex justify-content-center">
          <h6 class="card-text my-0 py-0">Profile recherché : </h6><span class=""><?php echo $resultatsGetDemande['socialSituation']; ?></span>
     </div>

     <p class="card-text my-0 py-0"></p>
     <form action="notificationPlus.php" method="get">
                                        <input name="idAuteur" class="hide" type="text"
                                            value="<?php echo $resultatsGetDemande['idAuteur']; ?>">
                                        <input name="nomAuteur" class="hide" type="text"
                                            value="<?php echo $resultatsGetDemande['nomAuteur']; ?>">
                                        <input name="prenomAuteur" class="hide" type="text"
                                            value="<?php echo $resultatsGetDemande['prenomAuteur']; ?>">
                                        <input name="typeDeChambre" class="hide" type="text"
                                            value="<?php echo $resultatsGetDemande['typeDeChambre']; ?>">
                                        <input name="quartier" class="hide" type="text"
                                            value="<?php echo $resultatsGetDemande['quartier']; ?>">
                                        <input name="demande" class="hide" type="text"
                                            value="<?php echo $resultatsGetDemande['typeDemande']; ?>">
                                        <input name="number" class="hide" type="text"
                                            value="<?php echo $_SESSION['number']; ?>">
                                        <input name="ville" class="hide" type="text"
                                            value="<?php echo $resultatsGetDemande['ville']; ?>">
                                        <input name="prix" class="hide" type="text"
                                            value="<?php echo $resultatsGetDemande['prix']; ?>">
                                        <input name="IndicationParticulaire" class="hide" type="text"
                                            value="<?php echo $resultatsGetDemande['IndicationParticulaire']; ?>">
                                        <input name="socialSituation" class="hide" type="text"
                                            value="<?php echo $resultatsGetDemande['socialSituation']; ?>">
                                        <input name="date" class="hide" type="text"
                                            value="<?php echo $resultatsGetDemande['date']; ?>">
                                        <input name="type" class="hide" type="text"
                                            value="<?php echo $resultatsGetDemande['type']; ?>">
                                        <input name="verification" class="hide" type="text" value="true">
                                    </button>        <button  class="btn btn-primary">Aller voir</button>
                                                                 </form>
                                                            </div>
                                                            <div class="card-footer text-muted">
                                                            <?php 
                                                                   $oldDate = $resultatsGetDemande['date'];
                                                                   $dateEnregistrement = new DateTime($oldDate);
                                                                   $dateActuelle = new DateTime();
                                                                   $intervalle = $dateActuelle->diff($dateEnregistrement);
                 
                                                                   if ($intervalle->y > 0) {
                                                                    // Si plus d'un an est passée
                                                                    $tempsEcoule = $intervalle->y . " ans";
                                                                } elseif ($intervalle->m > 0) {
                                                                    // Si plus d'un mois est passée
                                                                    $tempsEcoule = $intervalle->m . " M";
                                                                } elseif ($intervalle->d > 0) {
                                                                    // Si plus d'un jour est passé
                                                                    $tempsEcoule = $intervalle->d . " j";
                                                                } elseif ($intervalle->h > 0) {
                                                                    // Si plus d'une heure est passée
                                                                    $tempsEcoule = $intervalle->h . " h";
                                                                } elseif ($intervalle->i > 0) {
                                                                    // Si plus d'une minute est passée
                                                                    $tempsEcoule = $intervalle->i . "min";
                                                                } else {
                                                                    // Si moins d'une minute est passée
                                                                    $tempsEcoule = $intervalle->s . " s";
                                                                }
             ?>
                                                                   <?php echo 'Depuis : ' . $tempsEcoule; ?>
                                                            </div>
                                                            </div>     </div>
                            <?php   }
                                                            }
                                                       }
                                                  }
                                              else {

                                                  if ($_SESSION['type'] == 'Proprietaire') {   ?>
                               <header class="d-flex border-top border-bottom justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="profile.php?argument=Offres" class="nav-link  <?php if (isset($_GET['argument'])) { if ($_GET['argument'] == 'Offres') { ?> active <?php } } ?>" aria-current="page">Offres</a></li>
        <li class="nav-item"><a href="profile.php?argument=Info" class="nav-link <?php if (isset($_GET['argument'])) {if ($_GET['argument'] == 'Info') { ?> active <?php }}if (!isset($_GET['argument']) && !isset($_GET['settings'])) { ?> textColor3 <?php } ?>">Infos</a></li>
        <li class="nav-item"><a href="profile.php?argument=Paramètres" class="nav-link <?php if (isset($_GET['argument'])) {if ($_GET['argument'] == 'Paramètres') { ?>  active <?php }}if (isset($_GET['settings'])) { ?> active <?php } ?>">Paramètres</a></li>
      </ul>
    </header>                     
     
                            <?php
                                                       // Compter le nombre de offre de l'auteur
                                                       $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM offre WHERE idAuteur = ? AND nomAuteur = ? ');
                                                       $requeteCountImage->execute(array($_SESSION['id'], $_SESSION['nom']));
                                                       $imageCount = $requeteCountImage->fetch()['image_count'];

                                                       if ($imageCount == 0) {
                                                       } else {
                                                       ?>
                            <br>

                            <?php if (isset($_GET['argument'])) {
                                                                 if ($_GET['argument'] == 'Offres') { ?>
                            <!-- <div class="allRequete" style=" border: 1px #cecacad9 solid;     padding: 20px;"> -->

                                <?php
                                                                           $requeteGetOffrre = $bdd->prepare('SELECT * FROM offre WHERE idAuteur=? AND nomAuteur= ? AND prenomAuteur=?');
                                                                           $requeteGetOffrre->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom']));
                                                                           while ($resultatsGetOffre = $requeteGetOffrre->fetch()) {  ?>
                                                                           <div class="col-md-5 col-lg-5 col-sm-10 my-2">
                                                       <div class="card">

                                                            <div class="card-header">
                                                                 <h5 class="card-title"><?php echo $resultatsGetOffre['typeDemande']; ?></h5>
                                                            </div>
                                                            <div class="card-body">
                                                                 <div class="d-flex justify-content-center text-left">
                                                                      <h6 class="card-text my-0 py-0">Chambre : </h6><span class=""><?php echo $resultatsGetOffre['typeDeChambre']; ?></span>
                                                                 </div>
                                                                 <div class="d-flex justify-content-center  text-left">
                                                                      <h6 class="card-text my-0 py-0">Quartier : </h6><span class=""><?php echo $resultatsGetOffre['quartier']; ?></span>
                                                                 </div>
                                                                 <div class="d-flex justify-content-center">
                                                                      <h6 class="card-text my-0 py-0">Paticularité : </h6><span class=""><?php echo $resultatsGetOffre['IndicationParticulaire']; ?></span>
                                                                 </div>
                                                                 <div class="d-flex justify-content-center">
                                                                      <h6 class="card-text my-0 py-0">Profile recherché : </h6><span class=""><?php echo $resultatsGetOffre['socialSituation']; ?></span>
                                                                 </div>

                                                                 <p class="card-text my-0 py-0"></p>
                                                                 <form action="notificationPlus.php" method="get">
                                                                      <input name="idNotif" class="hide" type="text" value="<?php echo $resultatsGetOffre['id']; ?>">
                                                                      <input name="idAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['idAuteur']; ?>">
                                                                      <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['nomAuteur']; ?>">
                                                                      <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['prenomAuteur']; ?>">
                                                                      <input name="typeDeChambre" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDeChambre']; ?>">
                                                                      <input name="quartier" class="hide" type="text" value="<?php echo $resultatsGetOffre['quartier']; ?>">
                                                                      <input name="demande" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDemande']; ?>">
                                                                      <input name="number" class="hide" type="text" value="<?php echo $_SESSION['number']; ?>">
                                                                      <input name="prix" class="hide" type="text" value="<?php echo $resultatsGetOffre['prix']; ?>">
                                                                      <input name="ville" class="hide" type="text" value="<?php echo $resultatsGetOffre['ville']; ?>">
                                                                      <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $resultatsGetOffre['IndicationParticulaire']; ?>">
                                                                      <input name="socialSituation" class="hide" type="text" value="<?php echo $resultatsGetOffre['socialSituation']; ?>">
                                                                      <input name="short" class="hide" type="text" value="<?php echo $resultatsGetOffre['short']; ?>">
                                                                      <input name="date" class="hide" type="text" value="<?php echo $resultatsGetOffre['date']; ?>">
                                                                      <input name="type" class="hide" type="text" value="<?php echo $resultatsGetOffre['type']; ?>">
                                                                      <input name="idNotif" class="hide" type="text" value="<?php echo $resultatsGetOffre['id']; ?>">
                                                                      <input name="verification" class="hide" type="text" value="true">
                                                                      <button class="btn btn-primary">Aller voir</button>
                                                                 </form>
                                                            </div>
                                                            <div class="card-footer text-muted">
                                                          
                                                            <?php 
                                                                   $oldDate = $resultatsGetOffre['date'];
                                                                   $dateEnregistrement = new DateTime($oldDate);
                                                                   $dateActuelle = new DateTime();
                                                                   $intervalle = $dateActuelle->diff($dateEnregistrement);
                 
                                                                   if ($intervalle->d > 0) {
                                                                       // Si plus d'un jour est passé
                                                                       $tempsEcoule = $intervalle->d . " jours";
                                                                   } elseif ($intervalle->y > 0) {
                                                                    // Si plus d'une heure est passée
                                                                    $tempsEcoule = $intervalle->y . " ans";
                                                                }elseif ($intervalle->m > 0) {
                                                                    // Si plus d'une heure est passée
                                                                    $tempsEcoule = $intervalle->m . " mois";
                                                                }  elseif ($intervalle->h > 0) {
                                                                       // Si plus d'une heure est passée
                                                                       $tempsEcoule = $intervalle->h . " heures";
                                                                   } elseif ($intervalle->i > 0) {
                                                                       // Si plus d'une minute est passée
                                                                       $tempsEcoule = $intervalle->i . " minutes";
                                                                   } else {
                                                                       // Si moins d'une minute est passée
                                                                       $tempsEcoule = $intervalle->s . " secondes";
                                                                   } ?>
                                                                   <?php echo 'Depuis : ' . $tempsEcoule; ?>
                                                            </div>
                                                       </div>
                                                                           </div>
                                             <?php } }?>
                                                                       
                                                                           <?php
                                                } }}}
                                                   ?>
                            </div>
                            <?php if (isset($_GET['argument'])) {
                                                                           if ($_GET['argument'] == 'Info') { ?>
                                <?php if (empty($_SESSION['email'])) {
                                                                                     } else { ?>
                          <div class="d-flex justify-content-center">
                                             <h4 class="textColored">Email :</h4><span class="lead"><?php echo $_SESSION['email']; ?></span>
<?php      }?>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                             <h5 class="textColored">Type du compte : </h5><span class="lead"><?php echo $_SESSION['type']; ?></span>

                                        </div>
                                        <div class="d-flex justify-content-center">
                                             <h5 class="textColored">Numero de telephone:</h5><span class="lead"><?php echo $_SESSION['number']; ?></span>

                                        </div>
                                        <div class="d-flex justify-content-center">
                                             <h5 class="textColored">Ville : </h5><span class="lead"><?php echo $_SESSION['ville']; ?></span>

                                        </div>
                                        
                                        <h5 class="textColored">Numero de telephone:</h5> +229
                                        <span><?php echo ' ' . $_SESSION['number']; ?></span><br>
                                    </div>            

                                    <br>
                         <h2 class="textColored text-primary">Publications</h2>
                         <br>

                         <div class="allRequete p-1">
                              <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                   <?php

$requeteGetPost = $bdd->prepare('SELECT COUNT(*) AS total  FROM pulications WHERE idAuteur=? AND nomAuteur= ? AND prenomAuteur=?');
$requeteGetPost->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom']));
$resultGetPost = $requeteGetPost->fetch();

if($resultGetPost['total']== 0 ){
    echo ' <div class="text-center "><p class="lead" >Vous n\'avez encor une publications a votre actif </p> <a class="text-primary" href="addPost.php">Faire un publications</a>';
}


                                   $requeteGetPost = $bdd->prepare('SELECT * FROM pulications WHERE idAuteur=? AND nomAuteur= ? AND prenomAuteur=?');
                                   $requeteGetPost->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom']));
                                   while ($resultGetPost = $requeteGetPost->fetch()) {  ?>

                                        <div class="col">
                                             <div class="card my-1">
                                                  <div class="card-header px-0 py-0 pb-2">
                                                       <?php

                                                       if (!empty($resultGetPost['template'])) {
                                                       ?>
                                                            <form action="posts.php" method="get" class="post" style="border: none;background: none;padding: 0;margin: 0;">
                                                                 <?php $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? AND raison=?');
                                                                 $requeteCountImage->execute(array($resultGetPost['idAuteur'], $resultGetPost['nomAuteur'], 'profile'));
                                                                 $imageCount = $requeteCountImage->fetch()['image_count'];

                                                                 if ($imageCount == 0) { ?>
                                                                      <!-- <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">  <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>"> -->
                                                                      <input name="idCorrespondant" class="hide" type="text" value="<?php echo $resultGetPost['idAuteur']; ?>">
                                                                      <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultGetPost['nomAuteur']; ?>">
                                                                      <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $resultGetPost['prenomAuteur']; ?>">
                                                                      <button name="checkProfile" class="userPost">
                                                                      <div class="photo"><svg class="userSvgPosts" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path  class="userPath" style="fill: #f8f9fa;" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                                                      48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                                                                           <div id="addPictures1" class="addPictures1" style="display:inline-block;">
                                                                                <p class="h5" style="margin: 0; display:inline-block;">
                                                                                     <?php echo $resultGetPost['nomAuteur'] . ' ' . $resultGetPost['prenomAuteur'] ?>
                                                                                </p>
                                                                      </button>
                                             <?php  } else {
                                                                      $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE idAuteur = ? AND raison=? ORDER BY id DESC LIMIT 1  ');
                                                                      $requeteGetImage->execute(array($resultGetPost['idAuteur'], 'profile'));
                                                                      $result = $requeteGetImage->fetch(); ?>
                                                  <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">
                                                  <input name="idCorrespondant" class="hide" type="text" value="<?php echo $resultGetPost['idAuteur']; ?>">
                                                  <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultGetPost['nomAuteur']; ?>">
                                                  <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $resultGetPost['prenomAuteur']; ?>">
                                                  <button name="checkProfile" class="userPost">
                                                       <img class="userImagePost" src="<?php echo $result['bin']; ?>" alt="image">
                                                       <p class="h5" style="margin: 0; display:inline-block;">
                                                            <?php echo $resultGetPost['nomAuteur'] . ' ' . $resultGetPost['prenomAuteur'] ?></p>
                                                  </button>
                                                  </form>
                                             <?php  } ?>
                                             </div>
                                             <div class="card-body" style="padding:0;">
                                                  <div class="postsText">
                                                       <div class="pubs <?php echo $resultGetPost['template']; ?>">
                                                            <p style="color: white;"><?php echo $resultGetPost['text']; ?></p>
                                                       </div>
                                                  </div>
                                             <?php }
                                                       if (empty($resultGetPost['template'])) { ?>
                                                  <form action="posts.php" method="get">
                                                       <?php $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? AND raison=?');
                                                            $requeteCountImage->execute(array($resultGetPost['idAuteur'], $resultGetPost['nomAuteur'], 'profile'));
                                                            $imageCount = $requeteCountImage->fetch()['image_count'];

                                                            if ($imageCount == 0) { ?>
                                                            <!-- <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">  <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>"> -->
                                                            <input name="idCorrespondant" class="hide" type="text" value="<?php echo $resultGetPost['idAuteur']; ?>">
                                                            <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultGetPost['nomAuteur']; ?>">
                                                            <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $resultGetPost['prenomAuteur']; ?>">
                                                            <button name="checkProfile" class="userPost">
                                                            <div class="photo"><svg class="userSvgPosts" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" style="fill: #f8f9fa;" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                                                      48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                                                                         <div id="addPictures1" class="addPictures1" style="display:inline-block;">
                                                                      <p class="h5" style="margin: 0; display:inline-block;">
                                                                           <?php echo $resultGetPost['nomAuteur'] . ' ' . $resultGetPost['prenomAuteur'] ?></p>

                                                            </button>
                                        <?php  } else {
                                                                 $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE idAuteur = ?  AND nomAuteur =? AND raison=? ORDER BY id DESC LIMIT 1  ');
                                                                 $requeteGetImage->execute(array($resultGetPost['idAuteur'], $resultGetPost['nomAuteur'], 'profile'));
                                                                 $result = $requeteGetImage->fetch(); ?>
                                             <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">
                                             <input name="idCorrespondant" class="hide" type="text" value="<?php echo $resultGetPost['idAuteur']; ?>">
                                             <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultGetPost['nomAuteur']; ?>">
                                             <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $resultGetPost['prenomAuteur']; ?>">
                                             <button name="checkProfile" class="userPost">
                                                  <img class="userImagePost" src="<?php echo $result['bin']; ?>" alt="image">
                                                  <p class="h5" style="margin: 0; display:inline-block;">
                                                       <?php echo $resultGetPost['nomAuteur'] . ' ' . $resultGetPost['prenomAuteur'] ?></p>
                                             </button>
                                             </form>
                                        <?php  } ?>

                                        <div class="postsText">
                                             <div class="imagePost">
                                                  <p style="color: black; text-align:left; margin:0px;"><?php echo $resultGetPost['text']; ?></p>
                                                  <img style="  width: 100%;max-height: 250px;" src="<?php echo $resultGetPost['image'];  ?>" alt="image indisponible">
                                             </div>

                                        </div>
                                   <?php } ?>
                                        </div>
                                        <div class="card-footer text-muted">
                                             <form action="posts.php" method="get">
                                                  <div class="actionPost text-center">
                                                       <input name="idAuteur" class="hide" type="text" value="<?php echo $resultGetPost['idAuteur']; ?>">
                                                       <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultGetPost['nomAuteur']; ?>">
                                                       <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultGetPost['prenomAuteur']; ?>">
                                                       <input name="idPost" class="hide" type="text" value="<?php echo $resultGetPost['id']; ?>">
                                                       <input name="specialId" class="hide" type="text" value="<?php echo $resultGetPost['specialId']; ?>">
                                                       <input name="date" class="hide" type="text" value="<?php echo $resultGetPost['date']; ?>">
                                                       <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                                       <button class=" btn btn-primary" name="vues">
                                                            <div class="d-flex justify-content-center  align-items-center">
                                                                 <p class="lead py-0 my-0 mr-1">Aller</p>
                                                                 <svg class="ml-1" style="width:25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                                      <path style="fill:white;" d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 
                    108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 
                    256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8
                     207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 
                     0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 
                     356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2
                 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 
                 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                                                 </svg>
                                                            </div>
                                                       </button>


                                                  </div>
                                        </div>

                                        </form>
                              </div>
                         </div>

                    <?php  } ?>
                    </div>
                    </div>
                                        </div>
                    <br>


                       
                                <?php }
                                                              if ($_GET['argument'] == 'Paramètres') { ?>
                          <div class="mb-3">
                            <p style="margin:0px;" class="lead">Photo de profil</p>
                            <a href="profile.php?settings=profileImage"> <small
                                        class="text-primary lead">Modifier</small></a>
                                        </div>
                                  
                                        <div class="mb-3">
                                <p style="margin:0px;" class="lead"><?php echo  $_SESSION['nom'] . ' ' . $_SESSION['prenom']; ?></p>
                                <a href="profile.php?settings=userName"> <small class="text-primary lead">Modifier</small></a></div>                       
                                <?php if (empty($_SESSION['email'])) {
                                                                                     } else { ?>
                                                                                   <div class="mb-3">
                                <p style="margin:0px;" class="textolor1"><?php echo  $_SESSION['email']; ?></p>
                                <a href="profile.php?settings=email"> <small class="text-primary lead">Modifier</small></a></div>
                                <?php } ?><div class="mb-3">
                                <p style="margin:0px;" class="textolor1"><?php echo  $_SESSION['ville']; ?></p>
                                <a href="profile.php?settings=ville"> <small class="text-primary lead">Modifier</small></a></div>
                              
                                <div class="mb-3">
                                <p style="margin:0px;" class="textolor1"><?php echo  $_SESSION['type']; ?></p>
                                <a href="profile.php?settings=type"> <small class="text-primary lead">Modifier</small></a></div>
                              
                                <div class="mb-3">
                                <p style="margin:0px;" class="textolor1"> +229 <?php echo  ' ' . $_SESSION['number']; ?></p>
                                <a href="profile.php?settings=number"> <small class="text-primary lead">Modifier</small></a></div>

                                <a href="profile.php?settings=mdp">
                                    <h5 class="ptextolor">Mot de passe</h6>
                                </a>
                            <?php }
                                                                      }
                                                                      if (!isset($_GET['argument']) && !isset($_GET['settings'])) { ?>
                           <div class="d-flex justify-content-center">
                              <h5 class="card-text my-0 py-0">Ville :</h5><span class="lead"><?php echo  $_SESSION['ville'] ; ?></span>
                          </div>
                          <?php if (empty($_SESSION['email'])) {
                                                                                     } else { ?>
                          <div class="d-flex justify-content-center">
                         <h5 class="card-text my-0 py-0">Email:</h5><span class="lead"><?php echo $_SESSION['email']; ?></span>
                         </div>  <?php } ?>
                         <div class="d-flex justify-content-center">
                         <h5 class="card-text my-0 py-0">Type du compte :  </h5><span class="lead"><?php echo $_SESSION['type']; ?></span>
                          </div> 
                          <div class="d-flex justify-content-center">
                            <h5 class="card-text my-0 py-0">Numero de telephone : </h4><span class="lead"><?php echo '+299 '.$_SESSION['number'];; ?></span>
                         </div> 
                            <?php }
                                                                      if (isset($_GET['settings'])) {
                                                                      ?>
                                <h3 class="textColored" style="margin: 0;">Modifications</h3><br>
                                <?php
                                                                                if ($_GET['settings'] == 'userName') {
                                                                                ?>
                               <form action="profile.php" method="post">
                               <form action="profile.php" method="post">
                               <form action="profile.php" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3">
                        <input name="nom" type="text" class="form-control profileSettingsInput" placeholder="Nom" required>
                    </div>
                    <div class="col-sm-6">
                        <input name="prenom" type="text" class="form-control profileSettingsInput" placeholder="Prénom" required>
                    </div>
                </div>
                <div class="form-group">
                    <input name="holdPassword" type="password" class="form-control profileSettingsInput" placeholder="Mot de passe" required>
                </div>
                <?php if (isset($_GET['errormessage'])) {
                    echo '   <div class="d-flex mb-2 justify-content-center"><small class="text-danger">' . $_GET['errormessage'] . '</small></div>';
                } ?>
                <button name="changingOfUserName" class="btn btn-block btn-primary profileSettingsButton">Envoyer</button>
                <div class="d-flex justify-content-center"> <small class="text-info"><a href="profile.php?mdpForgot=true">Mot de passe oublié</a></small></div>
            </div>
        </div>
    </div>
</form>



                            <?php
                                                                                }
                                                                                if ($_GET['settings'] == 'email') {
                                                                      ?>
                           <form action="profile.php" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group row">
                    <div class="col-sm-12 mb-2">
                        <input name="email" type="text" class="form-control profileSettingsInput" placeholder="Email " required>
                    </div>
                    <div class="col-sm-12">
                        <input name="holdPassword" type="password" class="form-control profileSettingsInput" placeholder="Mot de passe " required>
                    </div>
                </div>
                <?php if (isset($_GET['errormessage'])) {
                    echo ' <div class="d-flex justify-content-center mb-2 text-left"><small class="text-danger">' . $_GET['errormessage'] . '</small></div>';
                } ?>
                <button name="changingOfEmail" class="btn btn-block btn-primary ">Envoyer</button>
                <div class="d-flex justify-content-center  text-left"> <small class="text-info"><a href="profile.php?mdpForgot=true">Mot de passe oublié</a></small></div>
            </div>
        </div>
    </div>
</form>

                        <?php
                                                                                }
                                                                                if ($_GET['settings'] == 'type') {
                                                       ?>
                        <form action="profile.php" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h4 class="type">Changer le type du compte</h4>
                <input name="changingOfTypeOfCompte" class="hide" type="text" value="true">
                <div class="form-group">
                    <input name="holdPassword" type="password" class="form-control profileSettingsInput" placeholder="Mot de passe" required>
                </div>
                <?php if (isset($_GET['errormessage'])) {
                    echo ' <div class="d-flex justify-content-center  text-left"><small class="text-danger">' . $_GET['errormessage'] . '</small></div>';
                } ?>
                <div class="form-group">
                    <button name="typeLocataire" class="btn btn-primary btn-block profileTypeButton">Locataire</button>
                </div>
                <div class="form-group">
                    <button name="typeProprietaire" class="btn btn-primary btn-block profileTypeButton">Propriétaire</button>
                </div>
                <div class="d-flex justify-content-center  text-left"><small class="text-info"><a href="profile.php?mdpForgot=true">Mot de passe oublié</a></small></div>
                <script>
                    alert('Si vous changez le type du compte, vous risquez de perdre toutes vos <?php if ($_SESSION['type'] == 'Proprietaire') { echo 'offres'; } if ($_SESSION['type'] == 'Locataire') { echo 'demandes'; } ?>.')
                </script>
            </div>
        </div>
    </div>
</form>

                    </div>
                    <?php
                                                                                }
                                                                                if ($_GET['settings'] == 'number') {
                              ?>
                   <form action="profile.php" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <input name="number" type="number" class="form-control profileSettingsInput" placeholder="Numéro" required>
                </div>
                <div class="form-group">
                    <input name="holdPassword" type="password" class="form-control profileSettingsInput" placeholder="Mot de passe" required>
                </div>
                <?php if (isset($_GET['errormessage'])) {
                    echo '<div class="d-flex justify-content-center  text-left"><small class="text-danger">' . $_GET['errormessage'] . '</small></div>';
                } ?>
                <button name="changingOfNumber" class="btn btn-primary btn-block profileSettingsButton">Envoyer</button>
                <div class="d-flex justify-content-center  text-left"><small class="text-info"><a href="profile.php?mdpForgot=true">Mot de passe oublié</a></small></div>
            </div>
        </div>
    </div>
</form>

                <?php
                                                                                }
                                                                                if ($_GET['settings'] == 'ville') {
               ?>
              <form action="profile.php" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <input name="ville" type="text" class="form-control profileSettingsInput" placeholder="Ville" required>
                </div>
                <div class="form-group">
                    <input name="holdPassword" type="password" class="form-control profileSettingsInput" placeholder="Mot de passe " required>
                </div>
                <?php if (isset($_GET['errormessage'])) {
                    echo ' <div class="d-flex mb-2 justify-content-center"><small class="text-danger">' . $_GET['errormessage'] . '</small></div>';
                } ?>
                <button name="changingOfVille" class="btn btn-primary btn-block profileSettingsButton">Envoyer</button>
                <div class="d-flex justify-content-center"><small class="text-info"><a href="profile.php?mdpForgot=true">Mot de passe oublié</a></small></div>
            </div>
        </div>
    </div>
</form>

            <?php
                                                                                }
                                                                                if ($_GET['settings'] == 'mdp') {
          ?>
           <form action="profile.php" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <input name="newPassword" type="password" class="form-control profileSettingsInput" placeholder="Nouveau mot de passe" required>
                </div>
                <div class="form-group">
                    <input name="newPasswordConfirm" type="password" class="form-control profileSettingsInput" placeholder="Confirmer le nouveau mot de passe " required>
                </div>
                <div class="form-group">
                    <input name="holdPassword" type="password" class="form-control profileSettingsInput" placeholder="Ancien mot de passe" required>
                </div>
                <?php if (isset($_GET['errormessage'])) {
                    echo '<div class="d-flex justify-content-center  text-left"><small class="text-danger">' . $_GET['errormessage'] . '</small></div>';
                } ?>
                <button name="changingOfPassword" class="btn btn-primary btn-block profileSettingsButton">Envoyer</button>
                <div class="d-flex justify-content-center  text-left"><small class="text-info"><a href="profile.php?mdpForgot=true">Mot de passe oublié</a></small></div>
            </div>
        </div>
    </div>
</form>

    <?php
                                                                                }
                                                                                if ($_GET['settings'] == 'profileImage') {
?>
 <form action="profile.php" enctype="multipart/form-data" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h4 class="lead text-center mb-4">Importer votre photo de profil</h4>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="images" name="images" required>
                        <label class="custom-file-label" for="images">Choisissez une image</label>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" name="valider" class="btn btn-primary mt-2">Envoyer</button>
                </div>
            </div>
        </div>
    </div>
</form>



    <?php       }                                                                                                                                                                                              }
?>
    <br>
<div class="border-bottom mb-3"></div>

    <!-- <div class="copyLink">
<input type="text" class="hide" value="<?php echo  $_GET['short'];   ?>" id="link">
     <div id="copyButton" class="btnLink"><svg class="linkSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path style="fill: #2c2c2c;" d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"/></svg><h4 class="link">copiez le lien de l'offre.</h4></div>
</div> -->
    <form action="profile.php " class="form-group" method="POST">
                            <button name="logOut" class="btn btn-outline-secondary">Se déconnecter</button>
                         </form>
                         <div class="border-top mt-3 mb-3"></div>
    <form action="profile.php" method="get">

                                             <a href="<?php if (isset($_GET['linkChatProfile'])) {
                                                            echo $_GET['linkChatProfile'];
                                                       } else {
                                                            echo 'chatList.php';
                                                       } ?>"> <a href="home.php" class="btn btn-primary">Retour ></a>
                                                       <!-- <button class="btn btn-primary">Aller voir</button> -->
                                             </a>
                                        </form>
    </div>
    </div>

    </center>
    </div><br><br>

    </div>
    <!-- <script type="text/javascript">
     
    var icon1 = document.getElementById('addPictures1')
    var icon2 = document.getElementById('addPictures2')
    var form = document.getElementById('hideForm');

    function showIcon() {
        icon1.style.display = 'inline';
        icon2.style.display = 'inline';

    }

    function hideMenu() {
        icon1.style.display = 'none';
        icon2.style.display = 'none';


    }

    function showForm() {
        form.style.display = 'block';
    }
    </script> -->
</body>

</html>