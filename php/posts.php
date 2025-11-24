<?php require('includes/require.php');



?>
<?php
if (isset($_GET['specialId']) && isset($_GET['idPost'])) {
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
        <title>BéniHome</title>
        <link rel="stylesheet" href="../style/homePageStyle.css">
        <style>
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

            button.setting {
                display: inline-block;
                border: none;
                width: 49%;
            }

            .delComment {
                text-align: left;
                position: relative;
                right: 95%;
                border: none;
                background: none;
                padding: 0;
                margin: 0;
                color: #555;
            }
            path.userPath {
    fill: #f8f9fa;
}
svg.userSvg {
    height: 37px;
    margin-top: 13px;
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
}
.circle {
    width: 50px;
    height: 50px;
    background: #555;
    border-radius: 50%;
    text-align: center;
    display: inline-block;
}
#addPictures1{
    display:inline-block;
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
            <link rel="stylesheet" href="../style/bootstrap.min.css">
        <?php
        }
        ?>
    </head>
    <?php require('includes/navbar.php'); ?>
    <?php

    ?>

    <body class="homePage">
        <br>
        <?php if (isset($_GET['message'])) {   ?>
            <div class="container">
                <div class="text-center">
                    <p class="lead"> <?php echo $_GET['message'];  ?></p>
                    <br>
                    <a href="home.php" qtyle="text-decoration:none;" class="text-primary">Retour</a>
                </div>
            </div>
        <?php
        } ?>
        <div class='container px-0 '>
            <div class="col d-flex justify-content-center  align-items-center px-0 ">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card ">
                        <div class="card-header px-0 pb-0">
                            <?php
                            $requete = $bdd->prepare('SELECT * FROM pulications WHERE id=? AND specialId=?');
                            $requete->execute(array($_GET['idPost'], $_GET['specialId']));
                            $resultGetPost = $requete->fetch();
                            if (!empty($resultGetPost['template'])) {
                            ?>
                                <form action="userProfile.php" method="get" class="post" style="border: none;background: none;padding: 0;margin: 0;">
                                    <?php $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? AND raison=? ');
                                    $requeteCountImage->execute(array($_GET['idAuteur'], $_GET['nomAuteur'], 'profile'));
                                    $imageCount = $requeteCountImage->fetch()['image_count'];

                                    if ($imageCount == 0) { ?>
                                        <!-- <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">  <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>"> -->
                                        <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
                                        <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
                                        <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomAuteur']; ?>">
                                        <button name="checkProfile" class="userPost">
                                            <div class="circle"><svg class="userSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                            48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                                            <div id="addPictures1" class="addPictures1">
                                                <p class="h4" style="margin: 0; display:inline-block;"><?php echo $_GET['nomAuteur'] . ' ' . $_GET['prenomAuteur'] ?></p>
                                        </button>
                    
                        <?php  } else {
                                        $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE idAuteur = ? AND nomAuteur=? AND raison=? ORDER BY id DESC LIMIT 1  ');
                                        $requeteGetImage->execute(array($_GET['idAuteur'], $_GET['nomAuteur'], 'profile'));
                                        while ($result = $requeteGetImage->fetch()) { ?>
                            <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">
                            <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
                            <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
                            <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomAuteur']; ?>">
                            <button name="checkProfile" class="userPost">
                                <img class="userImagePost" src="<?php echo $result['bin']; ?>" alt="image">
                                <p class="h4" style="margin: 0; display:inline-block;"><?php echo $_GET['nomAuteur'] . ' ' . $_GET['prenomAuteur'] ?></p>
                            </button>
                            </form>
                    <?php }
                                    } ?>
                    </div>
                    <div class="card-body" style="padding:0;">
                        <?php if ($resultGetPost['idAuteur'] == $_SESSION['id'] && $resultGetPost['nomAuteur'] == $_SESSION['nom'] && $resultGetPost['prenomAuteur'] == $_SESSION['prenom']) { ?>
                            <div class="setting">
                                <form action="posts.php" method="get">
                                    <input name="idAuteur" class="hide" type="text" value="<?php echo $resultGetPost['idAuteur']; ?>">
                                    <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultGetPost['nomAuteur']; ?>">
                                    <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultGetPost['prenomAuteur']; ?>">
                                    <input name="idPost" class="hide" type="text" value="<?php echo $resultGetPost['id']; ?>">
                                    <input name="specialId" class="hide" type="text" value="<?php echo $resultGetPost['specialId']; ?>">
                                    <input name="date" class="hide" type="text" value="<?php echo $resultGetPost['date']; ?>">
                                    <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                    <input name="template" class="hide" type="text" value="<?php echo $resultGetPost['template']; ?>">
                                    <input name="image" class="hide" type="text" value="<?php echo $resultGetPost['image']; ?>">
                                    <button name="modificationPost" class="setting">Modifier</button>
                                    <button name="supressionPost" class="setting">Supprimer</button>
                                </form>
                            </div>
                        <?php } ?>
                        <div class="postsText">
                            <div class="pubs <?php echo $resultGetPost['template']; ?>">
                                <p style="color: white;"><?php echo $resultGetPost['text']; ?></p>
                            </div>
                        </div>
                    <?php }
                            if (empty($resultGetPost['template'])) { ?>
                        <form action="userProfile.php" method="get">
                            <?php $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ?  AND raison=?');
                                $requeteCountImage->execute(array($_GET['idAuteur'], $_GET['nomAuteur'], 'profile'));
                                $imageCount = $requeteCountImage->fetch()['image_count'];

                                if ($imageCount == 0) { ?>
                                <!-- <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">  <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>"> -->
                                <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
                                <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
                                <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomAuteur']; ?>">
                                <button name="checkProfile" class="userPost">
                                <div class="circle"><svg class="userSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                                    <div id="addPictures1" class="addPictures1"> <img class="userImagePost" src="<?php echo $result['bin']; ?>" alt="image">
                                        <p class="h4" style="margin: 0; display:inline-block;"><?php echo $_GET['nomAuteur'] . ' ' . $_GET['prenomAuteur'] ?></p>
                                </button> 
                    <?php  } else {
                                    $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE idAuteur = ? AND nomAuteur=? AND raison=? ORDER BY id DESC LIMIT 1  ');
                                    $requeteGetImage->execute(array($_GET['idAuteur'], $_GET['nomAuteur'], 'profile'));
                                    while ($result = $requeteGetImage->fetch()) { ?>
                        <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">
                        <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
                        <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
                        <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomAuteur']; ?>">
                        <button name="checkProfile" class="userPost">
                            <img class="userImagePost" src="<?php echo $result['bin']; ?>" alt="image">
                            <p class="h4" style="margin: 0; display:inline-block;"><?php echo $_GET['nomAuteur'] . ' ' . $_GET['prenomAuteur'] ?></p>
                        </button>
                        </form>
                <?php }
                                } ?>
                <?php if ($resultGetPost['idAuteur'] == $_SESSION['id'] && $resultGetPost['nomAuteur'] == $_SESSION['nom'] && $resultGetPost['prenomAuteur'] == $_SESSION['prenom']) { ?>
                    <div class="setting">
                        <form action="posts.php" method="get">
                            <input name="idAuteur" class="hide" type="text" value="<?php echo $resultGetPost['idAuteur']; ?>">
                            <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultGetPost['nomAuteur']; ?>">
                            <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultGetPost['prenomAuteur']; ?>">
                            <input name="idPost" class="hide" type="text" value="<?php echo $resultGetPost['id']; ?>">
                            <input name="specialId" class="hide" type="text" value="<?php echo $resultGetPost['specialId']; ?>">
                            <input name="date" class="hide" type="text" value="<?php echo $resultGetPost['date']; ?>">
                            <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <input name="template" class="hide" type="text" value="<?php echo $resultGetPost['template']; ?>">
                            <input name="image" class="hide" type="text" value="<?php echo $resultGetPost['image']; ?>">
                            <button name="modificationPost" class="setting">Modifier</button>
                            <button name="supressionPost" class="setting">Supprimer</button>
                        </form>
                    </div>
                <?php } ?>
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

                            <button class=" btn btn-primary" name="viewPost">
                                <div class="d-flex justify-content-center  align-items-center">
                                    <p class="lead py-0 my-0 mr-1"><?php
                                                                    // Assurez-vous que $_GET['idPost'] et $_GET['specialId'] sont bien définis et non vides
                                                                    if (isset($_GET['idPost']) && isset($_GET['specialId'])) {
                                                                        // Préparez la requête SQL pour compter le nombre de fois où la colonne 'view' est égale à 'true'
                                                                        $requeteCount = $bdd->prepare('SELECT COUNT(*) AS total FROM view WHERE idPost = ? AND specialId = ? AND view = ?');
                                                                        $requeteCount->execute(array($resultGetPost['id'], $resultGetPost['specialId'], 'true'));
                                                                        $result = $requeteCount->fetch();

                                                                        // Récupérez le résultat du comptage
                                                                        $nombreDeVues = $result['total'];
                                                                        if ($nombreDeVues < 0) {
                                                                            echo 'Vues';
                                                                        } else {
                                                                            echo $nombreDeVues;
                                                                        }
                                                                        // Affichez le nombre de vues

                                                                    }
                                                                    ?></p>
                                    <svg class="ml-1" style="width:25px;  margin-left:5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
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


                            <a class="btn btn-secondary comment-btn" id="btnComments" name="comment">
                                <div class="d-flex justify-content-center  align-items-center">
                                    <p class=" mr-1 lead py-0 my-0">
                                        <?php
                                        // Assurez-vous que $_GET['idPost'] et $_GET['specialId'] sont bien définis et non vides
                                        if (isset($_GET['idPost']) && isset($_GET['specialId'])) {
                                            // Préparez la requête SQL pour compter le nombre de fois où la colonne 'view' est égale à 'true'
                                            $requeteCount = $bdd->prepare('SELECT COUNT(*) AS total FROM coomments WHERE idPost = ? AND specialId = ?');
                                            $requeteCount->execute(array($resultGetPost['id'], $resultGetPost['specialId']));
                                            $result = $requeteCount->fetch();

                                            // Récupérez le résultat du comptage
                                            $nombreDeVues = $result['total'];
                                            if ($nombreDeVues == 0) {
                                                echo 'comments';
                                            } else {
                                                echo $nombreDeVues;
                                            }
                                            // Affichez le nombre de vues

                                        }
                                        ?>
                                    </p>
                                    <svg class="ml-2" style="width:25px; margin-left:5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path style="fill:white;" d="M256 32C114.6 32 0 125.1 0 240c0 49.4 21.5 94.5 57.6 130.7-14.2 37.8-38.8 69.7-70.7 92.7 21.8-6.5 45-14.2 66.3-26 44.3 27.5 99.6 42.6 156.8 42.6 141.4 0 256-93.1 256-208S397.4 32 256 32zm0 352c-54.2 0-102.6-14.5-140.8-40.1l-21.3 12.4 4.8-26.5c-23.1-25.6-35.9-58.2-35.9-93.8 0-81.2 90.5-144 192-144s192 62.8 192 144S346.5 384 256 384z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                </div>




                </form>
            </div>
        </div>
        </div>
        </div>
        <br>

        <!-- Bouton "Commentaires" -->

        <div class="card mt-3 col-lg-6 col-md-6 col-sm-11 p-0" id="commentCard" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
            <div class="card-header">
                <h5 class="card-title">Commentaires</h5>
                <button type="button" style="position: relative;top: -35px;" class="close" aria-label="Fermer" id="closeCommentCard">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="allCommentaires" id="allCommentaires" style="height: 225px;overflow-y: auto;">
                    <?php
                    $requete = $bdd->prepare('SELECT * FROM coomments WHERE idPost=? AND specialId=? ORDER BY id');
                    $requete->execute(array($resultGetPost['id'], $resultGetPost['specialId']));
                    while ($result = $requete->fetch()) {
                    ?>
                        <div class="col-12 mb-4">
                            <div class="card">

                                <div class="card-body <?php if ($_SESSION['nom'] == $result['nomAuteur'] && $_SESSION['prenom'] == $result['prenomAuteur']) {
                                                            echo 'text-right';
                                                        } ?>">
                                    <?php if ($_SESSION['nom'] == $result['nomAuteur'] && $_SESSION['prenom'] == $result['prenomAuteur']) {  ?>
                                        <form action="posts.php" style='height:1px;' method="get">
                                            <input name="idAuteur" class="hide" type="text" value="<?php echo $result['idAuteur']; ?>">
                                            <input name="nomAuteur" class="hide" type="text" value="<?php echo $result['nomAuteur']; ?>">
                                            <input name="prenomAuteur" class="hide" type="text" value="<?php echo $result['prenomAuteur']; ?>">
                                            <input name="idPost" class="hide" type="text" value="<?php echo $result['idPost']; ?>">
                                            <input name="idComment" class="hide" type="text" value="<?php echo $result['id']; ?>">
                                            <input name="specialId" class="hide" type="text" value="<?php echo $result['specialId']; ?>">
                                            <button name="delComment" style="text-align: left;position: relative;right: 97%;border: none;background: none;padding: 0;margin: 0;color: #555;FONT-SIZE: 1.5em;height: 1px;">&times;</button>
                                        </form>
                                    <?php  } ?>
                                    <h5 class="card-title"><?php if ($_SESSION['nom'] == $result['nomAuteur'] && $_SESSION['prenom'] == $result['prenomAuteur']) {
                                                                echo 'Vous';
                                                            } else {
                                                                echo $result['nomAuteur'] . ' ' . $result['prenomAuteur'];
                                                            } ?></h5>
                                    <p class="card-text"><?php echo $result['commentaire']; ?></p>
                                    <p class="card-text"><small class="text-muted"><?php
                                                                                    $oldDate = $result['date'];
                                                                                    $dateEnregistrement = new DateTime($oldDate);
                                                                                    $dateActuelle = new DateTime();
                                                                                    $intervalle = $dateActuelle->diff($dateEnregistrement);

                                                                                    if ($intervalle->d > 0) {
                                                                                        // Si plus d'un jour est passé
                                                                                        $tempsEcoule = $intervalle->d . " j";
                                                                                    } elseif ($intervalle->h > 0) {
                                                                                        // Si plus d'une heure est passée
                                                                                        $tempsEcoule = $intervalle->h . " h";
                                                                                    } elseif ($intervalle->i > 0) {
                                                                                        // Si plus d'une minute est passée
                                                                                        $tempsEcoule = $intervalle->i . " m";
                                                                                    } else {
                                                                                        // Si moins d'une minute est passée
                                                                                        $tempsEcoule = $intervalle->s . " s";
                                                                                    }
                                                                                    echo 'Depuis : ' . $tempsEcoule; ?></small></p>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="card-body ">
                    <form action="posts.php" method="get" class="row align-items-center">
                        <div class="col p-0">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" name="commentaire" id="commentaire" placeholder="Commentaire" required>
                            </div>
                        </div>
                        <div class="col-auto">
                            <input name="idAuteur" class="hide" type="text" value="<?php echo $resultGetPost['idAuteur']; ?>">
                            <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultGetPost['nomAuteur']; ?>">
                            <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultGetPost['prenomAuteur']; ?>">
                            <input name="idPost" class="hide" type="text" value="<?php echo $resultGetPost['id']; ?>">
                            <input name="specialId" class="hide" type="text" value="<?php echo $resultGetPost['specialId']; ?>">
                            <input name="date" class="hide" type="text" value="<?php echo $resultGetPost['date']; ?>">
                            <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <button type="submit" class="btn btn-primary" id="comment" name="comment">Commenter</button>
                        </div>
                    </form>
                </div>
            </div>

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
            <script>
                $(document).ready(function() {
                    // Fonction pour ajouter un clic
                    $("#comment").click(function() {
                        $.ajax({
                            url: "posts.php", // Chemin vers le script PHP qui gère l'ajout de clic
                            method: "GET",
                            success: function(data) {
                                $("#allCommentaires").text(data); // Mettre à jour le nombre de clics affiché
                            }
                        });
                    });
                });
            </script>
    </body>

    </html>
<?php  }

if (isset($_GET['message'])) {   ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style/bootstrap.min.css">
        <script src="../js/bootstrap.bundle.min.js"></script>
        <title>BéniHome</title>
    </head>

    <body>

        <?php require('includes/navbar.php'); ?>
        <div class="container mt-4">
            <div class="text-center">
                <p class="lead"> <?php echo $_GET['message'];  ?></p>
                <br>
                <a href="home.php" qtyle="text-decoration:none;" class="text-primary">Retour</a>
            </div>
        </div>
    </body>

    </html>
<?php
}


?>