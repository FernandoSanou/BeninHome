<?php
require('includes/require.php');

// verifiez si il existe des images rattachez a cette offre
if (isset($_GET['iWillChangePictures'])) {
    $requeteGetThisOfferInfo = $bdd->prepare('SELECT * FROM imagesdemande WHERE idRequete=? AND idAuteur=? AND nomAuteur=? AND typeDechambre=? AND ville=? AND quartier=? AND indicationParticuliaire=? AND socialSituation=?');
    $requeteGetThisOfferInfo->execute(array($_GET['idNotif'], $_SESSION['id'], $_SESSION['nom'], $_SESSION['typeDeChambre'], $_SESSION['ville'], $_SESSION['quartier'], $_SESSION['IndicationParticuliaire'], $_SESSION['TypeDeProfil']));

    // echo  $resultGetThisOffer['bin'] . ' ' . $_GET['idNotif'] . ' ' .  $_GET['idAuteur'] . ' ' .  $_GET['nomAuteur'] . ' ' .  $_GET['typeDeChambre'] . ' ' .  $_GET['ville'] . ' ' .  $_GET['quartier'] . ' ' .  $_GET['IndicationParticulaire'] . ' ' .  $_GET['socialSituation'];
    $resultGetThisOffer = $requeteGetThisOfferInfo->fetch();
        $requeteDeleteting = $bdd->prepare('DELETE FROM imagesdemande WHERE idRequete=? AND idAuteur=? AND nomAuteur=?');
        $requeteDeleteting->execute(array($_SESSION['idNotif'], $_SESSION['id'], $_SESSION['nom']));
    
}


$requeteGetThisOffer = $bdd->prepare('SELECT * FROM offre WHERE id=? AND idAuteur=? AND nomAuteur=?');
$requeteGetThisOffer->execute(array( $_SESSION['idNotif'],$_SESSION['id'], $_SESSION['nom']));
$resultGetThisOffer = $requeteGetThisOffer->fetch();
// echo $resultGetThisOffer['id'];
//             echo $resultGetThisOffer['id'] ;
//             echo  $_SESSION['id'];
//             echo  $_SESSION['nom'] ;
//             echo   $_SESSION['date'];
//             echo  $_SESSION['typeDeChambre'];
//             echo $_SESSION['ville'] ;
//             echo  $_SESSION['quartier'] ;
//             echo  $_SESSION['IndicationParticuliaire'];
//             echo  $_SESSION['TypeDeProfil'];

if (isset($_POST['validateImage'])) {
    if (isset($_FILES['imagePrincipale'])) {
        echo $_FILES['imagePrincipale']['name'];

        $raison = 'imagePrincipale';
        $informationImage = pathinfo($_FILES['imagePrincipale']['name']);
        $exetionImage = $informationImage['extension'];
        $exetionArray = array('jpg', 'jpeg', 'png', 'gif');
        $adress = '../images/imageOffres/' . time() . rand();
        // echo 'pas mal !!!';
        if (in_array($exetionImage, $exetionArray)) {
            move_uploaded_file($_FILES['imagePrincipale']['tmp_name'], $adress);
            $requete = $bdd->prepare('INSERT INTO imagesdemande (idRequete,raison,idAuteur,nomAuteur,name,bin,size,date,typeDechambre,ville,quartier,indicationParticuliaire,socialSituation,short ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $requete->execute(array($resultGetThisOffer['id'], $raison, $_SESSION['id'], $_SESSION['nom'], $_FILES['imagePrincipale']['name'], $adress, $_FILES['imagePrincipale']['size'], $_SESSION['date'], $_SESSION['typeDeChambre'], $_SESSION['ville'], $_SESSION['quartier'], $_SESSION['IndicationParticuliaire'], $_SESSION['TypeDeProfil'],$resultGetThisOffer['short']));

          }
    }
    if (isset($_FILES['imageArray'])) {
        foreach ($_FILES['imageArray']['name'] as $key => $value) {
            $raison = 'otherImage';
            echo '<br>';
            echo $value;
            $informationImage = pathinfo($_FILES['imageArray']['name'][$key]);
            $exetionImage = $informationImage['extension'];
            $exetionArray = array('jpg', 'jpeg', 'png', 'gif');
            $adress = '../images/imageOffres/' . time() . rand();
            // echo 'pas mal !!!';
            if (in_array($exetionImage, $exetionArray)) {
                move_uploaded_file($_FILES['imageArray']['tmp_name'][$key], $adress);
                $requete = $bdd->prepare('INSERT INTO imagesdemande (idRequete,raison,idAuteur,nomAuteur,name,bin,size,date,typeDechambre,ville,quartier,indicationParticuliaire,socialSituation,short ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                $requete->execute(array($resultGetThisOffer['id'], $raison, $_SESSION['id'], $_SESSION['nom'], $_FILES['imageArray']['name'][$key], $adress, $_FILES['imageArray']['size'][$key], $_SESSION['date'], $_SESSION['typeDeChambre'], $_SESSION['ville'], $_SESSION['quartier'], $_SESSION['IndicationParticuliaire'], $_SESSION['TypeDeProfil'],$resultGetThisOffer['short']));
                echo  'idNotif : '.$_SESSION['idNotif'] . '<br> raison :  ' .  $raison . '<br> idAuteur :  ' .  $_SESSION['id'] . '<br> nomAuteur :  ' .  $_SESSION['nom'] . '<br> name :  ' .  $_FILES['imageArray']['name'][$key] . ' <br> bin : ' .  $adress . ' <BR> taille :  ' .  $_FILES['imageArray']['size'][$key] . ' <br> date : ' .  $_SESSION['date'] . '<br> type de chambre :  ' .  $_SESSION['typeDeChambre'] . '<br> ville :  ' .  $_SESSION['ville'] . '<br> quartier :  ' .  $_SESSION['quartier'] . '<br> indication particuliaire :  ' .  $_SESSION['IndicationParticuliaire'] . ' <br> type de profile : ' .  $_SESSION['TypeDeProfil'].'<br> short : '.$resultGetThisOffer['short'].'<br><br><br>';
                
$link = 'notificationPlus.php?idNotif=' . $resultGetThisOffer['id'] . '&idAuteur=' . $_SESSION['id'] . '&nomAuteur=' . $_SESSION['nom'] . '&prenomAuteur=' . $_SESSION['prenom'] . '&prix=' . $_SESSION['prix'] . '&typeDeChambre=' . $_SESSION['typeDeChambre'] . '&demande=' . $_SESSION['demande'] . '&prix=' . $_SESSION['prix'] . '&quartier=' . $_SESSION['quartier'] . '&ville=' . $_SESSION['ville'] . '&IndicationParticulaire=' . $_SESSION['IndicationParticuliaire'] . '&socialSituation=' . $_SESSION['TypeDeProfil'] . '&date=' . $_SESSION['date'] . '&type=' . $_SESSION['type'] . '&verification=true';
$date = date('d-m-Y H:i');
$requete = $bdd->prepare('INSERT INTO notification (idAuteur, idVictim, nomVictim, prenomVictim, type,link,date) VALUES (?, ?, ?, ?,?,?)');
$requete->execute(array($resultGetThisOffer['id'],$_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'],'offre',$link,$date));
                header('location:notificationPlus.php?idNotif=' . $resultGetThisOffer['id'] . '&idAuteur=' . $_SESSION['id'] . '&nomAuteur=' . $_SESSION['nom'] . '&prenomAuteur=' . $_SESSION['prenom'] . '&prix=' . $_SESSION['prix'] . '&typeDeChambre=' . $_SESSION['typeDeChambre'] . '&demande=' . $_SESSION['demande'] . '&prix=' . $_SESSION['prix'] . '&quartier=' . $_SESSION['quartier'] . '&ville=' . $_SESSION['ville'] . '&IndicationParticulaire=' . $_SESSION['IndicationParticuliaire'] . '&socialSituation=' . $_SESSION['TypeDeProfil'] . '&date=' . $_SESSION['date'] . '&type=' . $_SESSION['type'] . '&short='.$_SESSION['short'].'&verification=true');
               //  header('location:notificationPlus.php?idNotif=' . $resultGetThisOffer['id'] . '&idAuteur=' . $_SESSION['id'] . '&nomAuteur=' . $_SESSION['nom'] . '&prenomAuteur=' . $_SESSION['prenom'] . '&prix=' . $_SESSION['prix'] . '&typeDeChambre=' . $_SESSION['typeDeChambre'] . '&demande=' . $_SESSION['demande'] . '&prix=' . $_SESSION['prix'] . '&quartier=' . $_SESSION['quartier'] . '&ville=' . $_SESSION['ville'] . '&IndicationParticulaire=' . $_SESSION['IndicationParticuliaire'] . '&socialSituation=' . $_SESSION['TypeDeProfil'] . '&date=' . $_SESSION['date'] . '&type=' . $_SESSION['type'] . '&verification=true');

               }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

     <head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="../style/bootstrap.min.css">
          <style>
          * {
               padding: 0;
               margin: 0;
               box-sizing: border-box;
               font-family: calibri;
          }


          /* .container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 100px;
        } */
          /* 
        .container:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background: url("img/bg.jpg") no-repeat center;
            background-size: cover;
            filter: blur(50px);
            z-index: -1;
        } */

          .contact-box {
               max-width: 850px;
               /* display: grid; */
               grid-template-columns: repeat(2, 1fr);
               justify-content: center;
               align-items: center;
               text-align: center;
               background-color: #fff;
               box-shadow: 0px 0px 19px 5px rgba(0, 0, 0, 0.19);
               padding-bottom: 20px;
               padding: 10px;
               width: 450px;
               height: 200px;
          }


          .field {
               width: 100%;
               border: 2px solid rgba(0, 0, 0, 0);
               outline: none;
               background-color: rgba(230, 230, 230, 0.6);
               padding: 0.5rem 1rem;
               font-size: 1.1rem;
               margin-bottom: 22px;
               transition: .3s;
          }

          .field:hover {
               background-color: rgba(0, 0, 0, 0.1);
          }



          textarea {
               min-height: 150px;
          }

          /* .btn {
               width: 80%;
               padding: 0.5rem 1rem;
               background-color: #5e7ddb;
               color: #fff;
               font-size: 1.1rem;
               border: none;
               outline: none;
               cursor: pointer;
               transition: .5s;
          }

          .btn:hover {
               background-color: #4e4181;
          } */

          .field:focus {
               border: 2px solid rgba(30, 85, 250, 0.47);
               background-color: #fff;
          }

          @media screen and (max-width: 880px) {
               .contact-box {
                    grid-template-columns: 1fr;
               }

               .left {
                    height: 200px;
               }
          }

          .hide {
               display: none;
          }



          .Descrition10 {
               text-align: center;
               margin: 0 auto;
               padding: 30px 20px;
               background-color: #fff;
               border-radius: 10px;
               box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
               margin-top: 25px;
               color: #555;
               line-height: 1.6;
               font-size: 1.1em;
               height: auto;
               width: 281px;
          }
          body{
               background-color:#e5e5e5;
          }
          </style>
          <link rel="stylesheet" href="../style/homePageStyle.css">
     </head>

     <body class="homePage"><br>
          <div class="Descrition10">
               <?php if (isset($_GET['phase2'])) {
        }   ?>
               <form class="formImages form-group" action="demandeImageRequete.php" enctype="multipart/form-data" method="post">
                    <h3>Importation des images de la chambre a louer</h3>
                    
                    <label for="images" class="mx-0 my-0 px-0 py-0">L'image principale à importer</label>
                    <input type="file" class="form-control mt-1 mb-2" name="imagePrincipale" id="images">
                   
                    <label for="imageArray[]" class="mx-0 my-0 px-0 py-0 ">Les autre images à importé</label>
                    <input type="file" class="form-control mt-1 mb-2" name="imageArray[]" id="image" multiple accept="image/*">
                   
                    <!-- <input name="idAuteur" type="text" class="hide" value="<?php //echo $_GET['idAuteur']; 
                                                                        ?>">
            <input name="nomAuteur" type="text" class="hide" value="<?php //echo $_GET['nomAuteur']; 
                                                                    ?>">
            <input name="prenomAuteur" type="text" class="hide" value="<?php //echo $_GET['prenomAuteur']; 
                                                                        ?>">
            <input name="typeDeChambre" type="text" class="hide" value="<?php //echo $_GET['typeDeChambre']; 
                                                                        ?>">   -->
                    <input name="demande" type="text" class="hide" value="<?php echo $_SESSION['demande']; ?>">
                    <input name="quartier" type="text" class="hide" value="<?php echo $_SESSION['quartier']; ?>">
                    <input name="ville" type="text" class="hide" value="<?php echo $_SESSION['ville']; ?>">
                    <input name="IndicationParticulaire" type="text" class="hide"
                         value="<?php echo $_SESSION['IndicationParticuliaire']; ?>">
                    <input name="socialSituation" type="text" class="hide"
                         value="<?php echo $_SESSION['TypeDeProfil']; ?>">
                    <input name="date" type="text" class="hide" value="<?php echo $_SESSION['date']; ?>">
                    <input name="type" type="text" class="hide" value="<?php echo $_SESSION['type']; ?>">
                    <input name="verificationImage" type="text" class="hide" value="<?php //echo 'true'; 
                                                                            ?>">

                    <button name="validateImage" class="btn btn-primary btn-block">Envoyer</button>
               </form>


               <?php  ?>

          </div>
          <script>
          var small = document.getElementById('hideSmall');
          var showInput = document.getElementById('socialSituation');

          function showSmall() {
               small.style.display = 'block';
          }

          function hideSmall() {
               small.style.display = 'none';
          }
          </script>
     </body>

</html>