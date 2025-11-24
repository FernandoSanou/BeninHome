<?php require('allActions.php');  
// if (isset($_GET['retrait'])) {
//     header ('location: demande2.php?typeDeChambre=' . $_GET['typeDeChambre'] . '&quartier=' . $_GET['quartier'] . '&IndicationParticulaire=' . $_GET['IndicationParticulaire'] . '&socialSituation=' . $_GET['socialSituation'] . '&type=' . $_GET['type'] . '&verification=true&retrait=true');
// }

// if (isset($_GET['modification'])) {
//      header('location: includes/demandePHP1.php?idNotif=' . $_GET['idNotif'] . '&typeDeChambre=' . $_GET['typeDeChambre'] . '&quartier=' . $_GET['quartier'] . '&vile=' . $_GET['ville'] . '&prix=' . $_GET['prix'] . '&IndicationParticulaire=' . $_GET['IndicationParticulaire'] . '&socialSituation=' . $_GET['socialSituation'] . '&type=' . $_GET['type'] . '&demande=' . $_GET['demande'] . '&verification=true&modification=true');
// }

if(empty($_SESSION['type']) && !empty($_SESSION['nom']) && !empty($_SESSION['id'])){
    header('location: obligate.php?guide=true');
}

if (isset($_GET['mdpForgot'])) {
    header('location: ../php/passwordforget.php');
    exit();
  }