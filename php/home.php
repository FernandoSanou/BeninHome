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
    .circle {
    width: 50px;
    height: 50px;
    background: #555;
    border-radius: 50%;
    text-align: center;
    display: inline-block;
}
svg.userSvg {
    height: 37px;
    margin-top: 13px;
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
}
path.userPath {
    fill: #f8f9fa;
}
#addPictures1{
    display:inline-block;
}
    </style>
    <link rel="stylesheet" href="../style/fontawesome.css">
</head>

<body class="homePage">
    <?php
  
    require('includes/navbar.php');

    ?>
    <br><br>


    <section class="py-0 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">BéniHome</h1>
                <p class="lead text-muted">
                    <?php if ($_SESSION['type'] == "Locataire") { ?>
                <p class="offres">Explorez et trouvez les offres de logements qui correspondent à vos besoins.</p><br>
                </p>
                <p>
                    <a href="demande1.php" class="btn btn-primary my-2">Recherchez des offres</a>
                    <a href="addPost.php" class="btn btn-secondary my-2">Publication</a>
                </p>
                <?php } ?>
                <?php if ($_SESSION['type'] == "Proprietaire") { ?>
                <p class="offres">Publiez vos offres de logement pour trouver vos futurs locataires.</p><br>
                </p>
                <p>
                    <a href="demande1.php" class="btn btn-primary my-2">Proposez des offres</a>
                    <a href="addPost.php" class="btn btn-secondary my-2">Publication</a>
                </p>
                <?php } ?>

            </div>
        </div>
    </section>


    <br>
    <main>

        <div class="album py-5 bg-light">
            <div class="container" id="offer">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php
                    $requeteGetNotification = $bdd->prepare('SELECT * FROM offre ORDER BY id  DESC');
                    $requeteGetNotification->execute(array($_SESSION['id']));
                    while ($resultats = $requeteGetNotification->fetch()) {

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
                                                <?php if ($_SESSION['id'] == $resultats['idAuteur'] && $_SESSION['nom'] == $resultats['nomAuteur']) { ?>
                                                <button name="checkOffre"
                                                    class="btn btn-sm btn-outline-secondary">Voir</button>
                                                <button name="modification"
                                                    class="btn btn-sm btn-outline-secondary">Modifier</button>
                                                <?php } else { ?>
                                                <button name="checkOffre"
                                                    class="btn btn-sm btn-outline-secondary">Voir</button>
                                                <!-- <button name="modification" type="button" class="btn btn-sm btn-outline-secondary">Modifier</button> -->

                                                <?php } ?>
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

                                                    // echo $tempsEcoule;


                                                    // $oldDate=$resultats['date'];
                                                    // $dateEnregistrement = new DateTime($oldDate);
                                                    // $dateActuelle = new DateTime();
                                                    // $intervalle = $dateActuelle->diff($dateEnregistrement);
                                                    // if ($intervalle->s > 60) {
                                                    //     $tempsEcoule = $intervalle->i . " m";
                                                    // } elseif ($intervalle->i > 60) {
                                                    //     $tempsEcoule = $intervalle->d . " j";
                                                    // } else {
                                                    // 
                                                    //     $tempsEcoule = $intervalle->s . " s";
                                                    // }
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


    </main>
    <div class='container px-0 '>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
                $requete = $bdd->prepare('SELECT * FROM pulications  ORDER BY id DESC');
                $requete->execute(array($_SESSION['id']));
                while ($resultGetPost = $requete->fetch()) {
                ?>
            <div class="col">
                <div class="card my-1">
                    <div class="card-header px-0 pb-0">
                        <?php

                            if (!empty($resultGetPost['template'])) {
                            ?>
                        <form action="userProfile.php" method="get" class="post"
                            style="border: none;background: none;padding: 0;margin: 0;">
                            <?php $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? AND raison=?');
                                    $requeteCountImage->execute(array($resultGetPost['idAuteur'], $resultGetPost['nomAuteur'],'profile'));
                                    $imageCount = $requeteCountImage->fetch()['image_count'];

                                    if ($imageCount == 0) { ?>
                            <!-- <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">  <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>"> -->
                            <input name="idCorrespondant" class="hide" type="text"
                                value="<?php echo $resultGetPost['idAuteur']; ?>">
                            <input name="nomCorrespondant" class="hide" type="text"
                                value="<?php echo $resultGetPost['nomAuteur']; ?>">
                            <input name="prenomCorrespondant" class="hide" type="text"
                                value="<?php echo $resultGetPost['prenomAuteur']; ?>">
                            <button name="checkProfile" class="userPost">
                            <div class="circle"><svg class="userSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                            48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                                <div id="addPictures1" class="addPictures1">
                                    <p class="h5" style="margin: 0; display:inline-block;">
                                        <?php echo $resultGetPost['nomAuteur'] . ' ' . $resultGetPost['prenomAuteur'] ?>
                                    </p>
                            </button>
                    <?php  } else {
                                        $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE idAuteur = ? AND raison=? ORDER BY id DESC LIMIT 1  ');
                                        $requeteGetImage->execute(array($resultGetPost['idAuteur'],'profile'));
                                        $result = $requeteGetImage->fetch(); ?>
                    <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">
                    <input name="idCorrespondant" class="hide" type="text"
                        value="<?php echo $resultGetPost['idAuteur']; ?>">
                    <input name="nomCorrespondant" class="hide" type="text"
                        value="<?php echo $resultGetPost['nomAuteur']; ?>">
                    <input name="prenomCorrespondant" class="hide" type="text"
                        value="<?php echo $resultGetPost['prenomAuteur']; ?>">
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
                    <form action="userProfile.php" method="get">
                        <?php $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? AND raison=?');
                                $requeteCountImage->execute(array($resultGetPost['idAuteur'], $resultGetPost['nomAuteur'],'profile'));
                                $imageCount = $requeteCountImage->fetch()['image_count'];

                                if ($imageCount == 0) { ?>
                        <!-- <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">  <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>"> -->
                        <input name="idCorrespondant" class="hide" type="text"
                            value="<?php echo $resultGetPost['idAuteur']; ?>">
                        <input name="nomCorrespondant" class="hide" type="text"
                            value="<?php echo $resultGetPost['nomAuteur']; ?>">
                        <input name="prenomCorrespondant" class="hide" type="text"
                            value="<?php echo $resultGetPost['prenomAuteur']; ?>">
                        <button name="checkProfile" class="userPost">
                        <div class="circle"><svg class="userSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                        48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                            <div id="addPictures1" class="addPictures1">
                                <p class="h5" style="margin: 0; display:inline-block;">
                                    <?php echo $resultGetPost['nomAuteur'] . ' ' . $resultGetPost['prenomAuteur'] ?></p>

                        </button>
                <?php  } else {
                                    $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE idAuteur = ?  AND nomAuteur =? AND raison=? ORDER BY id DESC LIMIT 1  ');
                                    $requeteGetImage->execute(array($resultGetPost['idAuteur'],$resultGetPost['nomAuteur'],'profile'));
                                    $result = $requeteGetImage->fetch(); ?>
                <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">
                <input name="idCorrespondant" class="hide" type="text"
                    value="<?php echo $resultGetPost['idAuteur']; ?>">
                <input name="nomCorrespondant" class="hide" type="text"
                    value="<?php echo $resultGetPost['nomAuteur']; ?>">
                <input name="prenomCorrespondant" class="hide" type="text"
                    value="<?php echo $resultGetPost['prenomAuteur']; ?>">
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
                        <img style="  width: 100%;max-height: 250px;" src="<?php echo $resultGetPost['image'];  ?>"
                            alt="image indisponible">
                    </div>

                </div>
                <?php } ?>
            </div>
            <div class="card-footer text-muted">
                <form action="posts.php" method="get">
                    <div class="actionPost text-center">
                        <input name="idAuteur" class="hide" type="text"
                            value="<?php echo $resultGetPost['idAuteur']; ?>">
                        <input name="nomAuteur" class="hide" type="text"
                            value="<?php echo $resultGetPost['nomAuteur']; ?>">
                        <input name="prenomAuteur" class="hide" type="text"
                            value="<?php echo $resultGetPost['prenomAuteur']; ?>">
                        <input name="idPost" class="hide" type="text" value="<?php echo $resultGetPost['id']; ?>">
                        <input name="specialId" class="hide" type="text"
                            value="<?php echo $resultGetPost['specialId']; ?>">
                        <input name="date" class="hide" type="text" value="<?php echo $resultGetPost['date']; ?>">
                        <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <button class=" btn btn-primary" name="vues">
                            <div class="d-flex justify-content-center  align-items-center">
                                <p class="lead py-0 my-0 mr-1">Aller</p>
                                <svg class="ml-1" style="width:25px;" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512">
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
    <?php } ?>
    </div>
    </div>
    <br>
    <div class="card mt-3" id="commentCard"
        style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
        <div class="card-header">
            <h5 class="card-title">Commentaires</h5>
            <button type="button" style="position: relative;top: -35px;" class="close" aria-label="Fermer"
                id="closeCommentCard">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="allCommentaires" style="height: 225px;overflow-y: auto;">
                <?php
                $requete = $bdd->prepare('SELECT * FROM coomments WHERE idPost=? AND specialId=?');
                $requete->execute(array($resultGetPost['id'], $resultGetPost['specialId']));
                while ($result = $requete->fetch()) {
                ?>
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body <?php if ($_SESSION['nom'] == $result['nomAuteur'] && $_SESSION['prenom'] == $result['prenomAuteur']) {
                                                        echo 'text-right';
                                                    } ?>">
                            <h5 class="card-title"><?php if ($_SESSION['nom'] == $result['nomAuteur'] && $_SESSION['prenom'] == $result['prenomAuteur']) {
                                                            echo 'Vous';
                                                        } else {
                                                            echo $result['nomAuteur'] . ' ' . $result['prenomAuteur'];
                                                        } ?></h5>
                            <p class="card-text"><?php echo $result['commentaire']; ?></p>
                            <p class="card-text"><small
                                    class="text-muted"><?php echo 'Depuis ' . $result['date']; ?></small></p>
                        </div>
                    </div>
                </div>
                <?php }
                ?>
            </div>
        </div>
    </div>

 



    <a href="search.php">
        <div style="position: fixed;right: 30px;bottom: 25px;" class=" btn btn-primary text-md">
            <p class="h5 py-0 my-0">+</p>
        </div>
    </a>
    <section class="py-5 text-center container">
        <p class="lead text-muted">Notre engagement envers la qualité se reflète dans chaque annonce sur BéniHome. Nous
            travaillons pour garantir des informations précises, des transactions sécurisées et une expérience agréable
            pour tous nos utilisateurs.</p>
        <br>
        <p class="lead text-muted">Suivez notre blog et nos mises à jour pour rester informé sur les tendances du
            marché, les conseils de location, et les nouvelles fonctionnalités de BéniHome.</p>
        <div class="Description">
            <h4>En cas de problèmes</h4><a class="contact" href="tel:+22999256476   ">Contactez-nous</a>
        </div>
    </section>
    <br>

    <!-- Lien vers Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

    </script>
    <script>
 
    </script>
</body>

</html>