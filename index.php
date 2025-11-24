<!DOCTYPE html>
<html lang="fr">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
     <link rel="stylesheet" href="style/bootstrap.min.css">
     <script src="js/bootstrap.bundle.min.js"></script>
     <title>getJOB</title>
     <!-- <link rel="stylesheet" href="../style/style.css"> -->
     <style>

     </style>
</head>

<body style="background-color: white;" class="pageAccueil">
     <header>
          <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top ">
               <div class="container-fluid">
                    <a class="navbar-brand text-primary" href="index.php">BéniHome</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                         <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                         <ul class="navbar-nav me-auto mb-2 mb-md-0">
                              <li class="nav-item">
                                   <a class="nav-link" href="php/signUp.php">Inscription</a>
                              </li>
                              <li class="nav-item">
                                   <a class="nav-link" href="php/login.php">Connexion</a>
                              </li>
                         </ul>
                         <form class="d-flex" method="get" action="search.php" role="search">
                              <input class="form-control me-2" name="recherche" type="search" placeholder="Quartier" value="Bohicon" aria-label="Search">
                              <button class="btn btn-outline-primary" name="search" type="submit">Rechercher</button>
                         </form>
                    </div>
               </div>
          </nav>
     </header>
     <br>
     <main>

          <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
               <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
               </div>
               <div class="carousel-inner">
                    <div class="carousel-item active">
                         <img src="img/imgHome.jpg" alt="image" width="100%" height="450px">

                         <div class="container">
                              <div class="carousel-caption text-start">

                                   <h1>Bienvenue sur BéniHome.</h1>
                                   <p>votre destination en ligne pour trouver des chambres àlouer au Bénin.</p>
                                   <p><a class="btn btn-lg btn-primary" href="php/login.php">Se connecter</a></p>
                              </div>
                         </div>
                    </div>
                    <div class="carousel-item">
                         <img src="img/homeImage.jpg" alt="image" width="100%" height="450px">

                         <div class="container">
                              <div class="carousel-caption">

                                   <h1>Explorez notre sélection</h1>
                                   <p> de chambres disponibles, filtrez selon vos préférences, et découvrez desoptionsqui correspondent à votre style de vie.</p>
                                   <p><a class="btn btn-lg btn-primary" href="Search.php">Rechercher</a></p>
                              </div>
                         </div>
                    </div>
                    <div class="carousel-item">
                         <img src="img/imgHomePage.jpg" alt="image" width="100%" height="450px">

                         <div class="container">
                              <div class="carousel-caption text-end">
                                   <h1>Créez votre propre profil</h1>
                                   <p> sur BéniHome pour suivre vos annonces préférées, gérer vos réservations, etresterinformé des dernières opportunités.
                                   </p>
                                   <p><a class="btn btn-lg btn-primary" href="php/signUp.php">S'inscrire</a></p>
                              </div>
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


          <div class="container justify-content-center text-center mt-3 marketing">

               <!-- Three columns of text below the carousel -->
                    <div class="col-lg-4">
                    <img class="rounded-circle" width="140" height="140"  src="img/istockphoto-1270638755-612x612.jpg">

                         <h2 class="fw-normal">Méssageris</h2>
                         <p>BéniHome facilite la communication entre les locataires et les propriétaires. Utilisez notre
                              systèmedemessagerie intégrépour discuter des détails, poser des questions, et organiser des visites.</p>

                    </div><!-- /.col-lg-4 -->
                    <div class="row">
                    <div class="col-lg-4">
                        <img class="rounded-circle" width="140" height="140"  src="img/search.png">

                         <h2 class="fw-normal">Exploration</h2>
                         <p>Naviguez facilement à travers les annonces, consultez les détails des chambres, et contactezdirectementles propriétaires.</p>

                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                    <img class="rounded-circle" width="140" height="140"  src="img/istockphoto-1270642880-612x612.jpg">


                         <h2 class="fw-normal">Réservations</h2>
                         <p>Réservez votre chambre en toute confiance grâce à notre système de réservation sécurisé. Profitez
                     d'une expérience transparente du début à la fin.</p>

                    </div><!-- /.col-lg-4 -->
               </div><!-- /.row -->

               <!-- 

 <div class="px-4 pt-2 pb-3 mt-2 mb-3 text-center">
    <img class="d-block mx-auto mb-4" src="images/logo.png" alt="" width="72" height="57">
    <h1 class="display-5 fw-bold">BéniHome</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Bienvenue sur BéniHome, votre destination en ligne pour trouver des
                    chambres à
                    louer au Bénin. Nous simplifions la recherche et la location de chambres, offrant une
                    plateforme
                    conviviale pour les
                    locataires et les
                    propriétaires.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="php/signUp.php"><button type="button" class="btn btn-primary btn-lg px-4 gap-3">S'inscrir</button></a>
        <a href="php/login.php"><button type="button" class="btn btn-outline-secondary btn-lg px-4">Se connecter</button></a>
      </div>
    </div>
  </div>   
<div class="container text-center ">
               <br>
               <p>Explorez notre sélection de chambres disponibles, filtrez selon vos préférences, et découvrez des
                    options
                    qui correspondent à votre style de vie. Les propriétaires peuvent également publier leurs
                    annonces
                    de manière
                    simple et
                    efficace.</p>
               <br>
               <p>Naviguez facilement à travers les annonces, consultez les détails des chambres, et contactez
                    directement
                    les propriétaires. Notre interface conviviale rend le processus de recherche et de réservation
                    rapide et sans
                    tracas.</p>
               <br>
               <p>BéniHome facilite la communication entre les locataires et les propriétaires. Utilisez notre
                    système
                    de
                    messagerie intégré
                    pour discuter des détails, poser des questions, et organiser des visites.</p>
               <br>
               <p>Créez votre propre profil sur BéniHome pour suivre vos annonces préférées, gérer vos
                    réservations, et
                    rester
                    informé des dernières opportunités. Les propriétaires peuvent également gérer leurs annonces et
                    interagir
                    avec les locataires potentiels.</p>
               <br>
               <p>Faites confiance à la communauté BéniHome en consultant les évaluations et les commentaires
                    laissés
                    par
                    d'autres utilisateurs. Partagez votre expérience pour aider les autres à prendre des décisions
                    éclairées.</p>
               <p>Réservez votre chambre en toute confiance grâce à notre système de réservation sécurisé. Profitez
                    d'une
                    expérience transparente du début à la fin.</p>
               <br>
               <p>BéniHome se concentre sur la ville de Bohicon, offrant une plateforme spécialisée pour répondre
                    aux
                    besoins
                    uniques de la communauté locale en matière de location de chambres.</p>
               <br>
               <p>Notre engagement envers la qualité se reflète dans chaque annonce sur BéniHome. Nous travaillons
                    pour
                    garantir
                    des informations précises, des transactions sécurisées et une expérience agréable pour tous nos
                    utilisateurs.
               </p>
               <br>
               <p>Suivez notre blog et nos mises à jour pour rester informé sur les tendances du marché, les
                    conseils
                    de
                    location,
                    et les nouvelles fonctionnalités de BéniHome.</p>
                    </div> -->
     </main>

     <footer class="container text-center border-top mt-3 mb-3">
    <p>&copy; 2024  BéniHome &middot;</p>
  </footer>
</body>

</html>