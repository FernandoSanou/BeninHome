<?php
require('includes/require.php');

if (isset($_GET['signalement'])) {

     $requeteGetUserInfo = $bdd->prepare('SELECT * FROM user WHERE id = ? AND nom = ?');
     $requeteGetUserInfo->execute(array($_GET['idVictim'], $_GET['nomVictim']));
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
               /* .textColor {
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
                    padding: 20px 10px; 
                    border: 1px #9d9d9d solid;

                    border-radius: 5px;
               }

               .requete {
                    display: inline-block;
                    margin: 10px 0;
               }

               .button21 {
                    text-decoration: none;
                    border: none;
                    background: #7b58d9f0;
                    font-size: 1.1em;
                    color: #fffdfd;
                    padding: 5px 11px;
                    border-radius: 10px;
               }

               .button21:hover {
                    background: #7b58d99e;
                    color: #fffdfd;
               }

               textarea {
                    width: 193px;
               } */
               .images{
                              width:100px;
                              height:100px;
                              border-radius:50%;
                         }
                         .circle{
     width:90px;
     height:90px;
     border-radius:50%;
     background-color:#555;
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
                    <div class="mt-2">
                         <!-- <div class="circle"></div> -->
                         <?php

                         // Compter le nombre de questions de l'auteur
                         $requeteCountImage = $bdd->prepare('SELECT * FROM images WHERE raison=? AND idAuteur = ? AND nomAuteur = ? ');
                         $requeteCountImage->execute(array('profile',$_GET['idVictim'], $_GET['nomVictim']));
                         $imageCount = $requeteCountImage->fetch();

                         if (!isset($imageCount['bin'])) { ?>
                              <form action="userProfile.php" method="get">
                                   <button name="checkProfile" class="noBtn">
                                        <div class="circle"></div>
                                        <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomVictim']; ?>">
                                        <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idVictim']; ?>">
                                        <input name="linkChatProfile" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">

                                   </button>
                              </form>
                              <?php  } else {
                              $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE raison=? AND idAuteur = ? AND nomAuteur = ?  ORDER BY id DESC LIMIT 1  ');
                              $requeteGetImage->execute(array('profile',$_GET['idVictim'], $_GET['nomVictim']));
                              while ($result = $requeteGetImage->fetch()) { ?>

                                   <form action="userProfile.php" method="get">
                                        <button name="checkProfile" class="noBtn">
                                             <div class="image" onmouseover="showIcon();"><img class="images" src="<?php echo $result['bin']; ?>" alt="image"></div>
                                             <input name="linkChatProfile" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                             <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomVictim']; ?>">
                                             <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idVictim']; ?>">
                                             <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">

                                        </button>
                              <?php }
                         }  ?>
                                   </form>
                                   <h3 style="margin-top: 0;" class="nameUser">
                                        <?php echo $resultUserInfo['nom'] . ' ' . $resultUserInfo['prenom']; ?> </h3>
                                   <br>
                                   <p class="lead text-muted border-top"> Expliquez nous les raisons de son signalement</p>

                                   <form action="userChatProfile.php"  class="form-group" method="get">
                                        <select id="typeDeChambre" class="form-control" placeholder="Indication particuliaire" name="signalingRaison" required>
                                             <option value="Harcèlement">Harcèlement</option>
                                             <option value="Suicide ou automutilation">Suicide ou automutilation</option>
                                             <option value="Partage de contenu inappropriés">Partage de contenu inappropriés
                                             </option>
                                             <option value="Discours haineux">Discours haineux</option>
                                             <option value="Ventes non autorisées">Ventes non autorisées</option>
                                             <option value="Arnaque">Arnaque</option>
                                             <option value="Problème technique">Problème technique</option>
                                             <option value="Fausses information">Fausses information</option>
                                             <option value="Piratage">Piratage</option>
                                             <option value="autre non carrelé">autre</option>
                                          </select>
                                             <textarea class="form-control my-2" name="Commentaire" placeholder="Commentaire"></textarea>
                                             <input name="nomVictim" class="hide" type="text" value="<?php echo $_GET['nomVictim']; ?>">
                                             <input name="idVictim" class="hide" type="text" value="<?php echo $_GET['idVictim']; ?>">
                                      

                                        <button name="signaling" class="btn btn-md btn-block btn-primary">Aprouvez</button><br>
                                   </form>
                                   <br>
                                   <a style="text-decoration:none;" class="text-primary" href="<?php if(isset($_GET['linkChat'])){echo $_GET['linkChat'];}//else{ echo 'chatList.php'; } ?>">Retour</a>
                                   </form>
                    </div>
                    </center>
          </div>
          <?php //} 
          ?>
   
          </div>
          <br><br>

     </body>

     <?php
} else {
     if (isset($_GET['blocking'])) {
          $requete = $bdd->prepare('INSERT INTO blocked (idAuteur ,nomAuteur,idVictim , nomVictim,blockage) VALUES (?,?,?,?,?)');
          $requete->execute(array($_GET['idAuteur'], $_GET['nomAuteur'], $_GET['idVictim'], $_GET['nomVictim'], 'true'));
          header('location: chatList.php');
     } else {
          if (isset($_GET['checkProfile'])) {
               $requeteGetUserInfo = $bdd->prepare('SELECT * FROM user WHERE id = ? AND nom = ?');
               $requeteGetUserInfo->execute(array($_GET['idVictim'], $_GET['nomVictim']));
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
                         /* .textColor {
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
                              padding: 20px 10px; 
                              border: 1px #9d9d9d solid;

                              border-radius: 5px;
                         }

                       */

                         .circle{
     width:90px;
     height:90px;
     border-radius:50%;
     background-color:#555;
}
                         .images{
                              width:100px;
                              height:100px;
                              border-radius:50%;
                         }
                         svg.userSvg {
    height: 78px;
    width: 78px;
    margin-top: 22px;
    border-bottom-right-radius: 25px;
    border-bottom-left-radius: 25px;
}
path.userPath {
    fill: white;
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
                    <br>
                    <div class='container'>
                         <center>
                              <div class="profile">

                                   <!-- <div class="circle"></div> -->

                                   <?php

                                   // Compter le nombre de questions de l'auteur
                                   $requeteCountImage = $bdd->prepare('SELECT * FROM images WHERE raison=? AND idAuteur = ? AND nomAuteur = ? ');
                                   $requeteCountImage->execute(array('profile',$_GET['idVictim'], $_GET['nomVictim']));
                                   $imageCount = $requeteCountImage->fetch();

                                   if (!isset($imageCount['bin'])) { ?>
                                        <form action="userProfile.php" method="get">
                                             <button name="checkProfile" class="noBtn">
                                             <div class="circle"><svg class="userSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                             48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                                                  <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomVictim']; ?>">
                                                  <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idVictim']; ?>">
                                                  <input name="linkChatProfile" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                             </button>
                                        </form>
                                        <?php  } else {
                                        $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE raison=? AND idAuteur = ? AND nomAuteur = ?  ORDER BY id DESC LIMIT 1  ');
                                        $requeteGetImage->execute(array('profile',$_GET['idVictim'], $_GET['nomVictim']));
                                        while ($result = $requeteGetImage->fetch()) { ?>

                                             <form action="userProfile.php" method="get">
                                                  <button name="checkProfile" style="padding:0; margin:0;" class="noBtn">
                                                       <img class="images" src="<?php echo $result['bin']; ?>" alt="image">
                                                       <input name="linkChatProfile" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                                       <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomVictim']; ?>">
                                                       <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idVictim']; ?>">
                                                       <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">

                                                  </button>
                                        <?php }
                                   }  ?>
                                             </form>
                                             <h3 style="margin-top: 0;" class="nameUser">
                                                  <?php echo $resultUserInfo['nom'] . ' ' . $resultUserInfo['prenom']; ?></h3>
                                             <form action="userChatProfile.php" method="get">
                                                  <input name="idVictim" class="hide" type="text" value="<?php echo $_GET['idVictim']; ?>">
                                                  <input name="nomVictim" class="hide" type="text" value="<?php echo $_GET['nomVictim']; ?>">
                                                  <input name="idAuteur" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
                                                  <input name="nomAuteur" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
                                                  <?php
                                                  $requeteGetBlockage = $bdd->prepare('SELECT * FROM blocked WHERE idAuteur = ? AND nomAuteur = ? AND idVictim=? AND nomVictim=? OR idAuteur = ? AND nomAuteur = ? AND idVictim=? AND nomVictim=?');
                                                  $requeteGetBlockage->execute(array($_GET['idAuteur'], $_GET['nomAuteur'], $_GET['idVictim'], $_GET['nomVictim'], $_GET['idVictim'], $_GET['nomVictim'], $_GET['idAuteur'], $_GET['nomAuteur']));
                                                  $resultGetBlockage = $requeteGetBlockage->fetch();
                                                  if ($resultGetBlockage['idAuteur'] == $_SESSION['id'] && $resultGetBlockage['nomAuteur'] == $_SESSION['nom']) { ?>
                                                       <button name="deblocking" class="btn btn-primary btn-md">Dèblockez</button>
                                                  <?php  } else { ?>
                                                       <button name="blocking" class="btn btn-primary btn-md">Blockez</button>
                                                  <?php } ?>
                                                  <button name="signalement" class="btn btn-primary btn-md">Signalez</button><br>
                                             </form>
                                             <br>
                                             <a style="color:#555;" class="out text-primary" style="text*text-decoration: none;" href="<?php if(isset($_GET['linkChat'])){echo $_GET['linkChat'];}//else{ echo 'chatList.php'; } ?>">Retour</a>
                                             </form>
                              </div>
                    </div>
                    <?php //} 
                    ?>
                    </center>
                    </div>
                
               </body>

               </html>

               <?php } else {
               if (isset($_GET['deblocking'])) {
                    $requeteProcessDeblockage = $bdd->prepare('DELETE FROM blocked WHERE idAuteur=? AND nomAuteur=? AND idVictim=? AND nomVictim=?');
                    $requeteProcessDeblockage->execute(array($_SESSION['id'], $_SESSION['nom'], $_GET['idVictim'], $_GET['nomVictim']));
                    header('location: chatList.php');
               } else {
                    if (isset($_GET['signaling'])) {
                         $date = date('d/m/Y');
                         $requete = $bdd->prepare('INSERT INTO signalement( idAuteur, nomAuteur, idVictim, nomVictim, raison, commentaire, date) VALUES (?,?,?,?,?,?,?)');
                         $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_GET['idVictim'], $_GET['nomVictim'], $_GET['signalingRaison'], $_GET['Commentaire'], $date));
                         header('location: userChatProfile.php?idVictim=' . $_GET['idVictim'] . '&nomVictim=' . $_GET['nomVictim'] . '&alreadySaligned=true');
                    } else {
                         if (isset($_GET['alreadySaligned'])) {
                              $requeteGetUserInfo = $bdd->prepare('SELECT * FROM user WHERE id = ? AND nom = ?');
                              $requeteGetUserInfo->execute(array($_GET['idVictim'], $_GET['nomVictim']));
                              $resultUserInfo = $requeteGetUserInfo->fetch();
               ?>
                              <!DOCTYPE html>
                              <html lang="fr">

                              <head>
                                   <meta charset="UTF-8">
                                   <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                   <title>getJOB</title>
                                   <style>
                                       
                                   </style>

                                   <?php

                                   $requeteGetVictimInfo = $bdd->prepare('SELECT * FROM  user WHERE id=? AND nom=?');
                                   $requeteGetVictimInfo->execute(array($_GET['idVictim'], $_GET['nomVictim']));
                                   $resultsGetModeVictimInfo = $requeteGetVictimInfo->fetch();

                                   $requeteGetMode = $bdd->prepare('SELECT * FROM  user WHERE id=? AND nom=?');
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
                                   <br><br>
                                   <div class='container text-center'>
                                             <p class="text-center  lead">L'utilisateur : <?php echo $_GET['nomVictim'] . ' ' . $resultsGetModeVictimInfo['prenom']; ?>
                                                  sera
                                                  soumis à une
                                                  analyse compléte afin de juger si il y aura lieu d'une sanction</p>
                                             <a href="chatList.php" class="text-center text-primary" style="text-decoration:none;">Retour</a>
                                 
                                   </div>
                                   <br>


                                   <script type="text/javascript">
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
                                   </script>
                              </body>

                              </html>


<?php    } else {
                              header('location: home.php');
                         }
                    }
               }
          }
     }
}
?>