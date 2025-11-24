<?php
require('includes/require.php');

if (isset($_GET['seeImage'])) {

     header('location: seeImage.php?seeImage=true&image=' . $_GET['images'] . '&nomAuteur=' . $_GET['nomAuteur'] . '&idAuteur=' . $_GET['idAuteur']);
}

if($_SESSION['id']==$_GET['idCorrespondant'] && $_SESSION['nom']== $_GET['nomCorrespondant'] && $_SESSION['prenom']==$_GET['prenomCorrespondant']){
     header('location: profile.php');
}

if (isset($_GET['checkProfile'])) {

     // if ($_SESSION['nom'] == $_GET['nomCorrespondant'] && $_SESSION['id'] == $_GET['idCorrespondant']) {


     //   header('location: profile.php');
     // }

     if (isset($_GET['seeImage'])) {

          header('location: seeImage.php?seeImage=true&image=' . $_GET['images']);
     }

     $requeteGetUserInfo = $bdd->prepare('SELECT * FROM user WHERE id = ? AND nom = ?');
     $requeteGetUserInfo->execute(array($_GET['idCorrespondant'], $_GET['nomCorrespondant']));
     $resultUserInfo = $requeteGetUserInfo->fetch();




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
.circle {
    width: 100px;
    height: 100px;
    background: #555;
    border-radius: 50%;
    text-align: center;
    display: inline-block;
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
                              <h3 class="">Profile</h3>
                              <!-- <div class="circle"></div> -->
                              <br>
                              <?php
                              // Compter le nombre de questions de l'auteur
                              $requeteCountImage = $bdd->prepare('SELECT * FROM images WHERE idAuteur = ? AND nomAuteur = ? ');
                              $requeteCountImage->execute(array($_GET['idCorrespondant'], $_GET['nomCorrespondant']));
                              $imageCount = $requeteCountImage->fetch();

                              if (!isset($imageCount['bin'])) { ?>
                                   <div class="circle"><svg class="userSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                         48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>

                                   <?php  } else {
                                   $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE raison=? AND idAuteur = ? AND nomAuteur = ?  ORDER BY id DESC LIMIT 1  ');
                                   $requeteGetImage->execute(array('profile', $_GET['idCorrespondant'], $_GET['nomCorrespondant']));
                                   while ($result = $requeteGetImage->fetch()) { ?>

                                        <form action="profile.php" method="get">
                                             <button name="seeImageProfile" style="border: none;padding:0px;margin:0px;background: none;" class="button10">
                                                  <div class="image" onmouseover="showIcon();"><img class="images" src="<?php echo $result['bin']; ?>" alt="image"></div>
                                                  <input name="nomAuteur" class="hide" type="text" value="<?php echo $_GET['nomCorrespondant']; ?>">
                                                  <input name="idAuteur" class="hide" type="text" value="<?php echo $_GET['idCorrespondant']; ?>">
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
                                                       <input type="file" class="inputfile" name="images" placeholder="choisissez une image" id="images" required>
                                                       <br>
                                                       <button class="button11" name="valider">Envoyer</button><br>
                                                  </div>
                                             </div>
                                        </form>
                                        <div class="DESC">
                                             <h5 class="span1"><?php echo $resultUserInfo['nom'] . ' ' . $resultUserInfo['prenom']; ?></h5>
                                             <br><?php if (empty($resultUserInfo['email'])) {
                                                  } else { ?>
                                                  <form action="chatList.php" class=" d-flex flex-column flex-sm-row w-100 gap-2  justify-content-center" method="get">
                                                       <input name="idCorrespondant" class="hide" type="text" value="<?php echo $resultUserInfo['id']; ?>">
                                                       <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultUserInfo['nom']; ?>">
                                                       <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $resultUserInfo['prenom']; ?>">
                                                       <input type="text" class="form-control  col-lg-3 col-md-4 col-sm-6" id="firstName" name="message" placeholder="Entrer votre message" value="">
                                                       <button class="btn btn-primary col-lg-2 col-md-2 col-sm-3 ml-lg-2" name="chatMessage">Envoyer<svg style="margin-left:3px;" xmlns="http://www.w3.org/2000/svg" class="c" width="25px" height="25px" viewBox="0 0 512 512">
                                                                 <path style="fill:white;" id="chat" d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 
                        20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4l0 0 0 0 0 0 0 0
                         .3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 
                         326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z" />

                                                            </svg></button>
                                                  </form>
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-center">
                                             <h4 class="textColored">Email :</h4><span class="lead"><?php echo $resultUserInfo['email']; ?></span>

                                        </div>
                                        <div class="d-flex justify-content-center">
                                             <h5 class="textColored">Type du compte : </h5><span class="lead"><?php echo $resultUserInfo['type']; ?></span>

                                        </div>
                         </div>
                         <div class="d-flex justify-content-center">
                              <h5 class="textColored">Ville : </h5><span class="lead"><?php echo $resultUserInfo['ville']; ?></span>

                         </div>
                         <h5 class="textColored">Numero de telephone:</h5> +229
                         <span><?php echo ' ' . $resultUserInfo['number']; ?></span><br>
                    <?php }
                                                  if ($resultUserInfo['type'] === 'Locataire') {  ?>
                         <br>
                         <h2 class="textColored">Demandes</h2>
                         <br>

                         <div class="allRequete p-0 py-2">
                              <?php
                                                       $requeteGetOffrre = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur= ? AND prenomAuteur=?');
                                                       $requeteGetOffrre->execute(array($resultUserInfo['id'], $resultUserInfo['nom'], $resultUserInfo['prenom']));
                                                       while ($resultatsGetOffre = $requeteGetOffrre->fetch()) {  ?>
                                   <div class="col-lg-6 col-md-8 col-sm-12 mt-3">
                                        <div class="card">

                                             <div class="card-header">
                                                  <h5 class="card-title"><?php echo $resultatsGetOffre['typeDemande']; ?></h5>
                                             </div>
                                             <div class="card-body">
                                                  <div class="d-flex justify-content-center text-left">
                                                       <h6 class="card-text">Chambre : </h6><span class=""><?php echo $resultatsGetOffre['typeDeChambre']; ?></span>
                                                  </div>
                                                  <div class="d-flex justify-content-center  text-left">
                                                       <h6 class="card-text">Quartier : </h6><span class=""><?php echo $resultatsGetOffre['quartier']; ?></span>
                                                  </div>
                                                  <div class="d-flex justify-content-center">
                                                       <h6 class="card-text">Paticularité : </h6><span class=""><?php echo $resultatsGetOffre['IndicationParticulaire']; ?></span>
                                                  </div>
                                                  <div class="d-flex justify-content-center">
                                                       <h6 class="card-text">Profile recherché : </h6><span class=""><?php echo $resultatsGetOffre['socialSituation']; ?></span>
                                                  </div>

                                                  <p class="card-text"></p>
                                                  <form action="notificationPlus.php" method="get">
                                                       <input name="idNotif" class="hide" type="text" value="<?php echo $resultatsGetOffre['id']; ?>">
                                                       <input name="idAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['idAuteur']; ?>">
                                                       <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['nomAuteur']; ?>">
                                                       <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['prenomAuteur']; ?>">
                                                       <input name="typeDeChambre" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDeChambre']; ?>">
                                                       <input name="quartier" class="hide" type="text" value="<?php echo $resultatsGetOffre['quartier']; ?>">
                                                       <input name="demande" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDemande']; ?>">
                                                       <input name="number" class="hide" type="text" value="<?php echo $resultUserInfo['number']; ?>">
                                                       <input name="prix" class="hide" type="text" value="<?php echo $resultatsGetOffre['prix']; ?>">
                                                       <input name="ville" class="hide" type="text" value="<?php echo $resultatsGetOffre['ville']; ?>">
                                                       <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $resultatsGetOffre['IndicationParticulaire']; ?>">
                                                       <input name="socialSituation" class="hide" type="text" value="<?php echo $resultatsGetOffre['socialSituation']; ?>">
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
                                        </div>
                                   </div>
                              <?php }
                              ?>
                         </div>
                    <?php  }
                                                  if ($resultUserInfo['type'] === 'Proprietaire') { ?>
                         <br>
                         <h2 class="text-primary">Offres</h2>
                         <br>
                         <div class="allRequete p-0">
                              <?php
                                                       $requeteGetOffrre = $bdd->prepare('SELECT * FROM offre WHERE idAuteur=? AND nomAuteur= ? AND prenomAuteur=?');
                                                       $requeteGetOffrre->execute(array($resultUserInfo['id'], $resultUserInfo['nom'], $resultUserInfo['prenom']));
                                                       while ($resultatsGetOffre = $requeteGetOffrre->fetch()) {  ?>
                                   <div class="col-lg-6 col-md-8 col-sm-12 my-2">
                                        <div class="card ">

                                             <div class="card-header">
                                                  <h5 class="card-title"><?php echo $resultatsGetOffre['typeDemande']; ?></h5>
                                             </div>
                                             <div class="card-body">
                                                  <div class="d-flex justify-content-center text-left">
                                                       <h6 class="card-text">Chambre : </h6><span class=""><?php echo $resultatsGetOffre['typeDeChambre']; ?></span>
                                                  </div>
                                                  <div class="d-flex justify-content-center  text-left">
                                                       <h6 class="card-text">Quartier : </h6><span class=""><?php echo $resultatsGetOffre['quartier']; ?></span>
                                                  </div>
                                                  <div class="d-flex justify-content-center">
                                                       <h6 class="card-text">Paticularité : </h6><span class=""><?php echo $resultatsGetOffre['IndicationParticulaire']; ?></span>
                                                  </div>
                                                  <div class="d-flex justify-content-center">
                                                       <h6 class="card-text">Profile recherché : </h6><span class=""><?php echo $resultatsGetOffre['socialSituation']; ?></span>
                                                  </div>

                                                  <p class="card-text"></p>
                                                  <form action="notificationPlus.php" method="get">
                                                       <input name="idNotif" class="hide" type="text" value="<?php echo $resultatsGetOffre['id']; ?>">
                                                       <input name="idAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['idAuteur']; ?>">
                                                       <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['nomAuteur']; ?>">
                                                       <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['prenomAuteur']; ?>">
                                                       <input name="typeDeChambre" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDeChambre']; ?>">
                                                       <input name="quartier" class="hide" type="text" value="<?php echo $resultatsGetOffre['quartier']; ?>">
                                                       <input name="demande" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDemande']; ?>">
                                                       <input name="number" class="hide" type="text" value="<?php echo $resultUserInfo['number']; ?>">
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
                                        </div>
                                   </div>
                         <?php }
                                                  } ?>

                         </div>
                         <br>
                         <br>
                         <h2 class="textColored text-primary">Publications</h2>
                         <br>

                         <div class="allRequete p-1">
                              <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                   <?php

$requeteGetPost = $bdd->prepare('SELECT COUNT(*) AS total  pulications WHERE idAuteur=? AND nomAuteur= ? AND prenomAuteur=?');
$requeteGetPost->execute(array($resultUserInfo['id'], $resultUserInfo['nom'], $resultUserInfo['prenom']));
$resultGetPost = $requeteGetPost->fetch();

if($resultGetPost['total'] < 0 ){
     echo ' <div class="text-center >"<p class="lead" >Vous n\'avez encor une publications a votre actif </p> <a class="text-primary" href="addPost.php">Faire un publications</a>';
 }

                                   $requeteGetPost = $bdd->prepare('SELECT * FROM pulications WHERE idAuteur=? AND nomAuteur= ? AND prenomAuteur=?');
                                   $requeteGetPost->execute(array($resultUserInfo['id'], $resultUserInfo['nom'], $resultUserInfo['prenom']));
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
                                                                      <div class="photo"><svg class="userSvgPosts" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" style="fill: #f8f9fa;" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                                                      48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                                                                         <div id="addPictures1" class="addPictures1" style="display:inline-block;">
                                                                      <p class="h5" style="margin: 0; display:inline-block;">
                                                                           <?php echo $resultGetPost['nomAuteur'] . ' ' . $resultGetPost['prenomAuteur'] ?></p>
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
                    <!-- <div class="copyLink">
<input type="text" class="hide" value="<?php echo  $resultUserInfo['short'];   ?>" id="link">
     <div id="copyButton" class="btnLink"><svg class="linkSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path style="fill: #2c2c2c;" d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"/></svg><h4 class="link">copiez le lien du profil.</h4></div>
</div> -->
                    <div class="d-flex mt-3 justify-content-center">
                         <div class="copyLink">
                              <input type="text" class="hide" id="link" value="<?php echo $resultUserInfo['short']; ?> " id="link ">
                              <div id="copyButton" class="btnLink"><svg class="mr-2" style="width:25px; height:25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path style="fill: #2c2c2c;" d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5
      0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 
      6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 
      0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3
       17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 
       289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 
       34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 
       244.3z" />
                                   </svg>
                                   <h4 style="display: inline-block; cursor:pointer;" class="link">copiez le lien du profil.</h4>
                              </div>
                         </div>
                    </div>
                    <form action="profile.php" class="text-center" method="get">
                         <a href="<?php if (isset($_GET['linkChatProfile'])) {
                                        echo $_GET['linkChatProfile'];
                                   } else {
                                        echo 'chatList.php';
                                   } ?>"> <button  class="btn btn-primary text-center">Retour ></button>
                              <!-- <button class="btn btn-primary">Aller voir</button> -->
                         </a>
                    </form>
                    </div>
                    <br>
                    <?php //} 
                    ?>
               </center>
               </div>
               <br>

               <script>
                    document.getElementById('copyButton').addEventListener('click', function() {
                         var textarea = document.getElementById('link');

                         if (textarea.value.trim() !== '') {
                              navigator.clipboard.writeText(textarea.value).then(function() {
                                   alert('Lien copié !');
                              }).catch(function(err) {
                                   console.error('Erreur lors de la copie dans le presse-papier : ', err);
                              });
                         } else {
                              alert('La zone de texte est vide.');
                         }
                    });
               </script>
     </body>

     </html>

<?php } else {
     header('location: home.php');
}
?>