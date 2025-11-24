<?php
require('includes/require.php');
$bdd = new PDO('mysql:host=localhost;dbname=gethouse;charset=utf8', 'root', '');


if (isset($_GET['modifications'])) {

     if ($_SESSION['type'] == 'Locataire') {
         $date = date('d-m-Y H:i');
          $requete = $bdd->prepare('UPDATE demande SET typeDeChambre=? ,quartier=?, ville=? ,IndicationParticulaire=? ,socialSituation=? ,date=? ,type=? WHERE id=?');
          $requete->execute(array($_GET['typeDeChambre'], $_GET['quartier'], $_GET['ville'], $_GET['IndicationParticuliaire'], $_GET['TypeDeProfil'], $date, $_SESSION['type'], $_GET['idNotif']));
          $requeteChangeImageCarac = $bdd->prepare('UPDATE imagesdemande SET  typeDeChambre=? ,quartier=?, ville=? ,IndicationParticulaire=? ,socialSituation=? WHERE id=?');
          $requeteChangeImageCarac->execute(array($_GET['typeDeChambre'], $_GET['quartier'], $_GET['ville'], $_GET['IndicationParticuliaire'], $_GET['TypeDeProfil'], $_GET['idNotif']));
          header('location: notificationPlus.php?&idAuteur=' . $_SESSION['id'] . '&nomAuteur=' . $_SESSION['nom'] . '&prenomAuteur=' . $_SESSION['prenom'] . '&typeDeChambre=' . $_GET['typeDeChambre'] . '&prix=' . $_GET['prix'] . '&type=Locataire&quartier=' . $_GET['quartier'] . '&ville=' . $_GET['ville'] . '&IndicationParticulaire=' . $_GET['IndicationParticuliaire'] . '&demande=' . $_GET['demande'] . '&idNotif='.$_GET['idNotif'].'&socialSituation=' . $_GET['TypeDeProfil'] . '&date=' . $date . '&type=' . $type . '&verification=true');
     }
     if ($_SESSION['type'] == 'Proprietaire') {
         $date = date('d-m-Y H:i');
          $requete = $bdd->prepare('UPDATE offre SET typeDeChambre=? ,quartier=?, ville=? ,IndicationParticulaire=? ,socialSituation=? ,date=? ,type=? WHERE id=?');
          $requete->execute(array($_GET['typeDeChambre'], $_GET['quartier'], $_GET['ville'], $_GET['IndicationParticuliaire'], $_GET['TypeDeProfil'], $date, $_SESSION['type'], $_GET['idNotif']));

          $requeteSelectImage = $bdd->prepare('SELECT * FROM imagesdemande WHERE idRequete=?');
          $requeteSelectImage->execute(array($_GET['idNotif']));
          while ($resultats = $requeteSelectImage->fetch()) {
               $requeteChangeImageCarac = $bdd->prepare('UPDATE imagesdemande SET typeDechambre=?,ville=?,quartier=?,indicationParticuliaire=?,socialSituation=? WHERE idRequete=?');
               $requeteChangeImageCarac->execute(array($_GET['typeDeChambre'], $_GET['quartier'], $_GET['ville'], $_GET['IndicationParticuliaire'], $_GET['TypeDeProfil'], $_GET['idNotif']));
               echo $resultats['id'];
          }
          echo 'ssksskssk';
          // $requeteSelectImage = $bdd->prepare('SELECT * FROM imagesdemande WHERE idRequete=?');
          // $requeteSelectImage->execute(array($_GET['idNotif']));
          // while ($resultats = $requeteSelectImage->fetch()) {
          //     echo $resultats['ville'];
          // }
          echo $_GET['ville'];
          if (isset($_GET['iWillChangePictures'])) {
               $typeDeChambre = $_GET['typeDeChambre'];
               $quartier = $_GET['quartier'];
               $IndicationParticuliaire = $_GET['IndicationParticuliaire'];
               $profil = $_GET['TypeDeProfil'];
               $date = date('d-m-Y H:i');
               $type = 'Proprietaire';
               $nomAuteur = $_SESSION['nom'];
               $prenomAuteur = $_SESSION['prenom'];
               $idAuteur = $_SESSION['id'];
               $demande = $_GET['demande'];

               $_SESSION['typeDeChambre'] = $_GET['typeDeChambre'];
               $_SESSION['quartier'] = $_GET['quartier'];
               $_SESSION['IndicationParticuliaire'] = $_GET['IndicationParticuliaire'];
               $_SESSION['TypeDeProfil'] = $_GET['TypeDeProfil'];
               $_SESSION['date'] = $date;
               $_SESSION['demande'] = $demande;
               $_SESSION['type'] = $type;
               $_SESSION['idNotif'] = $_GET['idNotif'];
               $_SESSION['prix'] = $_GET['prix'];
               $_SESSION['changeImages'] = 'iWillChangePictures';
               header('location:demandeImageRequete.php?idNotif=' . $_GET['idNotif'] . '&idAuteur=' . $idAuteur . '&nomAuteur=' . $nomAuteur . '&prenomAuteur=' . $prenomAuteur . '&typeDeChambre=' . $_GET['typeDeChambre'] . '&demande=' . $_GET['demande'] . '&quartier=' . $quartier . '&ville=' . $_GET['ville'] . '&prix=' . $_GET['prix'] . '&IndicationParticulaire=' . $_GET['IndicationParticuliaire'] . '&socialSituation=' . $profil . '&date=' . $date . '&type=' . $type . '&iWillChangePictures=' . $_GET['iWillChangePictures'] . '&verification=true');
          } else {
               header('location: notificationPlus.php?idNotif=' . $_GET['idNotif'] . '&idAuteur=' . $_SESSION['id'] . '&nomAuteur=' . $_SESSION['nom'] . '&prenomAuteur=' . $_SESSION['prenom'] . '&typeDeChambre=' . $_GET['typeDeChambre'] . '&type=' . $_SESSION['type'] . '&quartier=' . $_GET['quartier'] . '&ville=' . $_GET['ville'] . '&prix=' . $_GET['prix'] . '&IndicationParticulaire=' . $_GET['IndicationParticuliaire'] . '&demande=' . $_GET['demande'] . '&socialSituation=' . $_GET['TypeDeProfil'] . '&date=' . $date . '&verification=true');
          }
          // header('location:notificationsPlus.php?id=' . $SESSION['id'] . '&idAuteur=' . $idAuteur . '&nomAuteur=' . $nomAuteur . '&prenomAuteur=' . $prenomAuteur . '&typeDeChambre=' . $_GET['typeDeChambre'] . '&quartier=' . $quartier . '&IndicationParticulaire=' . $IndicationParticulaire . '&socialSituation=' . $socialSituation . '&date=' . $date . '&type=' . $type . '&verification=true');
     }
}



if (isset($_GET['typeDeChambre']) && isset($_GET['verified'])) {
     if ($_SESSION['type'] == 'Locataire') {


          $typeDeChambre = $_GET['typeDeChambre'];
          $quartier = $_GET['quartier'];
          $IndicationParticuliaire = $_GET['IndicationParticuliaire'];
          $profil = $_GET['TypeDeProfil'];
          $date = date('d-m-Y H:i');
          $type = $_GET['type'];
          $nomAuteur = $_SESSION['nom'];
          $prenomAuteur = $_SESSION['prenom'];
          $idAuteur = $_SESSION['id'];
          $demande = $_GET['demande'];
          $requete = $bdd->prepare('INSERT INTO demande (idAuteur,nomAuteur,prenomAuteur,typeDemande,prix,typeDeChambre, quartier,ville , IndicationParticulaire, socialSituation, date, type) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
          $requete->execute(array($idAuteur, $nomAuteur, $prenomAuteur, $demande, $_GET['prix'], htmlspecialchars($typeDeChambre), htmlspecialchars($quartier), $_GET['ville'], htmlspecialchars($IndicationParticuliaire), htmlspecialchars($profil), $date, $type));


echo $idAuteur.'<br>'.$nomAuteur.'<br>'. $prenomAuteur.'<br>'. $demande.'<br>'. $_GET['prix'].'<br>'.
 htmlspecialchars($typeDeChambre).'<br>'. htmlspecialchars($quartier).'<br>'. $_GET['ville'].'<br>'.
  htmlspecialchars($IndicationParticuliaire).'<br>'. htmlspecialchars($profil).'<br>'. $date.'<br>'. $type;   

          $requeteGetId = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur=? AND prix=? AND typeDeChambre=? AND quartier=? AND ville=?');
$requeteGetId->execute(array($idAuteur, $nomAuteur, $_GET['prix'], htmlspecialchars($typeDeChambre), htmlspecialchars($quartier), $_GET['ville']));
$result = $requeteGetId->fetch();     
// 
$date = date('d-m-Y h:i');
// $link = 'notificationPlus.php?&idAuteur=' . $_SESSION['id'] . '&nomAuteur=' . $_SESSION['nom'] . '&prenomAuteur=' . $_SESSION['prenom'] . '&typeDeChambre=' . $_GET['typeDeChambre'] . '&prix=' . $_GET['prix'] . '&type=' . $_SESSION['type'] . '&quartier=' . $_GET['quartier'] . '&ville=' . $_GET['ville'] . '&IndicationParticulaire=' . $_GET['IndicationParticuliaire'] . '&demande=' . $_GET['demande'] . '&socialSituation=' . $_GET['TypeDeProfil'] . '&date=' . $date . '&type=' . $type . '&verification=true';
// $requete = $bdd->prepare('INSERT INTO notification ( idVictim, nomVictim, prenomVictim, type,link,date) VALUES (?,?,?,?,?,?)');
// $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'],'demande',$link,$date));  
// $requeteGetId = $bdd->prepare('SELECT * FROM offre WHERE idAuteur=? AND nomAuteur=? AND prix=? AND typeDeChambre=? AND quartier=? AND ville=?');
// $requeteGetId->execute(array($idAuteur, $nomAuteur, $_GET['prix'], htmlspecialchars($typeDeChambre), htmlspecialchars($quartier), $_GET['ville']));
// $result = $requeteGetId->fetch();     
header('location: notificationPlus.php?&idAuteur=' . $_SESSION['id'] . '&nomAuteur=' . $_SESSION['nom'] . '&prenomAuteur=' . $_SESSION['prenom'] . '&typeDeChambre=' . $_GET['typeDeChambre'] . '&prix=' . $_GET['prix'] . '&type=' . $_SESSION['type'] . '&quartier=' . $_GET['quartier'] . '&ville=' . $_GET['ville'] . '&IndicationParticulaire=' . $_GET['IndicationParticuliaire'] . '&demande=' . $_GET['demande'] . '&socialSituation=' . $_GET['TypeDeProfil'] . '&date=' . $date . '&type=' . $type . '&verification=true'.'&idNotif='.$result['id']);
     }

     if ($_SESSION['type'] == 'Proprietaire') {

          $typeDeChambre = $_GET['typeDeChambre'];
          $quartier = $_GET['quartier'];
          $IndicationParticuliaire = $_GET['IndicationParticuliaire'];
          $profil = $_GET['TypeDeProfil'];
          $date = date('d-m-Y h:i');
          $type = 'Proprietaire';
          $nomAuteur = $_SESSION['nom'];
          $prenomAuteur = $_SESSION['prenom'];
          $idAuteur = $_SESSION['id'];
          $demande = $_GET['demande']; 
         
                                        

 $url= 'location:notificationPlus.php?idAuteur=' . $idAuteur . '&nomAuteur=' . $nomAuteur . '&prenomAuteur=' . $prenomAuteur . '&typeDeChambre=' . $_GET['typeDeChambre'] . '&demande=' . $_GET['demande'] . '&quartier=' . $quartier . '&ville=' . $_GET['ville'] . '&prix=' . $_GET['prix'] . '&IndicationParticulaire=' . $IndicationParticuliaire . '&socialSituation=' . $profil . '&date=' . $date . '&type=' . $type . '&verification=true';
$short = crypt($url, rand());
echo 'idAuteur: '.$idAuteur.'<BR> nomAuteur: '.$nomAuteur.'<BR> prenomAuteur: '. $prenomAuteur.'<BR> demande: '. $demande.'<BR> prix: '. $_GET['prix'].'<BR> type de demande: '. htmlspecialchars($typeDeChambre).'<BR>quartier : '. htmlspecialchars($quartier).'<BR> ville :'. $_GET['ville'].'<BR> indication particuliaire :'. htmlspecialchars($IndicationParticuliaire).'<BR> profile : '. htmlspecialchars($profil).'<BR> date :  '. $date.'<BR> type :'. $type.'<BR> short : '.$short;
 $requete = $bdd->prepare('INSERT INTO offre(idAuteur,nomAuteur,prenomAuteur,typeDemande, prix,typeDeChambre,quartier,ville , IndicationParticulaire, socialSituation, date, type,short) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
          $requete->execute(array($idAuteur, $nomAuteur, $prenomAuteur, $demande, $_GET['prix'], htmlspecialchars($typeDeChambre), htmlspecialchars($quartier), $_GET['ville'], htmlspecialchars($IndicationParticuliaire), htmlspecialchars($profil), $date, $type,$short));
         
          $requeteGetId = $bdd->prepare('SELECT * FROM offre WHERE idAuteur=? AND nomAuteur=? AND prix=? AND typeDeChambre=? AND quartier=? AND ville=?  AND short=?');
          $requeteGetId->execute(array($idAuteur, $nomAuteur, $_GET['prix'], htmlspecialchars($typeDeChambre), htmlspecialchars($quartier), $_GET['ville'], $short));
          $result = $requeteGetId->fetch();

          $_SESSION['idNotif'] = $result['id'];
          // echo '<br>'.$_SESSION['idNotif'];
          // echo '<br>espese de malade';
          $_SESSION['typeDeChambre'] = $_GET['typeDeChambre'];
          $_SESSION['quartier'] = $_GET['quartier'];
          $_SESSION['IndicationParticuliaire'] = $_GET['IndicationParticuliaire'];
          $_SESSION['TypeDeProfil'] = $_GET['TypeDeProfil'];
          $_SESSION['date'] = $date;
          $_SESSION['demande'] = $demande;
          $_SESSION['type'] = $type;
          $_SESSION['prix'] = $_GET['prix'];
          $_SESSION['short'] = $short;


          header('location:demandeImageRequete.php?idAuteur=' . $idAuteur . '&nomAuteur=' . $nomAuteur . '&prenomAuteur=' . $prenomAuteur . '&typeDeChambre=' . $_GET['typeDeChambre'] . '&demande=' . $_GET['demande'] . '&quartier=' . $quartier . '&ville=' . $_GET['ville'] . '&prix=' . $_GET['prix'] . '&IndicationParticulaire=' . $IndicationParticuliaire . '&socialSituation=' . $profil . '&date=' . $date . '&type=' . $type . '&verification=true');
     }
}
if (isset($_GET['verification'])) {

// recuperation de id de la notif

if ($_SESSION['type'] == 'Locataire') {
     $requete = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur=? AND typeDeChambre=? AND quartier=? AND IndicationParticulaire=? AND socialSituation=? ');
     $requete->execute(array($_SESSION['id'], $_SESSION['nom'],$_GET['typeDeChambre'], $_GET['quartier'], $_GET['IndicationParticulaire'], $_GET['socialSituation']));
     $result = $requete->fetch();
}
if ($_SESSION['type'] == 'Proprietaire') {
     $requete = $bdd->prepare('SELECT * FROM offre WHERE idAuteur=? AND nomAuteur=? AND typeDeChambre=? AND quartier=? AND IndicationParticulaire=? AND socialSituation=? ');
     $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_GET['typeDeChambre'], $_GET['quartier'], $_GET['IndicationParticulaire'], $_GET['socialSituation']));
     $result = $requete->fetch();
}

if(isset($_GET['idNotif'])){
     $idNotif = $_GET['idNotif'];
     if ($_SESSION['type'] == 'Locataire') {
          $requete = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur=? AND id=?');
          $requete->execute(array($_SESSION['id'], $_SESSION['nom'],$_GET['idNotif']));
          $result = $requete->fetch();
     }
     if ($_SESSION['type'] == 'Proprietaire') {
          $requete = $bdd->prepare('SELECT * FROM offre WHERE idAuteur=? AND nomAuteur=? AND id=?');
          $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_GET['idNotif']));
          $result = $requete->fetch();
     }
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
               <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

          <?php
          }
          ?>
          <style>
          button.button10 {
    display: inline-block;
    border: none;
    background: none;
    padding: 0;
    margin: 0;
}
img.imageProfile {
    width: 90px;
    height: 90px;
    border-radius: 50%;
}
.circle{
     width:90px;
     height:90px;
     border-radius:50%;
     background-color:#555;
}
path.userPath {
    fill: white;
}
svg.userSvg {
    height: 78px;
    width: 78px;
    margin-top: 22px;
    border-bottom-right-radius: 25px;
    border-bottom-left-radius: 25px;
}
</style>
     </head>

     <body onclick="hideMenu();" class="homePage">
          <?php require('includes/navbar.php');
          ?>
          <div class="container px-4 py-5" id="icon-grid">

    <form action="userProfile.php" method="get">
     <center>
                         <div class="profile">
                              <div class="pb-2 DESC" style="display: inline-block;">
                              <div class="d-flex justify-content-center">
                                   <?php $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? AND raison=? ');
                                   $requeteCountImage->execute(array($_GET['idAuteur'], $_GET['nomAuteur'],'profile'));
                                   $imageCount = $requeteCountImage->fetch()['image_count'];

                                   if ($imageCount == 0) { ?>
                                        <!-- <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">  <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>"> -->
                                        <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
                                        <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
                                        <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomAuteur']; ?>">
                                        <input name="typeDeChambre" class="hide" type="text" value="<?php echo $_GET['typeDeChambre']; ?>">
                                        <input name="quartier" class="hide" type="text" value="<?php echo $_GET['quartier']; ?>">
                                        <input name="ville" class="hide" type="text" value="<?php echo $_GET['ville']; ?>">
                                        <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                         <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $_GET['IndicationParticulaire']; ?>">
                                        <input name="socialSituation" class="hide" type="text" value="<?php echo $_GET['socialSituation']; ?>">
                                        <input name="date" class="hide" type="text" value="<?php echo $_GET['date']; ?>">
                                        <input name="demande" class="hide" type="text" value="<?php echo $_GET['demande'] ?>">
                                        <input name="type" class="hide" type="text" value="<?php echo $_GET['type']; ?>">
                                        <input name="idNotif" class="hide" type="text" value="<?php echo $result['id']; ?>">
                                        <button name="checkProfile" class="button10">
                                        <div class="circle"><svg class="userSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                         48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                
                                             <div id="addPictures1" class="addPictures1">
                                        </button>
                              </div>



                              <?php  } else {
                                        $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE idAuteur = ? AND raison=? ORDER BY id DESC LIMIT 1  ');
                                        $requeteGetImage->execute(array($_GET['idAuteur'],'profile'));
                                        while ($result = $requeteGetImage->fetch()) { ?>
                                   <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">
                                   <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
                                   <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
                                   <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomAuteur']; ?>">
                                   <input name="typeDeChambre" class="hide" type="text" value="<?php echo $_GET['typeDeChambre']; ?>">
                                   <input name="quartier" class="hide" type="text" value="<?php echo $_GET['quartier']; ?>">
                                   <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                   <input name="ville" class="hide" type="text" value="<?php echo $_GET['ville']; ?>">
                                   <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $_GET['IndicationParticulaire']; ?>">
                                   <input name="socialSituation" class="hide" type="text" value="<?php echo $_GET['socialSituation']; ?>">
                                   <input name="date" class="hide" type="text" value="<?php echo $_GET['date']; ?>">
                                   <input name="demande" class="hide" type="text" value="<?php echo $_GET['demande'] ?>">
                                   <input name="type" class="hide" type="text" value="<?php echo $_GET['type']; ?>">
                                   <input name="idNotif" class="hide" type="text" value="<?php echo $result['id']; ?>">
                                   <button name="checkProfile" class="button10">
                                        <div class="images">
                                             <img class="imageProfile" src="<?php echo $result['bin']; ?>" alt="image">
                                        </div>
                                        </form>
                                   </button>
                         </div>
               <?php }
                                   } ?>
                   <h2 style="display: inline-block; margin:0px;" class=""><?php echo $_GET['nomAuteur'].' '.$_GET['prenomAuteur'] ?></h2>
                   </div>
                   </center>
                   <div class="border-bottom"></div>
                </form>
                <?php 

// verifiez si il existe une notification pour cet offres
$requeteGetNotif = $bdd->prepare('SELECT * FROM notification WHERE idUser=? AND typeNotif=? AND idObject=?');
$requeteGetNotif->execute(array($_SESSION['id'],'newNotif',$_GET['idNotif']));
$resultsGetNotif = $requeteGetNotif->fetch();
$requeteGetOffer = $bdd->prepare('SELECT * FROM offre WHERE id=? AND idAuteur=? AND typeDeChambre=?');
$requeteGetOffer->execute(array($_GET['idNotif'],$_GET['idAuteur'], $_GET['typeDeChambre']));
$resultsGetOffer = $requeteGetOffer->fetch();
// marquer la notification coomme déja lue
if(isset($resultsGetNotif['typeNotif'])){
     $requeteGetNotif = $bdd->prepare('UPDATE notification SET value=? WHERE idUser=? AND typeNotif=? AND idObject=?');
     $requeteGetNotif->execute(array('true',$_SESSION['id'],'newNotif',$_GET['idNotif']));
}
?>

<h3 class="text-primary mt-4 mb-2 text-center">Chambre à louer</h3>
<?php if ($_GET['type'] == 'Proprietaire') { ?>
     <div class="container" style="height: 350px;">
    <div id="carouselExampleIndicators" class="carousel slide" style="height: 350px;" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $raison = 'otherImage';
            $requeteImages = $bdd->prepare('SELECT * FROM imagesdemande WHERE idRequete=? AND raison=? ');
            $requeteImages->execute(array($_GET['idNotif'], $raison));
            $imageCount = $requeteImages->rowCount(); // Nombre d'images dans le carrousel
            for ($i = 0; $i < $imageCount; $i++) {
                $activeClass = ($i == 0) ? "active" : "";
                echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $i . '" class="' . $activeClass . '"></li>';
            }
            ?>
        </ol>
        <div class="carousel-inner" style="height: 350px;">
            <?php
            $i = 0;
            while ($resultGetTheImage = $requeteImages->fetch()) {
                $activeClass = ($i == 0) ? "active" : "";
                $imagePath = $resultGetTheImage['bin'];
                ?>
                <div class="carousel-item <?php echo $activeClass; ?>" style="height: 350px;">
                    <img src="<?php echo $imagePath; ?>" class="d-block w-100" style="height: 350px;" alt="Image <?php echo $i; ?>">
                    <div class="carousel-caption d-md-block">
                        <h5>Nom: <?php echo $_GET['nomAuteur']; ?></h5>
                        <p>Prénom: <?php echo $_GET['prenomAuteur']; ?></p>
                        <p>Type de chambre: <?php echo $_GET['typeDeChambre']; ?></p>
                        <p>Quartier: <?php echo $_GET['quartier']; ?></p>
                        <form action="seeImage.php" method="GET">
                        <input type="hidden" name="idAuteur" value="<?php echo $_GET['idAuteur']; ?>">
                            <input type="hidden" name="nomAuteur" value="<?php echo $_GET['nomAuteur']; ?>">
                             <input type="hidden" name="idNotif" value="<?php echo $_GET['idNotif']; ?>">
                            <input type="hidden" name="prenomAuteur" value="<?php echo $_GET['prenomAuteur']; ?>">
                            <input type="hidden" name="typeDeChambre" value="<?php echo $_GET['typeDeChambre']; ?>">
                            <input type="hidden" name="quartier" value="<?php echo $_GET['quartier']; ?>">
                            <button type="submit" name="seeOtherImagesOffer" class="btn btn-primary">Voir</button>
                            </form>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Précédent</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Suivant</span>
        </a>
    </div>
</div>
<script>
    // Activer le carousel avec JavaScript
    $(document).ready(function(){
        $('#carouselExampleIndicators').carousel();
    });
</script>
<?php } ?>
<div class="border-bottom mt-3"></div>
    <div class="row row-cols-1 row-cols-sm-12 row-cols-md-3 row-cols-lg-4 g-4 py-5">
      <div class="col d-flex align-items-start col-sm-6">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#bootstrap"/></svg>
        <div>
        <h3 class="fw-bold mb-0 fs-4">Type de chambre</h3>
          <p><?php echo $_GET['typeDeChambre']; ?></p>
        </div>
      </div>
      <div class="col d-flex align-items-start col-sm-6">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#cpu-fill"/></svg>
        <div>
          <h3 class="fw-bold mb-0 fs-4">Ville</h3>
          <p><?php echo $_GET['ville'];  ?></p>
        </div>
      </div>
      <div class="col d-flex align-items-start col-sm-6">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#cpu-fill"/></svg>
        <div>
          <h3 class="fw-bold mb-0 fs-4">Quartier</h3>
          <p><?php echo $_GET['quartier'];  ?></p>
        </div>
      </div>
      <div class="col d-flex align-items-start col-sm-6">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#calendar3"/></svg>
        <div>
          <h3 class="fw-bold mb-0 fs-4">Prix</h3>
          <p><?php echo $_GET['prix'] . ' F';  ?></p>
        </div>
      </div>
      <div class="col d-flex align-items-start col-sm-6">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#home"/></svg>
        <div>
          <h3 class="fw-bold mb-0 fs-4">Indication Particulaire</h3>
          <p><?php echo $_GET['IndicationParticulaire']; ?></p>
        </div>
      </div>
      <div class="col d-flex align-items-start col-sm-6">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#speedometer2"/></svg>
        <div>
          <h3 class="fw-bold mb-0 fs-4">Profile</h3>
          <p><?php echo $_GET['socialSituation']; ?></p>
        </div>
      </div>
    <br>
    </div>
    
                           <?php if ($_GET['nomAuteur'] == $_SESSION['nom'] && $_GET['prenomAuteur'] == $_SESSION['prenom']) { ?>
                              <form action="home.php" method="get">
                              <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
                              <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
                              <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomAuteur']; ?>">
                              <input name="typeDeChambre" class="hide" type="text" value="<?php echo $_GET['typeDeChambre']; ?>">
                              <input name="quartier" class="hide" type="text" value="<?php echo $_GET['quartier']; ?>">
                              <input name="ville" class="hide" type="text" value="<?php echo $_GET['ville']; ?>">
                              <input name="prix" class="hide" type="text" value="<?php echo $_GET['prix']; ?>">
                              <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $_GET['IndicationParticulaire']; ?>">
                              <input name="socialSituation" class="hide" type="text" value="<?php echo $_GET['socialSituation']; ?>">
                              <input name="date" class="hide" type="text" value="<?php echo $_GET['date']; ?>">
                              <input name="demande" class="hide" type="text" value="<?php echo $_GET['demande'] ?>">
                              <input name="type" class="hide" type="text" value="<?php echo $_GET['type']; ?>">
                              <input name="short" class="hide" type="text" value="<?php if($_GET['type']=='Proprietaire'){  echo $_GET['short'];  } ?>">
                              <input name="idChat" class="hide" type="text" value="true">
                              <input name="idNotif" class="hide" type="text" value="<?php echo $_GET['idNotif']; ?>">
                              <input name="verification" class="hide" type="text" value="true"><br>   
                              <div class="d-flex justify-content-center">
                              <button class="btn btn-primary mx-2 my-2" name="modification">Modifier <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 2.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-8 8a1 1 0 01-.39.242l-3 1a1 1 0 01-1.287-1.287l1-3a1 1 0 01.242-.39l8-8zM11 5l-8 8-1 3 3-1 8-8 1-1-3 1-1 1z" clip-rule="evenodd"/></svg></button>
            <button class="btn btn-primary mx-2 my-2" name="retrait">Retiré <svg class="bi bi-archive" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1.5 2.75a.25.25 0 01.25-.25h12.5a.25.25 0 01.25.25V4h-13V2.75zm-1 1.75a.75.75 0 01.75-.75h14.5a.75.75 0 01.75.75v.75H.5v-.75zM.5 7v5.75a.25.25 0 00.25.25h13.5a.25.25 0 00.25-.25V7H.5z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M11.5 0a.5.5 0 01.5.5V1h2a1 1 0 011 1v1.25a.75.75 0 01-.75.75h-11a.75.75 0 01-.75-.75V2a1 1 0 011-1h2V.5a.5.5 0 01.5-.5zM5.496 3h5.008a.5.5 0 01.48.648l-1.504 4.512a1.5 1.5 0 01-1.416 1.04h-2.016a1.5 1.5 0 01-1.416-1.04L5.016 3.648A.5.5 0 015.496 3z" clip-rule="evenodd"/></svg></button>
            </div>  <?php         } else { ?>
                                   <form action="chatList.php" method="get">
                              <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
                              <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
                              <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomAuteur']; ?>">
                              <input name="typeDeChambre" class="hide" type="text" value="<?php echo $_GET['typeDeChambre']; ?>">
                              <input name="quartier" class="hide" type="text" value="<?php echo $_GET['quartier']; ?>">
                              <input name="ville" class="hide" type="text" value="<?php echo $_GET['ville']; ?>">
                              <input name="prix" class="hide" type="text" value="<?php echo $_GET['prix']; ?>">
                              <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $_GET['IndicationParticulaire']; ?>">
                              <input name="socialSituation" class="hide" type="text" value="<?php echo $_GET['socialSituation']; ?>">
                              <input name="date" class="hide" type="text" value="<?php echo $_GET['date']; ?>">
                              <input name="demande" class="hide" type="text" value="<?php echo $_GET['demande'] ?>">
                              <input name="type" class="hide" type="text" value="<?php echo $_GET['type']; ?>">
                              <input name="short" class="hide" type="text" value="<?php if($_GET['type']=='Proprietaire'){  echo $_GET['short'];  } ?>">
                              <input name="idChat" class="hide" type="text" value="true">
                              <input name="idNotif" class="hide" type="text" value="<?php echo $_GET['idNotif']; ?>">
                              <input name="verification" class="hide" type="text" value="true"><br>
                              <div class="d-flex justify-content-center">
                              <button class="btn btn-primary my-2" >Chat  <svg style="margin-left:3px;" xmlns="http://www.w3.org/2000/svg" class="c" width="25px" height="25px" viewBox="0 0 512 512">
                                                                 <path style="fill:white;" id="chat" d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 
                        20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4l0 0 0 0 0 0 0 0
                         .3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 
                         326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z" />

                                                            </svg></button>
            <a class="btn btn-primary mr-2 ml-2 my-2" href="tel:+229<?php echo $_GET['number']; ?>">Appeller <svg xmlns="http://www.w3.org/2000/svg"  class="c" width="25px" height="25px" viewBox="0 0 512 512">
               <path style="fill:white;" id="chat" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 
               38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144
                207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg></a>
            <br>
            <a class="btn btn-primary my-2 whatsappButton" href="https://api.whatsapp.com/send?phone=<?php echo $_GET['number']; ?>&text=<?php echo urlencode('Bonjour, je vous écris à propos de cette chambre que vous proposez : ' . $_GET['typeDeChambre'] . ' ' . $_GET['IndicationParticulaire'] . ' situé à ' . $_GET['quartier'] . ' à ' . $_GET['ville'] . '. Je suis moi-même à ' . $_SESSION['ville'] . ' et je cherche une chambre à louer.'); ?>">Whatsapp <svg xmlns="http://www.w3.org/2000/svg" class="c" width="25px" height="25px" viewBox="0
             0 448 512"><path style="fill:white;" id="chat" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 
             17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72
              359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0
               101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5
                4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-
                9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 
                83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg></a>
                              </div>
                              <?php }
                              
                              if($_GET['type']=='Proprietaire'){  ?>
                              <div class="d-flex mt-3 justify-content-center">
<div class="copyLink">
<input type="text" class="hide" id="link" value="<?php echo $resultsGetOffer['short'];   ?>" >
     <div id="copyButton" class="btnLink"><svg class="mr-2" style="width:25px; height:25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path style="fill: #2c2c2c;" d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5
      0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 
      6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 
      0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3
       17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 
       289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 
       34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 
       244.3z"/></svg><h4  style="display: inline-block;" class="link">copiez le lien de l'offre.</h4></div>
</div>
                              </div>
                      <?php  } ?>
                         </form>
                    </div>
          </div>


          <!-- </form> -->
          <!-- </div> -->
          </div>
          </div>
          <br>
                           <br>
                           <div class="d-flex justify-content-center">
                         <h4 class="out text-center"><a class="out" href="<?php if(isset($_GET['link'])){ echo $_GET['link'];}else{ echo 'home.php';} ?>">Retour ></a></h4>
                           </div>
          </center>
          </div>
       
<script>
    document.getElementById('copyButton').addEventListener('click', function() {
        var textarea = document.getElementById('link');
        
        if (textarea.value.trim() !== '') {
            navigator.clipboard.writeText(textarea.value).then(function() {
                alert('Lien copié !');
            }).catch(function(err) {
                console.error('Erreur lors de la copie dans le presse-papier : ', err);
            });
        } else {
            alert('Erreur dans la copie du lien.');
        }
    });
</script>

     </body>

     </html>


<?php    }   ?>