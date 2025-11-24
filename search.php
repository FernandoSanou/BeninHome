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
        .hide {
            display: none;
        }

        .inputsearch {
            border: solid 1px #6c757d;
            border-radius: 5px;
            color: #6c757d;
        }
    </style>
</head>

<body style="background-color: whte;" class="pageAccueil">
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top ">
            <div class="container">
                <a class="navbar-brand text-primary" href="index.php">BéninHome</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="php/signUp.php">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="php/login.php">Connexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Page de recherche</h1>

                <?php
                if (isset($_POST['search']) && isset($_POST['recherche'])) {  ?>
                    <p>
                    <form action="search.php" class=" d-flex flex-column flex-sm-row w-100 gap-2  justify-content-center" method="post">
                        <select name="type" class=" inputsearch col-lg-4 col-md-4 col-sm-6 p-2" id="country" required>
                            <option value="">Choisir...</option>
                            <option value="Quartier"> Quartier</option>
                            <option value="Ville">Ville</option>
                            <option value="Prix">Prix</option>
                        </select>
                        <input type="text" class=" inputsearch  col-lg-6 col-md-5 col-sm-6 p-2" id="search" name="recherche" placeholder="Quartier" value="<?php echo $_POST['recherche']; ?>">
                        <button id="send" class="btn btn-primary col-lg-3 col-md-2 col-sm-3 ml-lg-2 px-0" name="search">Rechercher</button>
                    </form>
                    </p>
                <?php        } else {    ?>
                    <p>
                    <form action="search.php" class=" d-flex flex-column flex-sm-row w-100 gap-2  justify-content-center" method="post">
                        <select name="type" class=" inputsearch col-lg-4 col-md-4 col-sm-6 p-2" id="country" required>
                            <option value="">Choisir...</option>
                            <option value="Quartier"> Quartier</option>
                            <option value="Ville">Ville</option>
                            <option value="Prix">Prix</option>
                        </select>
                        <input type="text" class=" inputsearch  col-lg-6 col-md-5 col-sm-6 p-2" id="search" name="recherche" placeholder="Quartier">
                        <button id="send" class="btn btn-primary col-lg-3 col-md-2 col-sm-3 ml-lg-2 px-0" name="search">Rechercher</button>
                    </form>
                    </p>
                <?php        }
                ?>

            </div>
        </div>
    </section>
    <main>
        <?php $bdd = new PDO('mysql:host=localhost;dbname=getHouse;charset=utf8', 'root', '');
        if (isset($_POST['recherche'])) { ?>
            <h1 class="text-center text-muted lead mb-2">Résultats : </h1>
        <?php
        }
        ?>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            if (isset($_POST['search'])) {
                if ($_POST['type'] == "Quartier") {
                    $requeteGetNotification = $bdd->prepare('SELECT * FROM offre WHERE quartier=?');
                    $requeteGetNotification->execute(array($_POST['recherche']));
                }
                if ($_POST['type'] == "Ville") {
                    $requeteGetNotification = $bdd->prepare('SELECT * FROM offre WHERE ville=?');
                    $requeteGetNotification->execute(array($_POST['recherche']));
                }
                if ($_POST['type'] == "Prix") {
                    $requeteGetNotification = $bdd->prepare('SELECT * FROM offre WHERE prix=?');
                    $requeteGetNotification->execute(array($_POST['recherche']));
                }
            } else {
                $requeteGetNotification = $bdd->prepare('SELECT * FROM offre');
                $requeteGetNotification->execute(array('25'));
            }

            while ($resultats = $requeteGetNotification->fetch()) {
                if (!isset($resultats['ville'])) {
                    echo '<p class="text-center" >Aucune offre trouvée connectez ous pour plud de possibilité</p>';
                }



                $requeteGetNumber = $bdd->prepare('SELECT number FROM user WHERE id=? AND nom=?');
                $requeteGetNumber->execute(array($resultats['idAuteur'], $resultats['nomAuteur']));
                $results = $requeteGetNumber->fetch(); ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <?php
                        $raison = 'imagePrincipale';
                        $requeteGetThePrincipalImage = $bdd->prepare('SELECT * FROM imagesdemande WHERE idRequete=? AND raison=? ORDER BY id LIMIT 1');
                        $requeteGetThePrincipalImage->execute(array($resultats['id'], $raison));
                        $resultGetThePrincipalImage = $requeteGetThePrincipalImage->fetch();
                        if (isset($resultGetThePrincipalImage['bin'])) {
                        ?>
                            <img width="100%" height="225" src="php/<?php echo $resultGetThePrincipalImage['bin']; ?>" alt="images chambre à louer" class="principalImage">
                        <?php } else { ?>
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Images</text>
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
                                        <form method="get" style="margin:0px;padding:0px;" action="notificationPlus.php">
                                            <a href="login.php" class="btn btn-sm btn-outline-secondary">Connexion</a>
                                            <a href="signUp.php" class="btn btn-sm btn-outline-secondary">Inscription</a>
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
                            <input name="idAuteur" class="hide" type="text" value="<?php echo $resultats['idAuteur']; ?>">
                            <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultats['nomAuteur']; ?>">
                            <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultats['prenomAuteur']; ?>">
                            <input name="typeDeChambre" class="hide" type="text" value="<?php echo $resultats['typeDeChambre']; ?>">
                            <input name="quartier" class="hide" type="text" value="<?php echo $resultats['quartier']; ?>">
                            <input name="number" class="hide" type="text" value="<?php echo $results['number']; ?>">
                            <input name="prix" class="hide" type="text" value="<?php echo $resultats['prix']; ?>">
                            <input name="ville" class="hide" type="text" value="<?php echo $resultats['ville']; ?>">
                            <input name="demande" class="hide" type="text" value="<?php echo $resultats['typeDemande']; ?>">
                            <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $resultats['IndicationParticulaire']; ?>">
                            <input name="socialSituation" class="hide" type="text" value="<?php echo $resultats['socialSituation']; ?>">
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
    </main>
    <div class="mt-5"></div>
    <footer class="container text-center border-top mt-2">
        <p>&copy; 2024 BéninHome &middot;</p>
    </footer>
</body>

</html>