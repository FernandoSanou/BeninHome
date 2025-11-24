<?php require('includes/require.php'); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
<title>BéniHome</title>
    <link rel="stylesheet" href="../style/homePageStyle.css">
    <link rel="stylesheet" href="../../style/bootstrap.rtl.min.css">

    <style>
        /* redirection liens */
        .getAway {
            text-decoration: none;
            color: white;
        }

        .navbar {
            position: fixed;
            top: 0;
        }
    </style>
</head>

<body>
    <?php require('includes/navbar.php'); ?>
    <br><br><br>
    <center class='center1'>
        <h1>Création de compte</h1>
        <form class='form3' action="signUp.php" method="post">
            <input class="input" name="nom" type="text" placeholder="Nom"><br>
            <input class="input" name="prenom" type="text" placeholder="Prenom"><br>
            <input class="input" name="email" type="text" placeholder="Email"><br>
            <input class="input" name="number" type="text" placeholder="Numéros"><br>
            <input class="input" name="password1" type="password" placeholder="Password"><br>
            <input class="input" name="password2" type="password" placeholder="Password(Confirm)"><br>
            <button class="button4">Créer un Compte</button>
            <?php
            // verification des mots de passe
            if (isset($_GET['error']) && isset($_GET['message'])) { ?>
                <h3 class='erreur'> <?php echo $_GET['message']; ?></h3>
            <?php }
            if (isset($_GET['sucses']) && isset($_GET['message'])) { ?>
                <h3 class="erreur"> <?php echo $_GET['message']; ?></h3>
            <?php } ?>
        </form><br><br>
        <a href="login.php" class="getAway">Retour</a>
    </center>
</body>

</html>





















<form action="userProfile.php" class="formHome formImageHome" method="get">
    <?php $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? ');
    $requeteCountImage->execute(array($resultats['idAuteur'], $resultats['nomAuteur']));
    $imageCount = $requeteCountImage->fetch()['image_count'];

    if ($imageCount == 0) { ?>
        <!-- <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide"> -->
        <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
        <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultats['nomAuteur']; ?>">
        <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $resultats['prenomAuteur']; ?>">
        <input name="typeDeChambre" class="hide" type="text" value="<?php echo $resultats['typeDeChambre']; ?>">
        <input name="quartier" class="hide" type="text" value="<?php echo $resultats['quartier']; ?>">
        <input name="ville" class="hide" type="text" value="<?php echo $resultats['ville']; ?>">
        <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $resultats['IndicationParticulaire']; ?>">
        <input name="socialSituation" class="hide" type="text" value="<?php echo $resultats['socialSituation']; ?>">
        <input name="date" class="hide" type="text" value="<?php echo $resultats['date']; ?>">
        <input name="demande" class="hide" type="text" value="<?php echo $resultats['typeDemande'] ?>">
        <input name="type" class="hide" type="text" value="<?php echo $resultats['type']; ?>">
        <input name="idNotif" class="hide" type="text" value="<?php echo $resultats['id']; ?>">
        <button name="checkProfile" class="button10">
            <div onmouseover="showIcon();" class="circle"> </div>
            <div id="addPictures1" class="addPictures1">
        </button>
        <?php  } else {
        $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE idAuteur = ? ORDER BY id DESC LIMIT 1  ');
        $requeteGetImage->execute(array($resultats['idAuteur']));
        while ($result = $requeteGetImage->fetch()) { ?>

            <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">
            <input name="idCorrespondant" class="hide" type="text" value="<?php echo $resultats['idAuteur']; ?>">
            <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultats['nomAuteur']; ?>">
            <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $resultats['prenomAuteur']; ?>">
            <input name="typeDeChambre" class="hide" type="text" value="<?php echo $resultats['typeDeChambre']; ?>">
            <input name="quartier" class="hide" type="text" value="<?php echo $resultats['quartier']; ?>">
            <input name="ville" class="hide" type="text" value="<?php echo $resultats['ville']; ?>">
            <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $resultats['IndicationParticulaire']; ?>">
            <input name="socialSituation" class="hide" type="text" value="<?php echo $resultats['socialSituation']; ?>">
            <input name="date" class="hide" type="text" value="<?php echo $resultats['date']; ?>">
            <input name="demande" class="hide" type="text" value="<?php echo $resultats['typeDemande'] ?>">
            <input name="type" class="hide" type="text" value="<?php echo $resultats['type']; ?>">
            <input name="idNotif" class="hide" type="text" value="<?php echo $resultats['id']; ?>">
            <button name="checkProfile" class="button10">
                <img class="imageHome" src="<?php echo $result['bin']; ?>" alt="image">
                <!--?checkOffre=&idAuteur=6&nomAuteur=tom&prenomAuteur=tom&typeDeChambre=2+chambres+1+salon&quartier=osaka&number=53135313&prix=25000&ville=tokyo&demande=ChambreALouer&IndicationParticulaire=Sanitiaire&socialSituation=mangeuse&date=04%2F02%2F2024&type=Proprietaire&idNotif=18&verification=true-->
                <!-- ?idNotif=18&idAuteur=6&nomAuteur=tom&prenomAuteur=tom&typeDeChambre=2+chambres+1+salon&type=Proprietaire&quartier=osaka&ville=tokyo&prix=45000&IndicationParticulaire=Sanitiaire&demande=ChambreALouer&socialSituation=mangeuse&date=04/02/2024&type=&verification=true -->
            </button>
    <?php }
    } ?>
    <div class="userInfo">
        <h3 class="userName">
            <?php echo $resultats['nomAuteur'] . ' ' . $resultats['prenomAuteur']; ?></h3>
    </div>
</form>