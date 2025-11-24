<?php require('includes/require.php'); ?>
<?php
// Redirection de la modification
$raison = 'profile';

// Vérification si les paramètres GET existent
if (isset($_GET['nomCorrespondant'])) {
     // Récupération des paramètres GET
     $nomCorrespondant = $_GET['nomCorrespondant'];
     $idCorrespondant = $_GET['idCorrespondant'];

     // Récupération des informations du correspondant
     $requeteGetAnyCorrespondantInfo = $bdd->prepare('SELECT * FROM chat WHERE nomMessager=? AND idMessager=? OR idMessager=? AND idCorrespondant=?');
     $requeteGetAnyCorrespondantInfo->execute(array($_GET['nomCorrespondant'], $_SESSION['id'], $_SESSION['id'], $_GET['idCorrespondant']));
     $resultatsGetAnyInfos = $requeteGetAnyCorrespondantInfo->fetch();

     // Vérifier si le chat n'a jamais été créé

     if (isset($_GET['chatMessage'])) {
          $requete = $bdd->prepare('SELECT COUNT(*) AS x FROM chat WHERE idMessager=? AND idCorrespondant=? OR idMessager=? AND idCorrespondant=?');
          $requete->execute(array($_GET['idCorrespondant'], $_SESSION['id'], $_SESSION['id'], $_GET['idCorrespondant']));

          while ($result = $requete->fetch()) {
               if ($result['x']) {
                    $date = date('d-m-Y H:i');
                    $message = $_GET['message'];
                    $requete = $bdd->prepare('INSERT INTO messages(idAuteur ,nomAuteur,prenomAuteur,idCorrespondant , nomCorrespondant, prenomCorrespondant, message, date) VALUES (?,?,?,?,?,?,?,?)');
                    $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_GET['idCorrespondant'], $_GET['nomCorrespondant'], $_GET['prenomCorrespondant'], $_GET['message'], $date));
                    $dateMessage = date('d-m-Y H:i');
                    $requete = $bdd->prepare('UPDATE chat SET lastMessage=? ,date=? WHERE idMessager=? AND nomAuteurMessager=? AND idCorrespondant=? AND nomCorrespondant=?');
                    $requete->execute(array($_GET['message'], $dateMessage, $_SESSION['id'], $_SESSION['nom'], $_GET['idCorrespondant'], $_GET['idCorrespondant'], $_GET['nomCorrespondant']));
                    header('location: chat.php?nomAuteur=' . $_SESSION['nom'] . '&prenomAuteur=' . $_SESSION['prenom'] . '&idAuteur='
                         . $_SESSION['id'] . '&nomMessager=' . $_SESSION['nom'] . '&prenomMessager=' . $_SESSION['prenom'] . '&idMessager='
                         . $_SESSION['id'] . '&idCorrespondant=' . $_GET['idCorrespondant'] . '&nomCorrespondant=' . $_GET['nomCorrespondant'] . '&prenomCorrespondant=' . $_GET['prenomCorrespondant'] . '&idChat=' . $_GET['idChat'] . '&verification=true');
               } else {
                    // Création d'un nouveau chat
                    $date = date('d-m-Y H:i');
                    $requete = $bdd->prepare('INSERT INTO chat(nomMessager,prenomMessager, idMessager, nomCorrespondant, prenomCorrespondant, idCorrespondant, date) VALUES(?,?,?, ?, ?, ?, ?)');
                    $requete->execute(array($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['id'], $_GET['nomCorrespondant'], $_GET['prenomCorrespondant'], $_GET['idCorrespondant'], $date));
                    $requete = $bdd->prepare('INSERT INTO messages(idAuteur ,nomAuteur,prenomAuteur,idCorrespondant , nomCorrespondant, prenomCorrespondant, message, date) VALUES (?,?,?,?,?,?,?,?)');
                    $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_GET['idCorrespondant'], $_GET['nomCorrespondant'], $_GET['prenomCorrespondant'], $_GET['message'], $date));
                    $dateMessage = date('d-m-Y H:i');
                    $requete = $bdd->prepare('UPDATE chat SET lastMessage=? ,date=? WHERE idMessager=? AND nomAuteurMessager=? AND idCorrespondant=? AND nomCorrespondant=?');
                    $requete->execute(array($_GET['message'], $dateMessage, $_SESSION['id'], $_SESSION['nom'], $_GET['idCorrespondant'], $_GET['idCorrespondant'], $_GET['nomCorrespondant']));
                    header('location: chat.php?nomAuteur=' . $_SESSION['nom'] . '&prenomAuteur=' . $_SESSION['prenom'] . '&idAuteur='
                         . $_SESSION['id'] . '&nomMessager=' . $_SESSION['nom'] . '&prenomMessager=' . $_SESSION['prenom'] . '&idMessager='
                         . $_SESSION['id'] . '&idCorrespondant=' . $_GET['idCorrespondant'] . '&nomCorrespondant=' . $_GET['nomCorrespondant'] . '&prenomCorrespondant=' . $_GET['prenomCorrespondant'] . '&idChat=' . $_GET['idChat'] . '&verification=true');
               }
          }
     }

     $requete = $bdd->prepare('SELECT COUNT(*) AS x FROM chat WHERE nomMessager=? AND idMessager=? OR idMessager=? AND idCorrespondant=?');
     $requete->execute(array($_GET['nomCorrespondant'], $_SESSION['id'], $_SESSION['id'], $_GET['idCorrespondant']));

     while ($result = $requete->fetch()) {
          if ($result['x'] == 0) {
               // Vérifier si un chat n'a pas été lancé avec $_GET['idChat']
               if (isset($_GET['idChat'])) {
                    $requete = $bdd->prepare('SELECT COUNT(*) AS x FROM chat WHERE idMessager=? AND idCorrespondant=? OR idMessager=? AND idCorrespondant=?');
                    $requete->execute(array($_GET['idCorrespondant'], $_SESSION['id'], $_SESSION['id'], $_GET['idCorrespondant']));

                    while ($result = $requete->fetch()) {
                         if ($result['x']) {
                              // Redirection vers le chat existant
                              //     header('Location: chat.php?idMessager=' . $_SESSION['id'] . '&idCorrespondant=' . $_GET['idCorrespondant']);
                         } else {
                              // Création d'un nouveau chat
                              $date = date('d-m-Y H:i');
                              $requete = $bdd->prepare('INSERT INTO chat(nomMessager,prenomMessager, idMessager, nomCorrespondant, prenomCorrespondant, idCorrespondant, date) VALUES(?,?,?, ?, ?, ?, ?)');
                              $requete->execute(array($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['id'], $_GET['nomCorrespondant'], $_GET['prenomCorrespondant'], $_GET['idCorrespondant'], $date));
                              // Redirection vers le nouveau chat
                              //     header('Location: chat.php?idMessager=' . $_SESSION['id'] . '&idCorrespondant=' . $_GET['idCorrespondant']);
                         }
                    }
               }
          } else {
               //

          }
     }
}

//      $requeteGetChat= $bdd->prepare('SELECT * FROM chat WHERE nomMessager=? AND idMessager=? AND nomCorrespondant=? AND idCorrespondant=?');
//      $requeteGetChat->execute(array($_SESSION['nom'],$_SESSION['id'],$_GET['nomCorrespondant'],$idCorrespondant));
//   $resultats = $requeteGetChat->fetch();
// condition pour verifie si il y pas deja ete enresgistrer dans la base de donnes

// if($resultats['nomMessager'] === $_SESSION['nom'] && $resultats['idMessager'] === $_SESSION['id'] && 
// $resultats['nomCorrespondant'] === $nomCorrespondant && $resultats['idCorrespondant'] === $idCorrespondant ){

// pour changer les noms des variable get

// if(isset($_GET['nomAuteur'])){

//    //('location: chat.php?idChat=true&idCorrespondant='.$_GET['idCorrespondant'].'&nomCorrespondant='.$_GET['nomCorrespondant'].'&prenomCorrespondant='.$_GET['prenomCorespondant'].'&verification=true');

// }
//    if(isset($_GET['chat'])){
//    $date = date('d-m-Y H:i');
//    $requete = $bdd->prepare('INSERT INTO chat(nomMessager, idMessager, nomCorrespondant, idCorrespondant, date) VALUES(?, ?, ?, ?, ?)');
//    $requete->execute(array($_SESSION['nom'],$_SESSION['id'], $_GET['nomAuteur'], $_GET['idAuteur'], $date));
//    //('location: chat.php?idChat=true&idCorrespondant='.$_GET['idCorrespondant'].'&nomCorrespondant='.$_GET['nomCorrespondant'].'&prenomCorrespondant='.$_GET['prenomCorespondant'].'&verification=true&truc=bien fait');

// }
//    }





// if(isset($_GET['nomAuteur']) || isset($_GET['prenomAuteur'])){

//    //('location: chat.php?idChat=true&idCorrespondant='.$_GET['idCorrespondant'].'&nomCorrespondant='.$_GET['nomCorrespondant'].'&prenomCorrespondant='.$_GET['prenomCorespondant'].'&verification=true');

// }

if (isset($_GET['seeImage'])) {

     //('location: seeImage.php?seeImage=true&image=' . $_GET['images'] . '&nomAuteur=' . $_GET['nomAuteur'] . '&idAuteur=' . $_GET['idAuteur']);
}


?>



<!DOCTYPE html>
<html lang="fr">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
     <title>BéniHome</title>

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
     <style>
          body {
               overflow-y: auto;
          }

          .button20 {
               width: 320px;
          }

          .imagesPhoto {
               width: 40px;
               height: 40px;
               border-radius: 25%;
          }

          .photo {
               width: 40px;
               height: 40px;
               background: #0d6efd;
               border-radius: 30%;
          }

          .hide {
               visibility: hidden;
               display: none;
          }
          svg.userSvg {
    height: 36px;
    margin-top: 3.7px;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
    width: 40px;
}
path.userPath {
    fill: white;
}
     </style>
</head>

<body class="homePage">
     <?php require('includes/navbar.php');

     ?>
     <!-- 


 -->
     <br>
     <div class='container'>
          <div class="notificationText">
               <h3 class="textColored1">Chat liste</h3>
          </div>
          <?php

          $requeteGetChat = $bdd->prepare('SELECT * FROM chat WHERE nomMessager =? AND idMessager=? OR nomCorrespondant=? AND idCorrespondant=? ORDER BY date DESC');
          $requeteGetChat->execute(array($_SESSION['nom'], $_SESSION['id'], $_SESSION['nom'], $_SESSION['id']));
          while ($resultats = $requeteGetChat->fetch()) {
               if ($resultats['nomMessager'] == $_SESSION['nom'] && $resultats['idMessager'] == $_SESSION['id'] && $resultats['nomCorrespondant'] == $_SESSION['nom'] && $resultats['idCorrespondant'] == $_SESSION['id']) {
                    $requeteDeleteting = $bdd->prepare('DELETE FROM chat WHERE nomMessager =? AND idMessager=? AND nomCorrespondant=? AND idCorrespondant=?');
                    $requeteDeleteting->execute(array($_SESSION['nom'], $_SESSION['id'], $_SESSION['nom'], $_SESSION['id']));
                    header('location: chatList.php');
               }
               if ($resultats['nomMessager'] == $_SESSION['nom'] && $resultats['idMessager'] == $_SESSION['id']) {
                    $requeteGetUserInfos = $bdd->prepare('SELECT * FROM user WHERE id=?');
                    $requeteGetUserInfos->execute(array($resultats['idCorrespondant']));

                    $resultatinfo = $requeteGetUserInfos->fetch();
                    //   recuperation de la derniers question du chat
                    $requeteGetThelastedMessage = $bdd->prepare('SELECT * FROM messages WHERE idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=? 
         OR idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=?  ORDER BY id DESC LIMIT 1');
                    $requeteGetThelastedMessage->execute(array(
                         $_SESSION['id'], $_SESSION['nom'],
                         $resultatinfo['id'], $resultatinfo['nom'],
                         $resultatinfo['id'], $resultatinfo['nom'],
                         $_SESSION['id'], $_SESSION['nom']
                    ));
                    $resultatsGetThelastedMessage = $requeteGetThelastedMessage->fetch();
                    $lastMessage = $resultatsGetThelastedMessage['message'];
          ?>
                    <form action="chat.php" class="form5 border-top border-bottom" <?php if (empty($resultatsGetThelastedMessage['message'])) { ?>style="" <?php } ?> method="get">
                    <button style="width:100%;" class="noBtn px-0" style="border-top border-bottom; width:100%;" <?php if (empty($resultatsGetThelastedMessage['message'])) { ?>style="color: #1e1d1d;font-size: 1.0em;" <?php } ?>>
                              <!-- pour la photo de profile d'un utilisateur -->
                              <div class="d-flex justify-content-between align-items-center py-2">


                                   <div class="headPhotochat mr-1" style="width: 40px;">
                                        <?php
                                        $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? AND raison=?');
                                        $requeteCountImage->execute(array($resultats['idCorrespondant'], $resultats['nomCorrespondant'],'profile'));
                                        $imageCount = $requeteCountImage->fetch()['image_count'];
                                        if ($imageCount == 0) { ?> 
                                             <div class="photo"><svg class="userSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                             48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>  </div>
                                             <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultats['nomCorrespondant']; ?>">
                                             <input name="idAuteur" class="hide" type="text" value="<?php echo $resultats['idCorrespondant']; ?>">
 
                                             <?php  } else {
                                             $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE raison = ? AND idAuteur = ? ORDER BY id DESC LIMIT 1  ');
                                             $requeteGetImage->execute(array('profile', $resultats['idCorrespondant']));
                                             while ($result = $requeteGetImage->fetch()) { ?>


                                                  <img class="imagesPhoto" src="<?php echo $result['bin']; ?>" alt="image">
                                                  <input type="text" class="hide" value="<?php echo $result['bin']; ?>">
                                                  <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultats['prenomCorrespondant']; ?>">
                                                  <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultats['nomCorrespondant']; ?>">
                                                  <input name="idAuteur" class="hide" type="text" value="<?php echo $resultats['idCorrespondant']; ?>">
                                                  <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">

                                        <?php }
                                        }
                                        $requeteGetStatus = $bdd->prepare('SELECT online FROM user WHERE id = ? AND nom = ? ');
                                        $requeteGetStatus->execute(array($resultats['idCorrespondant'], $resultats['nomCorrespondant']));
                                        $resultatsGetStatus = $requeteGetStatus->fetch();

                                        if ($resultatsGetStatus['online'] == 'true') {
                                             echo ' <div class="status"></div>';
                                        }
                                        ?>
                                        <!-- </button>
                        <button class="button20"> -->

                                   </div>

                                   <div class="headChatInfo ml-1" style="text-align: left;width: 80%;display: inline-block; padding-top: 5px;
    color: #555;">
                                        <h5 class="py-0 my-0"><?php echo $resultats['nomCorrespondant'] . ' ' . $resultatinfo['prenom'] . ' '; ?>
                                        </h5>
                                        <?php if (isset($lastMessage)) {
                                             if ($resultatsGetThelastedMessage['vueCorrespondant'] == 'false') {
                                                  $vueFalse = 'false';
                                                  $requeteCountMessage = $bdd->prepare('SELECT COUNT(*) AS message_count FROM messages WHERE vueCorrespondant =? AND idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=?');
                                                  $requeteCountMessage->execute(array(
                                                       $vueFalse,
                                                       $resultatinfo['id'], $resultatinfo['nom'],
                                                       $_SESSION['id'], $_SESSION['nom']
                                                  ));
                                                  while ($message_count = $requeteCountMessage->fetch()['message_count']) {

                                                        if (empty($lastMessage)) {  ?>
                                                            <small class="specialSmall1">Aucun méssage</small>
                                                       <?php       }
                                                       ?>

                                                       <span class="newMessage rounded bg-danger text-light px-1"><?php echo $message_count;
                                                                           }  ?></span>
                                                       <small class="specialSmall1"><?php echo substr($lastMessage, 0, 20) . "..."; ?></small>
                                                  <?php
                                             } else { ?>

                                                       <small class="specialSmall"><?php echo substr($lastMessage, 0, 20) . "..."; ?></small>
                                             <?php }
                                        } else {
                                             echo '<small class="specialSmall1">Aucun méssage</small>';
                                        } ?>

                                             <?php
                                             ?>
                                   </div>
                                   <?php
                                   $oldDate = $resultats['date'];
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
                                   <div class="justify-content-right" style="width:30px;"> <small class="small2 py-0 my-0" ><?php echo $tempsEcoule; ?></small></span>
                                   </div>
                              </div>

                              <input name="idChat" class="hide" type="text" value="<?php echo $resultats['id']; ?>">
                              <input name="nomMessager" class="hide" type="text" value="<?php echo $resultats['nomMessager']; ?>">
                              <input name="prenomMessager" class="hide" type="text" value="<?php echo $_SESSION['prenom']; ?>">
                              <input name="idMessager" class="hide" type="text" value="<?php echo $resultats['idMessager']; ?>">
                              <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultats['nomCorrespondant']; ?>">
                              <input name="idCorrespondant" class="hide" type="text" value="<?php echo $resultats['idCorrespondant']; ?>">
                              <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $resultatinfo['prenom']; ?>">
                              <input name="date" class="hide" type="text" value="<?php echo $resultats['date']; ?>">
                              <input name="idChat" class="hide" type="text" value="<?php echo $resultats['id']; ?>">
                              <input name="verification" class="hide" type="text" value="true">


                         </button>
                    </form>

               <?php }
               if ($resultats['nomCorrespondant'] == $_SESSION['nom'] && $resultats['idCorrespondant'] == $_SESSION['id']) {
                    $requeteGetUserInfos = $bdd->prepare('SELECT * FROM user WHERE id=?');
                    $requeteGetUserInfos->execute(array($resultats['idMessager']));

                    $resultatinfo = $requeteGetUserInfos->fetch();



                    //   recuperation de la derniers question du chat
                    $requeteGetThelastedMessage = $bdd->prepare('SELECT * FROM messages WHERE idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=? 
         OR idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=?  ORDER BY id DESC LIMIT 1');
                    $requeteGetThelastedMessage->execute(array(
                         $resultatinfo['id'], $resultatinfo['nom'],
                         $_SESSION['id'], $_SESSION['nom'],
                         $_SESSION['id'], $_SESSION['nom'],
                         $resultatinfo['id'], $resultatinfo['nom']
                    ));
                    $resultatsGetThelastedMessage = $requeteGetThelastedMessage->fetch();
                    $lastMessage = $resultatsGetThelastedMessage['message'];
               ?>
                    <form action="chat.php" class="form5 border-top border-bottom" method="get">
                         <button style="width:100%;" class="noBtn px-0" style="border-top border-bottom; width:100%;" <?php if (empty($resultatsGetThelastedMessage['message'])) { ?>style="color: #1e1d1d;font-size: 1.0em;" <?php } ?>>
                              <!-- pour la photo de profile d'un utilisateur -->
                              <div class="d-flex justify-content-between align-items-center py-2">


                                   <div class="headPhotochat mr-1" style="width: 40px;">
                                        <?php
                                        $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? AND raison=?');
                                        $requeteCountImage->execute(array($resultats['idMessager'], $resultats['nomMessager'],'profile'));
                                        $imageCount = $requeteCountImage->fetch()['image_count'];

                                        if ($imageCount == 0) { ?> 
                                             <div class="photo"><svg class="userSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                             48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>  </div>
                                             <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultats['nomMessager'] ?>">
                                             <input name="idAuteur" class="hide" type="text" value="<?php echo $resultats['idMessager']; ?>">
                                             <!-- </button> -->
                                             <?php  } else {
                                             $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE raison=? AND idAuteur = ? ORDER BY id DESC LIMIT 1  ');
                                             $requeteGetImage->execute(array('profile', $resultats['idMessager']));
                                             while ($result = $requeteGetImage->fetch()) { ?>
                                                  <!-- <button name="checkProfile" class="button10"> -->
                                                  <img class="imagesPhoto" src="<?php echo $result['bin']; ?>" alt="image">
                                                  <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultats['prenomMessager'] ?>">
                                                  <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultats['nomMessager'] ?>">
                                                  <input name="idAuteur" class="hide" type="text" value="<?php echo $resultats['idMessager']; ?>">
                                                  <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">

                                        <?php }
                                        }
                                        $requeteGetStatus = $bdd->prepare('SELECT * FROM user WHERE id = ? AND nom = ? ');
                                        $requeteGetStatus->execute(array($resultats['idMessager'], $resultats['nomMessager']));
                                        $resultatsGetStatus = $requeteGetStatus->fetch();

                                        if ($resultatsGetStatus['online'] == 'true') {
                                             echo ' <div class="status"></div>';
                                        }
                                        ?>

                                   </div>
                                   <div class="headChatInfo ml-1" style="text-align: left;width: 80%;display: inline-block; padding-top: 5px;
    color: #555;">

                                        <h5><?php echo $resultats['nomMessager'] . ' ' . $resultatinfo['prenom'] . ' '; ?>
                                        </h5>
                                        <div class=""></div>
                                        <?php
                                        if (isset($lastMessage)) {
                                             if ($resultatsGetThelastedMessage['vueCorrespondant'] == 'false') {
                                                  $vueFalse = 'false';
                                                  $requeteCountMessage = $bdd->prepare('SELECT COUNT(*) AS message_count FROM messages WHERE vueCorrespondant =? AND  idCorrespondant =? AND nomCorrespondant=?AND idAuteur=? AND nomAuteur=? ');
                                                  $requeteCountMessage->execute(array(
                                                       $vueFalse, $_SESSION['id'], $_SESSION['nom'],
                                                       $resultatinfo['id'], $resultatinfo['nom']

                                                  ));
                                                  while ($message_count = $requeteCountMessage->fetch()['message_count']) {
                                        ?>
                                                       <?php

                                                       if (empty($lastMessage)) {  ?>
                                                            <small class="specialSmall1">Aucun méssage</small>
                                                       <?php       }
                                                       ?>
                                                       <span class="newMessage rounded bg-danger text-light px-1"><?php echo $message_count;
                                                                           }  ?></span>
                                                       <small class="specialSmall1"><?php echo substr($lastMessage, 0, 20) . "...";  ?></small>
                                                  <?php
                                             } else { ?>
                                                       <small class="specialSmall"><?php echo substr($lastMessage, 0, 20) . "..."; ?></small>
                                             <?php  }
                                        } else {
                                             echo '<small class="specialSmall1">Aucun méssage</small>';
                                        }  ?>
                                   </div>
                                   <?php
                                   $oldDate = $resultats['date'];
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
                                   <div class="justify-content-right" style="width:30px;"> <small class="small2 py-0 my-0" ><?php echo $tempsEcoule; ?></small></span>
                                   </div>
                                   <input name="idChat" class="hide" type="text" value="<?php echo $resultats['id']; ?>">
                                   <input name="nomMessager" class="hide" type="text" value="<?php echo $resultats['nomMessager']; ?>">
                                   <input name="prenomMessager" class="hide" type="text" value="<?php echo $resultatinfo['prenom']; ?>">
                                   <input name="idMessager" class="hide" type="text" value="<?php echo $resultats['idMessager']; ?>">
                                   <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultats['nomCorrespondant']; ?>">
                                   <input name="idCorrespondant" class="hide" type="text" value="<?php echo $resultats['idCorrespondant']; ?>">
                                   <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_SESSION['prenom']; ?>">
                                   <input name="date" class="hide" type="text" value="<?php echo $resultats['date']; ?>">
                                   <input name="idChat" class="hide" type="text" value="<?php echo $resultats['id']; ?>">
                                   <input name="verification" class="hide" type="text" value="true">

                              </div>
                         </button>
                    </form>

          <?php   }
          } ?>

          <?php
          // session des signalement pour l'administracteur du site
          if (isset($_SESSION['adminer'])) {
               if ($_SESSION['adminer'] === 'theBoss') {
                    if ($_SESSION['nom'] == 'SANOU' && $_SESSION['prenom'] == 'Fernando' && $_SESSION['number'] == '60421373') {
          ?>

                         <!-- <form action="chat.php" method="get" class="form5"> -->
                         <?php
                         $requeteGetSignalement = $bdd->prepare('SELECT * FROM signalement ORDER BY id LIMIT 1');
                         $requeteGetSignalement->execute(array($_SESSION['id']));
                         $resultatsGetThelastedSignalement = $requeteGetSignalement->fetch();

                         ?>
                         <form action="chat.php" class="form5 border-top border-bottom" method="get">

                              <button style="width:100%;" class="noBtn">
                                   <!-- pour la photo de profile d'un utilisateur -->
                                   <div class="d-flex justify-content-between align-items-center py-2">
                                        <div  class="justify-content-left">
                                        <div class="headPhotochat" style="display: inline-block;">
                                             <!-- <button name="checkProfile" class="button10"> -->
                                             <div class="photo bg-danger"> </div>
                                        </div>
                                        <div class="headChatInfo" style="display: inline-block;">
                                                  <h4>Signalements</h4>
                                                  <?php
                                                  if ($resultatsGetThelastedSignalement['vueAdmin'] == 'false') {
                                                       $vueFalse = 'false';
                                                       $requeteCountSignalement = $bdd->prepare('SELECT COUNT(*) AS signalement_count FROM signalement WHERE vueAdmin=?');
                                                       $requeteCountSignalement->execute(array($vueFalse));
                                                       while ($Signalement_count = $requeteCountSignalement->fetch()['signalement_count']) {
                                                  ?>
                                                            <small class="px-2 rounded-5 bg-secondary text-light"><?php echo $Signalement_count;
                                                                 }  ?></small>
                                                            <small class="specialSmall1"><?php echo substr($resultatsGetThelastedSignalement['commentaire'], 0, 15) . "...";  ?></small>
                                                       <?php
                                                  } else { ?>
                                                            <small class="specialSmall"><?php echo substr($resultatsGetThelastedSignalement['commentaire'], 0, 15) . "..."; ?></small>
                                                       <?php  } ?>
                                             </div>
                                        </div>
                                        <div class="justify-content-right">


                                             <small class="small2"><?php echo $resultatsGetThelastedSignalement['date']; ?></small></span>

                                             <input name="signalmentChatByTtheAdminer" class="hide" type="text" value="true">
                                             <input name="verification" class="hide" type="text" value="true">

                                        </div>
                                   </div>
                              </button>
     </div>
     </form>
     </div>

<?php
                    }
               }
          }
?>

</div>

</body>

</html>