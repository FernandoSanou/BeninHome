<?php



?>

<head>
  <?php
  // Requêtes et logiques PHP
  // voir toutes les dmande d'utilisateur 
  if ($_SESSION['type'] == 'Locataire') {
      // Récupérer les demandes de l'utilisateur
      $requeteGetNotification = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur=? ORDER BY id DESC');
      $requeteGetNotification->execute(array($_SESSION['id'], $_SESSION['nom']));
      
      while ($resultats = $requeteGetNotification->fetch()) {
          // Voir les offres correspondant aux demandes
          $requeteGetOfferCorrespondant = $bdd->prepare(
              'SELECT * FROM offre WHERE 
              (typeDeChambre=? AND IndicationParticulaire=? AND quartier=? AND ville=?) OR 
              (typeDeChambre=? AND IndicationParticulaire=?) OR  
              (quartier=? AND ville=?) OR 
              (quartier=? AND ville=? AND prix=?)'
          );
          $requeteGetOfferCorrespondant->execute(array(
              $resultats['typeDeChambre'], 
              $resultats['IndicationParticulaire'], 
              $resultats['quartier'], 
              $resultats['ville'],
              $resultats['typeDeChambre'], 
              $resultats['IndicationParticulaire'], 
              $resultats['quartier'], 
              $resultats['ville'], 
              $resultats['quartier'], 
              $resultats['ville'],
              $resultats['prix']
          ));
        //   echo $resultats['id'];
           while ($resultOffer = $requeteGetOfferCorrespondant->fetch()){
             
    // echo '<br>'.$resultOffer['id'];
          // Compter pour voir s'il n'a pas déjà été enregistré dans la base de données
          $requeteGetNotification = $bdd->prepare('SELECT COUNT(*) AS notification_count FROM notification WHERE idAuteur=? AND nomAuteur=? AND idVictim=? AND nomVictim=? AND type=? ');
          $requeteGetNotification->execute(array($resultats['id'],$resultOffer['id'],$_SESSION['id'], $_SESSION['nom'], 'offre'));
          $resultatsGetNotifOfThisOffer = $requeteGetNotification->fetch()['notification_count'];
// echo '<br>nombre : '.$resultatsGetNotifOfThisOffer;
          if ($resultatsGetNotifOfThisOffer == 0) {
              $date = date('d-m-Y H:i');
              $link = '/BéniHome/php/offres.php?idDemande='.$resultats['id'].'&nomAuteur='.$resultats['nomAuteur'].'&idAuteur='.$resultats['idAuteur'].'&prenomAuteur='.$resultats['prenomAuteur'];
              $requeteMakeNotification = $bdd->prepare('INSERT INTO notification(idAuteur,nomAuteur, idVictim, nomVictim, prenomVictim, type, date, link) VALUES (?,?, ?, ?, ?, ?, ?, ?)');
              $requeteMakeNotification->execute(array($resultats['id'],$resultOffer['id'], $_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], 'offre', $date, $link));
          } else {
            $requeteGetNotificationOffre = $bdd->prepare("SELECT * FROM notification WHERE idVictim, nomVictim, prenomVictim, type");
            $requeteGetNotificationOffre->execute(array( $_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], 'offre'));
            $resultNotifOffre = $requeteGetNotificationOffre->fetch();
            if($resultats['id'] == $resultNotifOffre['nomAuteur']){
              $link = '/BéniHome/php/offres.php?idDemande='.$resultats['id'].'&nomAuteur='.$resultats['nomAuteur'].'&idAuteur='.$resultats['idAuteur'].'&prenomAuteur='.$resultats['prenomAuteur'];
              $requete = $bdd->prepare('UPDATE notification SET idAuteur=?, idVictim=?, nomVictim=?, prenomVictim=?, view=?, globalView=?, link=? WHERE type=? AND idVictim=?');
              $requete->execute(array($resultats['id'], $_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], 'false', 'false', $link, 'offre', $_SESSION['id']));
          
            }
      }
  }
  }} 
  $requeteGetNotification = $bdd->prepare('SELECT COUNT(*) AS notification_count FROM notification WHERE idVictim=? AND nomVictim=? AND globalView=? NOT type=?');
  $requeteGetNotification->execute(array($_SESSION['id'], $_SESSION['nom'], 'false','offre'));
  $resultatsCountNotification = $requeteGetNotification->fetch()['notification_count'];

  $requeteCountMessage = $bdd->prepare('SELECT COUNT(*) AS message_count FROM messages WHERE idCorrespondant=? AND nomCorrespondant=? AND vueCorrespondant=?');
  $requeteCountMessage->execute(array($_SESSION['id'], $_SESSION['nom'], 'false'));
  $resultatsCountMessage = $requeteCountMessage->fetch()['message_count'];
  $requeteCountOffres = $bdd->prepare('SELECT COUNT(*) AS notification_count FROM notification WHERE idVictim=? AND nomVictim=? AND globalView=? AND type=?');
  $requeteCountOffres->execute(array($_SESSION['id'], $_SESSION['nom'], 'false','offre'));
  $resultatsCountOffres = $requeteCountOffres->fetch()['notification_count'];

  $totalNotifications = $resultatsCountNotification + $resultatsCountMessage + $resultatsCountOffres;
  ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../../images/logo.jpg" type="image/x-icon">
  <title>BéniHome</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style/bootstrap.min.css">
  <style>
    /* Ajoutez vos styles personnalisés ici */
    button.noBtn {
      background: none;
      border: none;
    }
    @media only screen and (min-width: 880px) {
      .notificationspop {
        visibility: hidden;
        display: none;
      }
    }
    @media screen and (max-width: 880px) { 
      .notificationspop {
        visibility: visible;
        margin: 0px;
        position: relative;
        right: 30px;
        top: 9px;
      }
    }
  </style>
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container navbars mx-2">
            <a class="navbar-brand text-primary" href="home.php">BéniHome</a>
            <div class="d-flex justify-content-center align-items-center">
                <input type="text" class="hide" style="display:none; visibility:hidden;" id="makeView" value="makeView">
                <button class="navbar-toggler" id="popNotif" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php if ($totalNotifications > 0): ?>
                    <span class="badge notificationspop badge-danger ml-2 notif-md-none bg-danger"><?php echo $totalNotifications; ?></span>
                <?php endif; ?>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="chatList.php">Chats
                            <?php if ($resultatsCountMessage > 0): ?>
                                <span class="badge badge-primary"><?php echo $resultatsCountMessage; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <?php if($_SESSION['type']=='Locataire'){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="offres.php">Offres
                            <?php if ($resultatsCountOffres > 0): ?>
                                <span class="badge badge-primary bg-primary"><?php echo $resultatsCountOffres; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <?php  }?>
                    <li class="nav-item">
                        <a class="nav-link" href="notifications.php">Notifications
                            <?php if ($resultatsCountNotification > 0): ?>
                                <span class="badge badge-primary bg-primary"><?php echo $resultatsCountNotification; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Carte.php">Carte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/jquery-3.7.1.min.js">
</script>
</body>
</html>
