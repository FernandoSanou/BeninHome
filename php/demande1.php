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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   

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

        .form3 {
            color: white;
            font-family: Calibri;
            margin-top: 20px;
            border: none;
            display: inline-grid;
            margin-top: 0px;
        }

        .Description {
            height: 414px;
        }

        .Description h1 {
            margin-bottom: 12px;

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

    <body> <?php require('includes/demandesPHP.php'); ?>
        <?php require('includes/navbar.php'); ?>
       
        <br>
        <center class='center1'>
            <div class="container">
                <?php if ($_SESSION['type'] == 'Locataire') { ?>
                <h1>Choissiez le type de demande</h1>
                <form class='form3' action="demande1.php" method="post">
                    <button  name="appartement" disabled  type="button" class="btn btn-lg btn-outline-secondary">Appartement</button>
                    <button name="ChambreALouer" class="btn btn-lg mb-2 mt-2 btn-primary">Chambre a louer</button>
                    <button name="villa" disabled type="button" class="btn btn-lg  btn-outline-secondary">Villa</button>
                </form>

                <?php }
            if ($_SESSION['type'] == 'Proprietaire') { ?>
 <h1>Choissiez le type de offres à proposer</h1>
                <form class='form3 ' action="demande1.php" method="post">
                <button  name="appartement" disabled  type="button" class=" btn btn-lg  btn-outline-secondary">Appartement</button>
                    <button name="ChambreALouer" style="margin: 5px 0px;" class="btn btn-lg mb-2 mt-2 btn-primary">Chambre a louer</button>
                    <button name="villa" disabled type="button" class="btn btn-lg btn-outline-secondary">Villa</button>
                </form>

                <?php }    ?>
                <br><br>
                <a href="home.php" class="getAway1">Retour</a>
            </div>
        </center>
    </body>

</html>