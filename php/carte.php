<?php require('includes/require.php');

if (isset($_GET['retrait'])) {
    header ('location: demande2.php?typeDeChambre=' . $_GET['typeDeChambre'] . '&quartier=' . $_GET['quartier'] . '&IndicationParticulaire=' . $_GET['IndicationParticulaire'] . '&socialSituation=' . $_GET['socialSituation'] . '&type=' . $_GET['type'] . '&verification=true&retrait=true');
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
    <style>

    </style>
</head>

<body class="homePage">
    <?php require('includes/navbar.php');

    ?>

    <br><br>

    <div class='container'>
        <p class="lead text-center">Cette options est en cours de devellopement</p>
    </div><br>
</body>

</html>