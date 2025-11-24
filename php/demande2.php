<?php require('includes/require.php'); ?>
<?php if (isset($_GET['verified']) && isset($_GET['demande'])) {
    require('includes/demandePHP1.php');
} else {

    if (isset($_POST['verificationCompte'])) {
        // enregistrer les donnes des des variables
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $password = $_POST['password'];

        if ($nom == $_SESSION['nom']) {
            if ($prenom == $_SESSION['prenom']) {
                if ($password == $_SESSION['password']) {
                    header('location: demande2.php?verified=true&&demande=' . $_SESSION['demande']);
                } else {
                    header('location: demande2.php?error=ture&message=Mot de passe incorrect');
                }
            } else {
                header('location: demande2.php?error=true&message=Prenom invalid');
            }
        } else {
            header('location: demande2.php?error=true&message=nom invalid');
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

          .Description2 h1 {
               width: 250px;
          }

          .textAligner p {
               font-size: 1.5em;
               width: 261px;
               margin-top: -10px;
          }

          .formulaire1 {
               display: inline-block;
               border: 1px solid #c7c4c4;
               border-radius: 4px;
               padding-top: 0%;
               padding: 0 4px;
               padding-bottom: 10px;

          }

          .btn {
               width: 90%;
               padding: 0.5rem 1rem;
               background-color: #5e7ddb;
               color: #fff;
               font-size: 1.1rem;
               border: none;
               outline: none;
               cursor: pointer;
               transition: .5s;
               border-radius: 3px;
          }
          </style> <?php
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

     <body class="homePage">
          <?php require('includes/navbar.php');
        ?>
          <br>

          <center class='container '>
               <div class="Description2">

                    <?php if (isset($_GET['retrait'])) {

                    if ($_SESSION['type'] == 'Locataire') {
                ?>

<div class="row">
               <!--  d-flex flex-column flex-sm-row w-100 gap-2 -->
            <div class="">
               <div class="col-lg-6 col-md-6 col-sm-12">
                              <p class="h4">Confirmez votre compte pour retirer votre Demande</p>
                              <br>
                              <p class="lead">BéniHome se concentre sur le Bénin, offrant une plateforme
                                   spécialisée pour répondre aux besoins
                                   uniques de la communauté locale en matière de location de chambres.</p>
                         </div>
                         <div class="border-top mt-5 col-7"></div>
                          <div class="col-lg-6 col-md-6 col-sm-12 pt-4 pb-4 pl-4 pr-4">
                              <p class="h5">Approuver votre compte</p>
                              <form action="demande2.php" method="get" class="form6">
                                   <div class="form-group">
                    <input name="nom" type="text" class="form-control profileSettingsInput" placeholder="Nom" required>
                </div>
                <div class="form-group">
                    <input name="prenom" type="text" class="form-control profileSettingsInput" placeholder="Prénom" required>
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control profileSettingsInput" placeholder="Mot de passe" required>
                </div>
                           
                              <?php if (isset($_GET['error']) && isset($_GET['message'])) { echo '<div class="d-flex justify-content-center text-md mb-2  text-left"><small class="text-danger">' . $_GET['message'] . '</small></div>'; } ?>
                              <input name="typeRetrait" type="text" value='Locataire' class="hide">
                              <input name="typeDeChambre" type="text" class="hide"
                                        value="<?php echo $_GET['typeDeChambre']; ?>">
                                   <input name="quartier" type="text" class="hide"
                                        value="<?php echo $_GET['quartier']; ?>">
                                   <input name="IndicationParticulaire" type="text" class="hide"
                                        value="<?php echo $_GET['IndicationParticulaire']; ?>">
                                   <input name="socialSituation" type="text" class="hide"
                                        value="<?php echo $_GET['socialSituation']; ?>">
                                   <input name="typeRetrait" type="text" value='Locataire' class="hide"> 
                <button name="retrait" class="btn btn-primary btn-block profileSettingsButton">Valider</button>
                             <div class="d-flex justify-content-center  text-left"> <small class="text-muted text-center">Approuver pour verifier que c'est bien vous </small></div>

                         </div>
                       </form>
                    <!-- </div>
                              <h2>Approuver votre compte</h2>
                              <form action="includes/allActions.php" method="get" class="form6">
                                   <input name="nom" type="text" class="field" placeholder="Nom">
                                   <input name="prenom" type="text" class="field" placeholder="Prenom">
                                   <input name="password" type="password" class="field" placeholder="password">
                                   <input name="typeRetrait" type="text" value='Locataire' class="hide">
                                   <input name="typeRetrait" type="text" value='Proprietaire' class="hide">
                                   <input name="typeDeChambre" type="text" class="hide"
                                        value="<?php echo $_GET['typeDeChambre']; ?>">
                                   <input name="quartier" type="text" class="hide"
                                        value="<?php echo $_GET['quartier']; ?>">
                                   <input name="IndicationParticulaire" type="text" class="hide"
                                        value="<?php echo $_GET['IndicationParticulaire']; ?>">
                                   <input name="socialSituation" type="text" class="hide"
                                        value="<?php echo $_GET['socialSituation']; ?>">
                                   <button name="retrait" class="btn">Approuver</button>

                              </form>
                              <?php

                                if (isset($_GET['error']) && isset($_GET['message'])) {
                                    echo ' <b style="color:red;">' . $_GET['message'] . '</b> <br>';
                                } ?>
                              <small class="text-muted text-center">Approuver pour verifier que c'est bien vous </small>

                         </div> -->
                    </div>

                    <?php  }
                    if ($_SESSION['type'] == 'Proprietaire') { ?>
                   <div class="row">
               <!--  d-flex flex-column flex-sm-row w-100 gap-2 -->
            <div class="">
               <div class="col-lg-6 col-md-6 col-sm-12">
                              <p class="h4">Confirmez votre compte pour retirer votre Offre</p>
                              <p class="lead">BéniHome se concentre sur le Bénin, offrant une plateforme
                                   spécialisée pour répondre aux besoins
                                   uniques de la communauté locale en matière de location de chambres.</p>
                         </div>
                         <div class="border-top mt-5 col-7"></div>
                          <div class="col-lg-6 col-md-6 col-sm-12 pt-4 pb-4 pl-4 pr-4 border-top">
                              <p class="h5">Approuver votre compte</p>
                              <form action="includes/allActions.php" method="get" class="form6">
                                   <div class="form-group">
                    <input name="nom" type="text" class="form-control profileSettingsInput" placeholder="Nom" required>
                </div>
                <div class="form-group">
                    <input name="prenom" type="text" class="form-control profileSettingsInput" placeholder="Prénom" required>
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control profileSettingsInput" placeholder="Mot de passe" required>
                </div>
                           
                              <?php if (isset($_GET['error']) && isset($_GET['message'])) { echo '<div class="d-flex justify-content-center text-md mb-2  text-left"><small class="text-danger">' . $_GET['message'] . '</small></div>'; } ?>
                              <input name="typeRetrait" type="text" value='Proprietaire' class="hide">
                                   <input name="typeDeChambre" type="text" class="hide"
                                        value="<?php echo $_GET['typeDeChambre']; ?>">
                                   <input name="quartier" type="text" class="hide"
                                        value="<?php echo $_GET['quartier']; ?>">
                                   <input name="IndicationParticulaire" type="text" class="hide"
                                        value="<?php echo $_GET['IndicationParticulaire']; ?>">
                                   <input name="socialSituation" type="text" class="hide"
                                        value="<?php echo $_GET['socialSituation']; ?>">  
                <button name="retrait" class="btn btn-primary btn-block profileSettingsButton">Valider</button>
                             <div class="d-flex justify-content-center  text-left"> <small class="text-muted text-center">Approuver pour verifier que c'est bien vous </small></div>

                         </div>
                       </form>
                    </div>
                         <!-- <div class="formulaire1">
                              <h2>Approuver votre compte</h2>
                              <form action="includes/allActions.php" method="get" class="form6">
                                   <input name="nom" type="text" class="field" placeholder="Nom">
                                   <input name="prenom" type="text" class="field" placeholder="Prenom">
                                   <input name="password" type="password" class="field" placeholder="password">
                                   <input name="typeRetrait" type="text" value='Proprietaire' class="hide">
                                   <input name="typeDeChambre" type="text" class="hide"
                                        value="<?php echo $_GET['typeDeChambre']; ?>">
                                   <input name="quartier" type="text" class="hide"
                                        value="<?php echo $_GET['quartier']; ?>">
                                   <input name="IndicationParticulaire" type="text" class="hide"
                                        value="<?php echo $_GET['IndicationParticulaire']; ?>">
                                   <input name="socialSituation" type="text" class="hide"
                                        value="<?php echo $_GET['socialSituation']; ?>">
                                   <button name="retrait" class="btn">Approuver</button>
                                   <?php //echo $_SESSION['password']; ?>
                              </form>
                              <?php

                                if (isset($_GET['error']) && isset($_GET['message'])) {
                                    echo ' <b style="color:red;">' . $_GET['message'] . '</b> <br>';
                                } ?>
                              <small class="text-muted text-center">Approuver pour verifier que c'est bien vous </small>

                         </div> -->
                    </div>

                    <?Php
                    }
                } else {


                    ?>
                    <?php if ($_SESSION['type'] == 'Locataire' && $_SESSION['demande'] == 'ChambreALouer') { ?>
           <div class="row">
               <!--  d-flex flex-column flex-sm-row w-100 gap-2 -->
            <div class="">
               <div class="col-lg-6 col-md-6 col-sm-12">
                              <p class="h4">Demande de chambre a louer</p>
                              <br>
                              <p class="lead">BéniHome se concentre sur le Bénin, offrant une plateforme
                                   spécialisée pour répondre aux besoins
                                   uniques de la communauté locale en matière de location de chambres.</p>
                      </div>
                      <div class="border-top mt-5 col-7"></div>
                          <div class="col-lg-6 col-md-6 col-sm-12 pt-4 pb-4 pl-4 pr-4 border-top">
                              <p class="h5">Approuver votre compte</p>
                              <form action="demande2.php" method="post" class="form6">
                                   <div class="form-group">
                    <input name="nom" type="text" class="form-control profileSettingsInput" placeholder="Nom" required>
                </div>
                <div class="form-group">
                    <input name="prenom" type="text" class="form-control profileSettingsInput" placeholder="Prénom" required>
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control profileSettingsInput" placeholder="Mot de passe" required>
                </div>
                           
                              <?php

                                if (isset($_GET['error']) && isset($_GET['message'])) {
                                   echo '<div class="d-flex justify-content-center text-md mb-2  text-left"><small class="text-danger">' . $_GET['message'] . '</small></div>';
                                } ?>
                <button name="verificationCompte" class="btn btn-primary btn-block profileSettingsButton">Envoyer</button>
                             <div class="d-flex justify-content-center  text-left"> <small class="text-muted text-center">Approuver pour verifier que c'est bien vous </small></div>

                         </div>
                       </form>
                    </div>
           </div>
          
                  


                    <?php }
                    if ($_SESSION['type'] == 'Proprietaire' && $_SESSION['demande'] == 'ChambreALouer') { ?>
<div class="row">
<!-- d-flex flex-column flex-sm-row w-100 gap-2 -->
            <div class=" ">
               <div class="col-lg-6 col-md-6 col-sm-12">
                              <p class="h4">Offre de chambre a louer</p>
                              <br>
                              <p class="lead">BéniHome se concentre sur le Bénin, offrant une plateforme
                                   spécialisée pour répondre aux besoins
                                   uniques de la communauté locale en matière de location de chambres.</p>
                         </div>
                         <div class="col-lg-6 col-md-6 col-sm-12 pt-4 pb-4 pl-4 pr-4 border-top">
                              <p class="h5">Approuver votre compte</p>
                              <form action="demande2.php" method="post" class="form6">
                                   <div class="form-group">
                    <input name="nom" type="text" class="form-control profileSettingsInput" placeholder="Nom" required>
                </div>
                <div class="form-group">
                    <input name="prenom" type="text" class="form-control profileSettingsInput" placeholder="Prénom" required>
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control profileSettingsInput" placeholder="Mot de passe" required>
                </div>
                           
                              <?php

                                if (isset($_GET['error']) && isset($_GET['message'])) {
                                   echo '<div class="d-flex justify-content-center text-md mb-2  text-left"><small class="text-danger">' . $_GET['message'] . '</small></div>';
                                } ?>
                <button name="verificationCompte" class="btn btn-primary btn-block profileSettingsButton">Envoyer</button>
                             <div class="d-flex justify-content-center  text-left"> <small class="text-muted text-center">Approuver pour verifier que c'est bien vous </small></div>

                         </div>
                       </form>
                    </div>
                    </div>
                    <?php }
                        } ?>
                    <a href="demande1.php" class="text-center">Retour</a>




                    <!-- <h1>Choissiez le type de demande</h1>
        <form class='form3' action="demande.php" method="post">
          
        <button name="demandeParcelle" class="button7">Parcelle</button>
        <button name="demandeChambreALouer" class="button7">Chambre a louer</button>
        <button name="demandeResidence" class="button7">Residence</button>
        </form>

       <br><br>
        <a href="demande1.php" class="getAway1">Retour</a> -->
               </div>
          </center>
          <br>
     </body>

</html>
<?php } ?>