<?php require('includes/require.php');
if (isset($_GET['link'])) {
     header('location: ' . $_GET['link']);
     echo 'azertyuf';
}

$requetegetnotif=$bdd->prepare('SELECT * FROM notification WHERE idVictim=? AND nomVictim=? AND prenomVictim=?');
$requetegetnotif->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom']));
while($resultGetNotif= $requetegetnotif->fetch()){
     // echo 'id : '.$resultGetNotif['idVictim'].'<br>';
$requete = $bdd->prepare('UPDATE notification SET globalView=? WHERE idVictim=? AND nomVictim=? AND prenomVictim=?');
$requete->execute(array('true',$_SESSION['id'],$_SESSION['nom'],$_SESSION['prenom']));
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
     </style>
     <?php if (isset($_GET['message'])) {
     ?>
          <style>
               body {
                    overflow-y: auto;
               }
          </style>
     <?php
     }
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
          p,
          h3,
          h4,
          h5,
          h6,
          div {
               margin: 0px;
               padding: 0px;
          }

          .type {
               margin-right: 7px;
               width: 25px;
               height: 25px;
               border-radius: 56%;
          }

          .typep {
               background-color: #20c997;
          }

          .typec {
               background-color: #0d6efd;
          }

          .typed {
               background-color: #fd7e14;
          }

          .typeo {
               background-color: #dc3545;
          }
     </style>
</head>

<body class="homePage">
     <?php
     require('includes/navbar.php');

     ?>
     <br>
     <?php if (isset($_GET['message'])) { ?>
          <div class='container'>
               <h3 class="text-lead muted text-center"><?php echo $_GET['message']; ?></h3>
          </div><?php } ?>
     <div class='container' style="color:#555;">
          <h3 class="text-left ">Notifications</h3>
          <?php
          $requete = $bdd->prepare('SELECT * FROM notification WHERE idVictim=? AND nomVictim =? AND prenomVictim=? ORDER BY id DESC');
          $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom']));
          while ($resultatsGetNotif = $requete->fetch()) {

               if($_SESSION['type']=='Locataire'){  
                    
                    if ($resultatsGetNotif['type'] === 'offre') {
                    
                         
                    }else{

                     ?>

                    <div class="list-group list-group-radio d-grid gap-2 border-0 w-auto">
                         <div class="position-relative">
                              <!-- <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="te" name="listGroupRadioGrid" id="listGroupRadioGrid1" value="" checked> -->
                              <a href="<?php echo $resultatsGetNotif['link'] . '&viewNotif=true&idNotif=' . $resultatsGetNotif['id']; ?>" style="text-decoration:none;">
                                   <label class="list-group-item py-3 pe-3 rounded-3 px-sm-1 " for="listGroupRadioGrid1" <?php if ($resultatsGetNotif['view'] == 'false') {
                                                                                                                                  echo 'style="background:#e9ecef;"';
                                                                                                                             } ?>>
                                        <div class="d-flex justify-content-between align-items-center">
                                             <div class="d-flex justify-content-left align-items-center">
                                                  <?php
                                                  if ($resultatsGetNotif['type'] === 'demande') {
                                                       echo '<div class="type typed mr-1"></div>';
                                                  }
                                                  if ($resultatsGetNotif['type'] === 'Publication') {
                                                       echo '<div class="type typep mr-1"></div>';
                                                  }
                                                  if ($resultatsGetNotif['type'] === 'commentaires') {
                                                       echo '<div class="type typec mr-1"></div>';
                                                  }

                                                  ?>
                                                  <div>
                                                       <h5 style="margin:0px;" class="fw-semibold"><?php
                                                                                                    if ($resultatsGetNotif['type'] === 'demande') {
                                                                                                         echo 'Demandes';
                                                                                                    }
                                                                                                    if ($resultatsGetNotif['type'] === 'Publication') {
                                                                                                         echo 'Publications';
                                                                                                    }
                                                                                                    if ($resultatsGetNotif['type'] === 'commentaires') {
                                                                                                         echo 'Commentaires';
                                                                                                    }

                                                                                                    ?></h5>
                                                       <p class="d-block my-0 py-0 opacity-75">
                                                            <?php
                                                            if ($resultatsGetNotif['type'] === 'demande') {
                                                                 echo 'Votre demande est en cour de recherche d\'offre';
                                                            }
                                                            if ($resultatsGetNotif['type'] === 'Publication') {
                                                                 echo 'Votre post à été publié';
                                                            }
                                                            if ($resultatsGetNotif['type'] === 'commentaires') {
                                                                 echo $resultatsGetNotif['prenomAuteur'] . ' à commenter votre publication';
                                                            }

                                                            ?>
                                                       </p>
                                                  </div>
                                                  <?php
                                                  
                                                  if ($resultatsGetNotif['type'] === 'offre') {
                                                    
                                                       
                                                  }else{
                                                  $oldDate = $resultatsGetNotif['date'];
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

                                             </div>
                                             <div class="d-flex justify-content-right align-items-center">
                                                  <small style="float:right;width:40px;" class="mx-0 px-0 text-right"><?php echo $tempsEcoule; ?></small>
                                             </div> <?php } ?>
                                        </div>
                                   </label>
                              </a>
                         </div>

            <?php }  }

               if($_SESSION['type']=='Proprietaire'){ 
                    
                    if ($resultatsGetNotif['type'] === 'demande') {

                    }else{
                    ?>

<div class="list-group list-group-radio d-grid gap-2 border-0 w-auto">
                         <div class="position-relative">
                              <!-- <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="te" name="listGroupRadioGrid" id="listGroupRadioGrid1" value="" checked> -->
                              <a href="<?php echo $resultatsGetNotif['link'] . '&viewNotif=true&idNotif=' . $resultatsGetNotif['id']; ?>" style="text-decoration:none;">
                                   <label class="list-group-item py-3 pe-3 rounded-3 px-sm-1 " for="listGroupRadioGrid1" <?php if ($resultatsGetNotif['view'] == 'false') {
                                                                                                                                  echo 'style="background:#e9ecef;"';
                                                                                                                             } ?>>
                                        <div class="d-flex justify-content-between align-items-center">
                                             <div class="d-flex justify-content-left align-items-center">
                                                  <?php
                                                  if ($resultatsGetNotif['type'] === 'Publication') {
                                                       echo '<div class="type typep mr-1"></div>';
                                                  }
                                                  if ($resultatsGetNotif['type'] === 'commentaires') {
                                                       echo '<div class="type typec mr-1"></div>';
                                                  }
                                                  
                                                  if ($resultatsGetNotif['type'] === 'offre') {
                                                       echo '<div class="type typeo mr-1"></div>';
                                                  }

                                                  ?>
                                                  <div>
                                                       <h5 style="margin:0px;" class="fw-semibold"><?php
                                                                                                    if ($resultatsGetNotif['type'] === 'demande') {
                                                                                                         echo 'Demandes';
                                                                                                    }
                                                                                                    if ($resultatsGetNotif['type'] === 'Publication') {
                                                                                                         echo 'Publications';
                                                                                                    }
                                                                                                    if ($resultatsGetNotif['type'] === 'commentaires') {
                                                                                                         echo 'Commentaires';
                                                                                                    }
                                                                                                    if ($resultatsGetNotif['type'] === 'offre') {
                                                                                                         echo 'Offre';
                                                                                                    }

                                                                                                    ?></h5>
                                                       <p class="d-block my-0 py-0 opacity-75">
                                                            <?php
                                                            if ($resultatsGetNotif['type'] === 'Publication') {
                                                                 echo 'Votre post à été publié';
                                                            }
                                                            if ($resultatsGetNotif['type'] === 'commentaires') {
                                                                 echo $resultatsGetNotif['prenomAuteur'] . ' à commenter votre publication';
                                                            }
                                                            if ($resultatsGetNotif['type'] === 'offre') {
                                                                 echo 'Votre offre à été deployé';
                                                            }

                                                            ?>
                                                       </p>
                                                  </div>
                                                  <?php  
                                                            if ($resultatsGetNotif['type'] === 'demande') {
                                                                 
                                                            }else{
                                                  $oldDate = $resultatsGetNotif['date'];
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

                                             </div>
                                             <div class="d-flex justify-content-right align-items-center">
                                                  <small style="float:right;width:40px;" class="mx-0 px-0 text-right"><?php echo $tempsEcoule; ?></small>
                                             </div>
                                             <?php } ?>
                                        </div>
                                   </label>
                              </a>
                         </div>

           <?php  }   }
          ?>
               <!-- <form action="notifications.php" method="get" class="form5"> -->
                    <!-- <input type="text" name="link" value="<?php echo $resultatsGetNotif['link'] . '&view=true&idNotif=' . $resultatsGetNotif['id']; ?>" class="hide">
<button style="width:100%; padding:0;" class="noBtn"></button> -->
                    
                    <?php


               } ?>

                    </div>
     </div>

</body>

</html>




<!-- 
    <div class="notification">
        <form action="notifications.php"  method="get"class="form5">
        <p><h4>Nom Prénom</h4><span> type</span></p> 
        <p><h4>Chambre a louer</h4><span> Quartier</span></p>
      <button class="button8"> Voir + </button>
</form>
 </div><br>
    <div class="notification">
        <form action="notifications.php"  method="get"class="form5">
        <p><h4>Nom Prénom</h4><span> type</span></p> 
        <p><h4>Chambre a louer</h4><span> Quartier</span></p>
      <button class="button8"> Voir + </button>
</form>
 </div><br>
    <div class="notification">
        <form action="notifications.php"  method="get"class="form5">
        <p><h4>Nom Prénom</h4><span> type</span></p> 
        <p><h4>Chambre a louer</h4><span> Quartier</span></p>
      <button class="button8"> Voir + </button>
</form>
 </div><br>
    <div class="notification">
        <form action="notifications.php"  method="get"class="form5">
        <p><h4>Nom Prénom</h4><span> type</span></p> 
        <p><h4>Chambre a louer</h4><span> Quartier</span></p>
      <button class="button8"> Voir + </button>
</form>
 </div><br>
    <div class="notification">
        <form action="notifications.php"  method="get"class="form5">
        <p><h4>Nom Prénom</h4><span> type</span></p> 
        <p><h4>Chambre a louer</h4><span> Quartier</span></p>
      <button class="button8"> Voir + </button>
</form>
 </div><br>
    <div class="notification">
        <form action="notifications.php"  method="get"class="form5">
        <p><h4>Nom Prénom</h4><span> type</span></p> 
        <p><h4>Chambre a louer</h4><span> Quartier</span></p>
      <button class="button8"> Voir + </button>
</form>
 </div><br>
    <div class="notification">
        <form action="notifications.php"  method="get"class="form5">
        <p><h4>Nom Prénom</h4><span> type</span></p> 
        <p><h4>Chambre a louer</h4><span> Quartier</span></p>
      <button class="button8"> Voir + </button>
</form>
 </div><br>
    <div class="notification">
        <form action="notifications.php"  method="get"class="form5">
        <p><h4>Nom Prénom</h4><span> type</span></p> 
        <p><h4>Chambre a louer</h4><span> Quartier</span></p>
      <button class="button8"> Voir + </button>
</form>
 </div><br>
    <div class="notification">
        <form action="notifications.php"  method="get"class="form5">
        <p><h4>Nom Prénom</h4><span> type</span></p> 
        <p><h4>Chambre a louer</h4><span> Quartier</span></p>
      <button class="button8"> Voir + </button>
</form>
 </div><br>
    <div class="notification">
        <form action="notifications.php"  method="get"class="form5">
        <p><h4>Nom Prénom</h4><span> type</span></p> 
        <p><h4>Chambre a louer</h4><span> Quartier</span></p>
      <button class="button8"> Voir + </button>
</form>
 </div><br>
    <div class="notification">
        <form action="notifications.php"  method="get"class="form5">
        <p><h4>Nom Prénom</h4><span> type</span></p> 
        <p><h4>Chambre a louer</h4><span> Quartier</span></p>
      <button class="button8"> Voir + </button>
</form>
 </div><br>
    <div class="notification">
        <form action="notifications.php"  method="get"class="form5">
        <p><h4>Nom Prénom</h4><span> type</span></p> 
        <p><h4>Chambre a louer</h4><span> Quartier</span></p>
      <button class="button8"> Voir + </button>
</form>
 </div><br>


 -->