<?php require('includes/require.php');

if (isset($_GET['retrait'])) {
    header('location: demande2.php?typeDeChambre=' . $_GET['typeDeChambre'] . '&quartier=' . $_GET['quartier'] . '&IndicationParticulaire=' . $_GET['IndicationParticulaire'] . '&socialSituation=' . $_GET['socialSituation'] . '&type=' . $_GET['type'] . '&verification=true&retrait=true');
}

if (isset($_GET['modification'])) {
    header('location: includes/demandePHP1.php?idNotif=' . $_GET['idNotif'] . '&typeDeChambre=' . $_GET['typeDeChambre'] . '&quartier=' . $_GET['quartier'] . '&vile=' . $_GET['ville'] . '&prix=' . $_GET['prix'] . '&IndicationParticulaire=' . $_GET['IndicationParticulaire'] . '&socialSituation=' . $_GET['socialSituation'] . '&type=' . $_GET['type'] . '&demande=' . $_GET['demande'] . '&verification=true&modification=true');
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <title>BéniHome</title>
    <!-- Lien vers Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Lien vers votre style CSS -->
    <link rel="stylesheet" href="../style/homePageStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    /* Ajout de CSS pour les boutons et les prix */
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
    .correspondance{
        width: 50px;
    padding: 0;
    margin: 0;
    height: 0;
    z-index: 100;
    padding-left: 1px;
    }

    </style>
</head>

<body class="homePage">
    <?php

    if ($_SESSION['type'] != "Locataire") {
        if ($_SESSION['type'] == "Proprietaire") {
        } else {


            header('location: ../php/obligate.php');
        }
    }
    require('includes/navbar.php');
    $requete = $bdd->prepare('UPDATE notification SET idVictim=?, nomVictim=?, prenomVictim=?, globalView=? WHERE idVictim=? AND type=?');
    $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], 'true',$_SESSION['id'],'offre'));



    ?>
    <br>
    <?php

$requeteCountDemande = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur=? AND  prenomAuteur=?');
$requeteCountDemande->execute(array($_SESSION['id'],$_SESSION['nom'],$_SESSION['prenom']));
$count = $requeteCountDemande->rowCount(); // Compte le nombre de lignes retournées par la requête
if($count == 0){  ?>

<div class="container text-center">
    <h2 class="text-muted lead">Vous n'avez encor déclaré aucune demande . </h2>
</div>
<?php
}else{
        if(isset($_POST['checkdemandeoffre'])){  
            $requete = $bdd->prepare('UPDATE notification SET  view=? WHERE  idAuteur=? AND idVictim=? AND nomVictim=?  AND  type=?');
    $requete->execute(array('true',$_POST['idNotif'],$_SESSION['id'], $_SESSION['nom'],'offre'));

            ?>
<h2 class="text-muted text-center">Votre demande :</h2>
    <br>
    <div class="row row-cols-1 row-cols-md-2 g-4 text-center text-center p-2">
        <?php
        $requeteGetOffre = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur=? AND prenomAuteur=? AND id=? ORDER BY id DESC');
        $requeteGetOffre->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'],$_POST['idNotif']));

        $resultatsGetOffre = $requeteGetOffre->fetch();
            $dateEnregistrement = new DateTime($resultatsGetOffre['date']);
            $dateActuelle = new DateTime();
            $intervalle = $dateActuelle->diff($dateEnregistrement);

            $tempsEcoule = "";
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
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <h5 class="card-title"><?php echo $resultatsGetOffre['typeDemande']; ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6">
                                <h6 class="card-text">Chambre :</h6>
                                <span><?php echo $resultatsGetOffre['typeDeChambre']; ?></span>
                            </div>
                            <div class="col-6">
                                <h6 class="card-text">Quartier :</h6>
                                <span><?php echo $resultatsGetOffre['quartier']; ?></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <h6 class="card-text">Particularité :</h6>
                                <span><?php echo $resultatsGetOffre['IndicationParticulaire']; ?></span>
                            </div>
                            <div class="col-6">
                                <h6 class="card-text">Profil recherché :</h6>
                                <span><?php echo $resultatsGetOffre['socialSituation']; ?></span>
                            </div>
                        </div>
                        <form action="notificationPlus.php" method="get">
                            <input name="idNotif" type="hidden" value="<?php echo $resultatsGetOffre['id']; ?>">
                            <input name="idAuteur" type="hidden" value="<?php echo $resultatsGetOffre['idAuteur']; ?>">
                            <input name="nomAuteur" type="hidden" value="<?php echo $resultatsGetOffre['nomAuteur']; ?>">
                            <input name="prenomAuteur" type="hidden" value="<?php echo $resultatsGetOffre['prenomAuteur']; ?>">
                            <input name="typeDeChambre" type="hidden" value="<?php echo $resultatsGetOffre['typeDeChambre']; ?>">
                            <input name="quartier" type="hidden" value="<?php echo $resultatsGetOffre['quartier']; ?>">
                            <input name="demande" type="hidden" value="<?php echo $resultatsGetOffre['typeDemande']; ?>">
                            <input name="number" type="hidden" value="<?php echo $_SESSION['number']; ?>">
                            <input name="prix" type="hidden" value="<?php echo $resultatsGetOffre['prix']; ?>">
                            <input name="ville" type="hidden" value="<?php echo $resultatsGetOffre['ville']; ?>">
                            <input name="IndicationParticulaire" type="hidden" value="<?php echo $resultatsGetOffre['IndicationParticulaire']; ?>">
                            <input name="socialSituation" type="hidden" value="<?php echo $resultatsGetOffre['socialSituation']; ?>">
                            <input name="date" type="hidden" value="<?php echo $resultatsGetOffre['date']; ?>">
                            <input name="type" type="hidden" value="<?php echo $resultatsGetOffre['type']; ?>">
                            <input name="idNotif" type="hidden" value="<?php echo $resultatsGetOffre['id']; ?>">
                            <input name="verification" type="hidden" value="true">
                            <button class="btn btn-primary" name="checkdemandeoffre">Aller voir</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        <?php echo 'Depuis : ' . $tempsEcoule; ?>
                    </div>
                </div>
            </div>
            <?php
$requeteOffre = $bdd->prepare('SELECT * FROM offre WHERE typeDeChambre=? AND IndicationParticulaire=? AND quartier=? AND ville=? OR typeDeChambre=? AND IndicationParticulaire=? OR  quartier=? AND ville=? OR quartier=? AND ville=? AND prix=? ORDER BY id DESC');
$requeteOffre->execute(array($resultatsGetOffre['typeDeChambre'], $resultatsGetOffre['IndicationParticulaire'], $resultatsGetOffre['quartier'], $resultatsGetOffre['ville'],$resultatsGetOffre['typeDeChambre'], $resultatsGetOffre['IndicationParticulaire'], $resultatsGetOffre['quartier'], $resultatsGetOffre['ville'], $resultatsGetOffre['quartier'], $resultatsGetOffre['ville'],$resultatsGetOffre['prix']));
$count = $requeteOffre->rowCount(); // Compte le nombre de lignes retournées par la requête
?></div>
<div class="container mt-4 justify-content-center">
    <h2 class="text-muted text-center">Offres correspondant : <?php echo $count; ?></h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 text-left p-2">
                    <?php
                    $requeteGetNotification = $bdd->prepare('SELECT * FROM offre WHERE typeDeChambre=?AND IndicationParticulaire=? AND quartier=? AND ville=? OR typeDeChambre=? AND IndicationParticulaire=? OR  quartier=? AND ville=? OR  quartier=? AND ville=? AND prix=?');
                    $requeteGetNotification->execute(array($resultatsGetOffre['typeDeChambre'], $resultatsGetOffre['IndicationParticulaire'], $resultatsGetOffre['quartier'], $resultatsGetOffre['ville'],$resultatsGetOffre['typeDeChambre'], $resultatsGetOffre['IndicationParticulaire'], $resultatsGetOffre['quartier'], $resultatsGetOffre['ville'], $resultatsGetOffre['quartier'], $resultatsGetOffre['ville'],$resultatsGetOffre['prix']));
                    while ($resultats = $requeteGetNotification->fetch()) {
                  


                        $requeteGetNumber = $bdd->prepare('SELECT number FROM user WHERE id=? AND nom=?');
                        $requeteGetNumber->execute(array($resultats['idAuteur'], $resultats['nomAuteur']));
                        $results = $requeteGetNumber->fetch(); ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <?php
                                  $count= 0 ;
                                  if($resultats['typeDemande']==$resultatsGetOffre['typeDemande']){
                                     $count = $count + 1;
                                    //  echo '<br>typeDemande : '. $count;
                                  }if($resultats['prix']==$resultatsGetOffre['prix']){
                                    $count =  $count + 1;
                                    //   echo '<br>prix : '.   $count;
                                  }if($resultats['typeDeChambre']==$resultatsGetOffre['typeDeChambre']){
                                       $count= $count + 1;
                                    //    echo '<br>typeDeChambre : '.$count ; 
                                  }if($resultats['quartier']==$resultatsGetOffre['quartier']){
                                    $count = $count + 1;
                                    // echo '<br>quartier : '. $count;
                                  }if($resultats['ville']==$resultatsGetOffre['ville']){
                                     $count = $count + 1;
                                    //  echo '<br>ville : '. $count;
                                  }if($resultats['IndicationParticulaire']==$resultatsGetOffre['IndicationParticulaire']){
                                     $count = $count + 1;
                                    //  echo '<br>indiciationParticuliaire : '.$count;
                                  }if($resultats['socialSituation']==$resultatsGetOffre['socialSituation']){
                                     $count = $count + 1; 
                                    //  echo '<br>socialSituation : '. $count;
                                  }
                                //   echo $count ; 
                                  
                                  $totalCount = $count/ 7;
                                  
                                  $correspondance = $totalCount *100;
                                  
                                  
                                  if($correspondance > 50){
                                  if($correspondance == 100){
                                   echo '<p class="text-success correspondance">'.$correspondance.'%</p>';
                                  }else{
                                   echo '<p class="text-success correspondance">'.substr($correspondance, 0, 2).'%</p>';
                                   }
                                 
                                  
                                  
                                  }
                                  if($correspondance < 50){
                                  
                                      echo '<p class="text-danger correspondance">'.substr($lastMessage, 0, 2).'%</p>';
                                      
                                      
                                      }
                                  
                                  
                                  
                                  
                                  
                                  $count = 0;
                                  
                                $raison = 'imagePrincipale';
                                $requeteGetThePrincipalImage = $bdd->prepare('SELECT * FROM imagesdemande WHERE idRequete=? AND raison=? ORDER BY id LIMIT 1');
                                $requeteGetThePrincipalImage->execute(array($resultats['id'], $raison));
                                $resultGetThePrincipalImage = $requeteGetThePrincipalImage->fetch();
                                if (isset($resultGetThePrincipalImage['bin'])) {
                                ?>
                            <img width="100%" height="225" src="<?php echo $resultGetThePrincipalImage['bin']; ?>"
                                alt="images chambre à louer" class="principalImage">
                            <?php } else { ?>
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                                    dy=".3em">Images</text>
                            </svg>
                            <?php } ?>
                            <div class="card-body">
                                <p class="card-text">
                                <h6 class="textColor"><?php echo $resultats['quartier']; ?></h6>
                                <h6 class="text-right text-primary" style="text-align:right;">
                                    <?php echo $resultats['prix'] . ' F'; ?></h6>
                                <h6 class="textColor"><?php echo $resultats['typeDeChambre']; ?></h6>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="btn-group">
                                            <form method="get" style="margin:0px;padding:0px;"
                                                action="notificationPlus.php">
                                                <input name="verification" class="hide" type="text" value="true">
                                                <button name="checkOffre"
                                                    class="btn btn-sm btn-outline-secondary">Voir</button>
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
                                        </div>
                                    </div>
                                    <div class="justify-content-right">
                                        <small class="text-right text-muted"><?php echo $tempsEcoule; ?></small>
                                    </div>

                                </div>
                                <input name="idAuteur" class="hide" type="text"
                                    value="<?php echo $resultats['idAuteur']; ?>">
                                <input name="nomAuteur" class="hide" type="text"
                                    value="<?php echo $resultats['nomAuteur']; ?>">
                                <input name="prenomAuteur" class="hide" type="text"
                                    value="<?php echo $resultats['prenomAuteur']; ?>">
                                <input name="typeDeChambre" class="hide" type="text"
                                    value="<?php echo $resultats['typeDeChambre']; ?>">
                                <input name="quartier" class="hide" type="text"
                                    value="<?php echo $resultats['quartier']; ?>">
                                <input name="number" class="hide" type="text" value="<?php echo $results['number']; ?>">
                                <input name="prix" class="hide" type="text" value="<?php echo $resultats['prix']; ?>">
                                <input name="ville" class="hide" type="text" value="<?php echo $resultats['ville']; ?>">
                                <input name="demande" class="hide" type="text"
                                    value="<?php echo $resultats['typeDemande']; ?>">
                                <input name="IndicationParticulaire" class="hide" type="text"
                                    value="<?php echo $resultats['IndicationParticulaire']; ?>">
                                <input name="socialSituation" class="hide" type="text"
                                    value="<?php echo $resultats['socialSituation']; ?>">
                                <input name="date" class="hide" type="text" value="<?php echo $resultats['date']; ?>">
                                <input name="short" class="hide" type="text" value="<?php echo $resultats['short']; ?>">
                                <input name="type" class="hide" type="text" value="<?php echo $resultats['type']; ?>">
                                <input name="idNotif" class="hide" type="text" value="<?php echo $resultats['id']; ?>">
                                <input name="verification" class="hide" type="text" value="true">
                                </form>
                            </div>

                        </div>
                    </div>
                    <?php } ?>
                </div>
          
    </div>


<br>
    </div>
</div>
  <?php      }else{ ?>
    <h2 class="text-muted text-center">Vos demandes :</h2>
<br>
<div class="row row-cols-1 row-cols-md-2 g-4 text-center p-2">
    <?php
    $requeteGetOffre = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur=? AND prenomAuteur=? ORDER BY id DESC');
    $requeteGetOffre->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom']));

    while ($resultatsGetOffre = $requeteGetOffre->fetch()) {
        $dateEnregistrement = new DateTime($resultatsGetOffre['date']);
        $dateActuelle = new DateTime();
        $intervalle = $dateActuelle->diff($dateEnregistrement);

        $tempsEcoule = "";
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


        $requeteOffre = $bdd->prepare('SELECT * FROM notification WHERE idVictim=? AND nomVictim=? AND view=? AND type=?');
        $requeteOffre->execute(array($_SESSION ['id'],$_SESSION['nom'],'false','offre'));
        $correspondance = $requeteOffre->fetch();
        ?>
        <div class="col">
            <div class="card text-center <?php  if($correspondance['idAuteur']==$resultatsGetOffre['id']){ echo 'border-primary';} ?>">
                <div class="card-header <?php  if($correspondance['idAuteur']==$resultatsGetOffre['id']){ echo 'border-primary';}?>">
                    <h5 class="card-title"><?php echo $resultatsGetOffre['typeDemande']; ?></h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <h6 class="card-text">Chambre :</h6>
                            <span><?php echo $resultatsGetOffre['typeDeChambre']; ?></span>
                        </div>
                        <div class="col-6">
                            <h6 class="card-text">Quartier :</h6>
                            <span><?php echo $resultatsGetOffre['quartier']; ?></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <h6 class="card-text">Particularité :</h6>
                            <span><?php echo $resultatsGetOffre['IndicationParticulaire']; ?></span>
                        </div>
                        <div class="col-6">
                            <h6 class="card-text">Profil recherché :</h6>
                            <span><?php echo $resultatsGetOffre['socialSituation']; ?></span>
                        </div>
                    </div>
                    <form action="offres.php" method="post">
                        <input name="idNotif" type="hidden" value="<?php echo $resultatsGetOffre['id']; ?>">
                        <input name="idAuteur" type="hidden" value="<?php echo $resultatsGetOffre['idAuteur']; ?>">
                        <input name="nomAuteur" type="hidden" value="<?php echo $resultatsGetOffre['nomAuteur']; ?>">
                        <input name="prenomAuteur" type="hidden" value="<?php echo $resultatsGetOffre['prenomAuteur']; ?>">
                        <input name="typeDeChambre" type="hidden" value="<?php echo $resultatsGetOffre['typeDeChambre']; ?>">
                        <input name="quartier" type="hidden" value="<?php echo $resultatsGetOffre['quartier']; ?>">
                        <input name="demande" type="hidden" value="<?php echo $resultatsGetOffre['typeDemande']; ?>">
                        <input name="number" type="hidden" value="<?php echo $_SESSION['number']; ?>">
                        <input name="prix" type="hidden" value="<?php echo $resultatsGetOffre['prix']; ?>">
                        <input name="ville" type="hidden" value="<?php echo $resultatsGetOffre['ville']; ?>">
                        <input name="IndicationParticulaire" type="hidden" value="<?php echo $resultatsGetOffre['IndicationParticulaire']; ?>">
                        <input name="socialSituation" type="hidden" value="<?php echo $resultatsGetOffre['socialSituation']; ?>">
                        <input name="date" type="hidden" value="<?php echo $resultatsGetOffre['date']; ?>">
                        <input name="type" type="hidden" value="<?php echo $resultatsGetOffre['type']; ?>">
                        <input name="idNotif" type="hidden" value="<?php echo $resultatsGetOffre['id']; ?>">
                        <input name="verification" type="hidden" value="true">
                        <button class="btn btn-primary" name="checkdemandeoffre">Aller voir</button>
                    </form>
                </div>
                <div class="card-footer text-muted <?php  if($correspondance['idAuteur']==$resultatsGetOffre['id']){ echo 'border-primary';} ?>">
                    <?php echo 'Depuis : ' . $tempsEcoule; ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
</div>
<?php
  }  }
?>

    




    <!-- Lien vers Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

 // Ajoutez un gestionnaire d'événement pour le clic sur le bouton "Commentaires"
 document.getElementById('btnComments').addEventListener('click', function() {
        // Affichez la carte de commentaire
        document.getElementById('commentCard').style.display = 'block';
    });

    // Ajoutez un gestionnaire d'événement pour le clic sur le bouton de fermeture
    document.getElementById('closeCommentCard').addEventListener('click', function() {
        // Masquez la carte de commentaire
        document.getElementById('commentCard').style.display = 'none';
    });

//     $(document).ready(function() {
//         // Fonction pour charger les articles via AJAX
//         function chargerArticles() {
//             $.ajax({
//                 url: "home.php", // Chemin vers le script PHP qui récupère les articles
//                 method: "GET",
//                 success: function(data) {
//                     $(".homePage").html(data); // Afficher les articles sur la page
//                 }
//             });
//         }
// 
//         // Appeler la fonction pour charger les articles au chargement de la page
//         chargerArticles();
// 
//         // Rafraîchir les articles toutes les 60 secondes
//         setInterval(chargerArticles, 2000);
//     });
    </script>
    <script>
    // Ajoutez un gestionnaire d'événement pour le clic sur le bouton "Commentaires"
    document.getElementById('btnComments').addEventListener('click', function() {
        // Affichez la carte de commentaire
        document.getElementById('commentCard').style.display = 'block';
    });

    // Ajoutez un gestionnaire d'événement pour le clic sur le bouton de fermeture
    document.getElementById('closeCommentCard').addEventListener('click', function() {
        // Masquez la carte de commentaire
        document.getElementById('commentCard').style.display = 'none';
    });
    </script>
</body>

</html>