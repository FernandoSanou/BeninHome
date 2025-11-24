<!DOCTYPE html>
<html lang="fr">
<?php session_start();
   $bdd = new PDO('mysql:host=localhost;dbname=getHouse;charset=utf8', 'root', '');
 ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="../style/bootstrap.min.css">
<script src="../js/bootstrap.bundle.min.js"></script>
<style>
    .help {
      height: 450px;
      background-color: #cecece;
    }

    .count {
      left: 49%;
    }
  </style>
    <?php

    ?>
        <link rel="stylesheet" href="../style/homePageStyle.css">
   
<title>BéniHome</title>
<body class="homePage">
    <?php
   if(!isset($_GET['guide'])){ ?>
    <br>
    <div class="container text-center my-5">
        <h1 class="text-primary font-weight-light">BéniHome</h1>
        <p class="text-muted lead">Bienvenue sur BéniHome, votre destination en ligne pour trouver des chambres à louer à <?php echo $_SESSION['ville']; ?>.</p>
        <p class="text-muted lead mb-4">Choisissez le type de votre compte</p>
        <form action="obligate.php" method="post" class="d-inline-block">
            <button name="typeLocataire" class="btn btn-primary mx-2">Locataire</button>
            <button name="typeProprietaire" class="btn btn-primary mx-2">Propriétaire</button>
        </form>
        <hr class="my-4">
    </div>
            <?php

            $bdd = new PDO('mysql:host=localhost;dbname=getHouse;charset=utf8', 'root', '');

            $requetes = $bdd->prepare('SELECT * FROM user WHERE id = ?');
            $requetes->execute(array($_SESSION['id']));
            $resultats = $requetes->fetch();
            if (isset($_POST['typeLocataire'])) {
                $typeLocataire = "Locataire";
                $requete = $bdd->prepare('UPDATE user SET type=? WHERE nom=? AND  id=?');
                $requete->execute(array($typeLocataire, $_SESSION['nom'], $_SESSION['id']));
                $_SESSION['type'] = $typeLocataire;
                 header('location: home.php');
                exit();
            }

            if (isset($_POST['typeProprietaire'])) {
                $typeLocataire = "Proprietaire";
                $requete = $bdd->prepare('UPDATE user SET type=? WHERE nom=? AND  id=?');
                $requete->execute(array($typeLocataire, $_SESSION['nom'], $_SESSION['id']));
                $_SESSION['type'] = $typeLocataire;
                 header('location: home.php');
                exit();
            }
        if(!empty($_SESSION['type'])){
            header('location: home.php');
        }


            ?>

        </div>
        <div class='container text-center'>
          <p class="lead text-muted">
                Nous simplifions la recherche et la location de chambres, offrant une plateforme conviviale pour les
                locataires et les
                propriétaires.</p>
                <br>
            <p class="lead text-muted">Explorez notre sélection de chambres disponibles, filtrez selon vos préférences, et découvrez des
                options
                qui correspondent à votre style de vie. Les propriétaires peuvent également publier leurs annonces
                de manière simple et
                efficace.</p>
            <br>
            <p class="lead text-muted">Naviguez facilement à travers les annonces, consultez les détails des chambres, et contactez
                directement
                les propriétaires. Notre interface conviviale rend le processus de recherche et de réservation
                rapide et sans tracas.</p>
            <br>
            <p class="lead text-muted">BéniHome facilite la communication entre les locataires et les propriétaires. Utilisez notre système
                de messagerie intégré
                pour discuter des détails, poser des questions, et organiser des visites.</p>
            <br>
            <!-- <p class="lead text-muted">Créez votre propre profil sur BéniHome pour suivre vos annonces préférées, gérer vos réservations, et rester
             informé des dernières opportunités. Les propriétaires peuvent également gérer leurs annonces et interagir
              avec les locataires potentiels.</p> -->
            <br>
            <p class="lead text-muted">Faites confiance à la communauté BéniHome en consultant les évaluations et les commentaires laissés
                par
                d'autres utilisateurs. Partagez votre expérience pour aider les autres à prendre des décisions
                éclairées.</p>
            <p class="lead text-muted">Réservez votre chambre en toute confiance grâce à notre système de réservation sécurisé. Profitez
                d'une
                expérience transparente du début à la fin.</p>
            <br>
            <p class="lead text-muted">BéniHome se concentre sur la ville de Bohicon, offrant une plateforme spécialisée pour répondre aux
                besoins
                uniques de la communauté locale en matière de location de chambres.</p>
            <br>

        </div>
        <?php }else{ ?>
            <div id="myCarousel" class="carousel slide border-1 mt-2 col-lg-5 col-md-5 col-sm-12" style="margin: 0 auto;position: fixed;right: 0;left: 0;" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner shadow">
      <div class="carousel-item help active">
        <div class="bg-primary m-0 mt-4 px-2  count text-light" style="width: 25px;border-radius: 5px;position: relative;">1</div>

        <div class="container">
          <div class="carousel-caption text-center">
            <h3 class="text-primary">Bienvenue sur BéniHome.</h3>
            <p>votre destination en ligne pour trouver des chambres àlouer au Bénin.</p>
            <p>Apprenez à utliser notre site grace au guide d'utilisation</p>
          </div>
        </div>
      </div>
      <div class="carousel-item help">
        <div class="bg-primary m-0 mt-4 px-2  count text-light" style="width: 25px;border-radius: 5px;position: relative;">2</div>

        <div class="container">
          <div class="carousel-caption text-center">

            <h3 class="text-primary">Propriétaire</h3>
            <p>Les propriétaires ont la possibilité de plubiez des offres de chambre a louer </p>
          </div>
        </div>
      </div>
      <div class="carousel-item help">
        <div class="bg-primary m-0 mt-4 px-2  count text-light" style="width: 25px;border-radius: 5px;position: relative;">3</div>


        <div class="container">
          <div class="carousel-caption">

            <h3 class="text-primary">Locataire </h3>
            <p>Les locataires ont la possibilté quant à eux de recherche des chambre a louer grace aux demande qu'ils publiez </p>
          </div>
        </div>
      </div>
      <div class="carousel-item help">
        <div class="bg-primary m-0 mt-4 px-2  count text-light" style="width: 25px;border-radius: 5px;position: relative;">4</div>


        <div class="container">
          <div class="carousel-caption">

            <h3 class="text-primary">Système</h3>
            <p>Losrqu'un locataire publie une demande BéniHome recherche les offres de chambre à louer correspondant aux caracteristique de la demande.</p>
            <p>Et vous serez directmement notifiez par BéniHome .</p>

          </div>
        </div>
      </div>
      <div class="carousel-item help">
        <div class="bg-primary m-0 mt-4 px-2  count text-light" style="width: 25px;border-radius: 5px;position: relative;">5</div>


        <div class="container">
          <div class="carousel-caption">

            <h3 class="text-primary">Notifications</h3>
            <p>Vouc serez notfiez de toutes les activités se déroulant sur BéniHome .</p>
            <p>Ainsi que des offres correspondants à cos demandes .</p>
            <form action="obligate.php">
                <button class="btn btn-primary ">Terminer</button>
            </form>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
        <?php } ?>
<script>
</script>

</body>

</html>