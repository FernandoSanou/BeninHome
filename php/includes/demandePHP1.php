<?php
if (isset($_GET['modification'])) {
    require('require.php');
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="../style/bootstrap.min.css">
    <style>
        .hide{
            display:none;
            visibility:hidden;
        }
        .contact-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        /* .left {
           
        } */
        .right {
            width: 100%;
            max-width: 400px;
        }
        .hide {
            display: none;
            visibility:hidden
        }
    </style>

</head>

<body class="homePage">
    
        <?php if (isset($_GET['modification'])) { ?>
            <div class="container">
        <div class="contact-box">
                <h2 class="text-center mb-4">Chambre à louer</h2>
            <form action="../notificationPlus.php" enctype="multipart/form-data" class="form-group" method="get">
                        <?php
                        if ($_SESSION['type'] == 'Locataire') {
                            $requete = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur=? AND prenomAuteur=? AND typeDeChambre=? AND quartier=? AND IndicationParticulaire=? AND socialSituation=? ');
                            $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_GET['typeDeChambre'], $_GET['quartier'], $_GET['IndicationParticulaire'], $_GET['socialSituation']));
                            $result = $requete->fetch();
                            $result['id'];
                        }
                        if ($_SESSION['type'] == 'Proprietaire') {
                            $requete = $bdd->prepare('SELECT * FROM offre WHERE idAuteur=? AND nomAuteur=? AND prenomAuteur=? AND typeDeChambre=? AND quartier=? AND IndicationParticulaire=? AND socialSituation=? ');
                            $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_GET['typeDeChambre'], $_GET['quartier'], $_GET['IndicationParticulaire'], $_GET['socialSituation']));
                            $result = $requete->fetch();
                            // echo  $result['id'];
                        }
                        ?>
                        <div class="form-group">
                        <select id="typeDeChambre" class="form-control" placeholder="Le type de la chambre" name="typeDeChambre" required>
                            <option value="Entré couché">Entré couché</option>
                            <option value="1 chambre 1 salon">1 chambre 1 salon</option>
                            <option value="2 chambres 1 salon">2 chambres 1 salon</option>
                            <option value="3 chambres 1 salon">3 chambres 1 salon</option>
                            <option value="Plus">Plus</option>
                        </select>
                        </div>
                       
                         <div class="form-group"><input name="ville" type="text" class="form-control" placeholder="ville" value="<?php echo $result['ville']; ?>" required></div>
                         <div class="form-group"><input name="prix" type="number" class="form-control" placeholder="Prix   ex:20000" value="<?php echo $_GET['prix']; ?>" required></div>
                         <div class="form-group"><input name="quartier" type="text" class="form-control" value="<?php echo $_GET['quartier']; ?>" placeholder="Quartier"></div>
                       <div class="form-group">
                         <select id="typeDeChambre" placeholder="Indication particuliaire" name="IndicationParticuliaire" class="form-control" required>
                            <option value="Sanitiaire">Sanitiaire</option>
                            <option value="Non Sanitaire">Non Sanitaire</option>
                            <option value="carrelé">carrelé</option>
                            <option value="Non carrelé">Non carrelé</option>
                            <option value="carrelé et Sanitaire">carrelé et Sanitaire</option>
                            <option value="Non carrelé et non sanitaire">Non carrelé et Sanitaire</option>
                            <option value="sanitaire non carrelé">Sanitaire et non Carrelé</option>
                            <option value="nom sanitaire Non carrelé">non Sanitaire et non Carrelé</option>
                        </select>
                    </div>
                        <input type="text" name="type" class="hide" value="<?php echo $_SESSION['type'];  ?>">
                        <input type="text" name="demande" class="hide" value="<?php if (isset($_SESSION['demande'])) {
                                                                                    echo $_SESSION['demande'];
                                                                                } else {
                                                                                    echo  $_GET['demande'];
                                                                                }  ?>">
                     <div class="form-group">
                        <input name="TypeDeProfil" id="socialSituation" class="form-control" type="text" placeholder="Type de profil recherché" onclick="showSmall();" onmouseover="hideSmall();">
                        <small id="hideSmall" class="form-text text-center text-muted">Seul / étudiant / famille / groupe / aucun en particulier</small>
                    </div>
                 
                     <?php if($_SESSION['type'] == 'Proprietaire'){ ?>
                        <div class="form-group text-center">
                        <label class="labelCheckbox" for="checkbox">Je veux changer les images</label>
                        <input class="checkbox" type="checkbox" name="iWillChangePictures"></div>
                        <?php }
                         ?>
                         <?php if($_SESSION['type'] == 'Locataire'){ ?>
                        
                        <?php }
                         ?>
                        <input name="idNotif" class="hide" type="text" value="<?php echo $_GET['idNotif']; ?>">
                        <?php if($_SESSION['type'] == 'Proprietaire'){ ?>
                            <input name="short" class="hide" type="text" value="<?php echo $result['short']; ?>">
                        <?php }
                         ?>
                         <?php if($_SESSION['type'] == 'Locataire'){ ?>
                        
                        <?php }
                         ?>
                    <input type="text" value="true" name="modifications" class="hide">
                    <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
            </form>
            </div>
        </div>
        <?php          } else {   ?>
            <?php if ($_SESSION['type'] == 'Locataire' && $_SESSION['demande'] == 'ChambreALouer') { ?>
             <div class="container">
        <div class="contact-box">
            <div class="left">
                <!-- image en défilement -->
            </div>
            <br>
            <div class="right">
                <h2 class="text-center mb-4">Chambre à louer</h2>
                <form action="notificationPlus.php" enctype="multipart/form-data" class="form-group" method="get">
                    <div class="form-group">
                  
                        <select id="typeDeChambre" class="form-control" name="typeDeChambre" required>
                            <option value="Entré couché">Entré couché</option>
                            <option value="1 chambre 1 salon">1 chambre 1 salon</option>
                            <option value="2 chambres 1 salon">2 chambres 1 salon</option>
                            <option value="3 chambres 1 salon">3 chambres 1 salon</option>
                            <option value="Plus">Plus</option>
                        </select>
                    </div>
                    <input type="hidden" name="type" value="<?php echo $_SESSION['type']; ?>">
                    <input type="hidden" name="demande" value="<?php echo $_SESSION['demande']; ?>">
                    <div class="d-flex justify-content-left">
                
                    <div class="form-group mr-1">
                  
                        <input name="ville" type="text" class="form-control " placeholder="Ville">
                    </div>
                    <div class="form-group ml-1">
                        <input name="quartier" type="text" class="form-control " placeholder="Quartier">
                    </div>
                    </div>
                    <div class="form-group">
                        <input name="prix" type="number" class="form-control" placeholder="Prix (ex: 20000)">
                    </div>
                    <div class="form-group">
                        <select id="IndicationParticuliaire" class="form-control" name="IndicationParticuliaire" required>
                            <option value="Sanitiaire">Sanitiaire</option>
                            <option value="Non Sanitaire">Non Sanitaire</option>
                            <option value="carrelé">Carrelé</option>
                            <option value="Non carrelé">Non carrelé</option>
                            <option value="carrelé et Sanitaire">Carrelé et Sanitaire</option>
                            <option value="Non carrelé et Sanitaire">Non carrelé et Sanitaire</option>
                            <option value="Sanitaire et non Carrelé">Sanitaire et non Carrelé</option>
                            <option value="non Sanitaire et non Carrelé">Non Sanitaire et non Carrelé</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="TypeDeProfil" id="socialSituation" class="form-control" type="text" placeholder="Type de profil recherché" onclick="showSmall();" onmouseover="hideSmall();">
                        <small id="hideSmall" class="form-text text-center text-muted">Seul / étudiant / famille / groupe / aucun en particulier</small>
                    </div>
                    <input name="verified" type="hidden" value="true">
                    <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
                </form>
            </div>
        </div>
    </div>


    </div>

    </div>
<?php }
            if ($_SESSION['type'] == 'Proprietaire' && $_SESSION['demande'] == 'ChambreALouer') { ?>
    <div class="container">
        <div class="contact-box">
            <div class="left">
                <!-- image en défilement -->
            </div>
            <br>
            <div class="right">
                <h2 class="text-center mb-4">Chambre à louer</h2>
                <form action="notificationPlus.php" enctype="multipart/form-data" class="form-group" method="get">
                    <div class="form-group">
                  
                        <select id="typeDeChambre" class="form-control" name="typeDeChambre" required>
                            <option value="Entré couché">Entré couché</option>
                            <option value="1 chambre 1 salon">1 chambre 1 salon</option>
                            <option value="2 chambres 1 salon">2 chambres 1 salon</option>
                            <option value="3 chambres 1 salon">3 chambres 1 salon</option>
                            <option value="Plus">Plus</option>
                        </select>
                    </div>
                    <input type="hidden" name="type" value="<?php echo $_SESSION['type']; ?>">
                    <input type="hidden" name="demande" value="<?php echo $_SESSION['demande']; ?>">
                    <div class="d-flex justify-content-left">
                
                    <div class="form-group mr-1">
                  
                        <input name="ville" type="text" class="form-control " placeholder="Ville">
                    </div>
                    <div class="form-group ml-1">
                        <input name="quartier" type="text" class="form-control " placeholder="Quartier">
                    </div>
                    </div>
                    <div class="form-group">
                        <input name="prix" type="number" class="form-control" placeholder="Prix (ex: 20000)">
                    </div>
                    <div class="form-group">
                        <select id="IndicationParticuliaire" class="form-control" name="IndicationParticuliaire" required>
                            <option value="Sanitiaire">Sanitiaire</option>
                            <option value="Non Sanitaire">Non Sanitaire</option>
                            <option value="carrelé">Carrelé</option>
                            <option value="Non carrelé">Non carrelé</option>
                            <option value="carrelé et Sanitaire">Carrelé et Sanitaire</option>
                            <option value="Non carrelé et Sanitaire">Non carrelé et Sanitaire</option>
                            <option value="Sanitaire et non Carrelé">Sanitaire et non Carrelé</option>
                            <option value="non Sanitaire et non Carrelé">Non Sanitaire et non Carrelé</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="TypeDeProfil" id="socialSituation" class="form-control" type="text" placeholder="Type de profil recherché" onclick="showSmall();" onmouseover="hideSmall();">
                        <small id="hideSmall" class="form-text text-center text-muted">Seul / étudiant / famille / groupe / aucun en particulier</small>
                    </div>
                    <input name="verified" type="hidden" value="true">
                    <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
                </form>
            </div>
        </div>
    </div>


    </div>

    </div>
<?php }
            if ($_SESSION['type'] == 'Locataire' && $_SESSION['demande'] == 'appartement') { ?>
    <form action="notificationPlus.php" enctype="multipart/form-data" method="get">
        <div class="contact-box">

            <div class=" left">

                <!-- <label class="input5" for="image"> Selectionnées des images</label>
                    <input type="file" name="images[]" id="images" multiple accept="image/*"> -->
            </div>

            <div class="right">
                <h2>Appartement</h2>
                <input class="field" type="text" placeholder="Tyde de vila" value="4 chambre 2 salon 2 salle de bain">

                <input name="ville" type="text" class="field" placeholder="ville">
                <input name="quartier" type="text" class="field" placeholder="Quartier">
                <select id="typeDeChambre" placeholder="Indication particulier" name="IndicationParticuliaire" required>
                    <option value="Sanitiaire">Sanitiaire</option>
                    <option value="Non Sanitaire">Non Sanitaire</option>
                    <option value="carrelé">carrelé</option>
                    <option value="Non carrelé">Non carrelé</option>
                    <option value="carrelé">carrelé et Sanitaire</option>
                    <option value="Non carrelé">Non carrelé et Sanitaire</option>
                    <option value="Non carrelé">Sanitaire et non Carrelé</option>
                    <option value="Non carrelé et non carrelé">non Sanitaire et non Carrelé</option>
                </select>
                <input type="text" name="type" class="hide" value="<?php echo $_SESSION['type'];  ?>">
                <input type="text" name="demande" class="hide" value="<?php echo $_SESSION['demande'];  ?>">
                <input name="TypeDeProfil" id="socialSituation" onclick="showSmall();" onmouseover="hideSmall();" type="text" class="field" placeholder="type de profile">
                <small id="hideSmall">Seul / etudiant / famille / groupe </small>
                <input name="verified" class="hide" type="text" value="true">
                <input name="ville" class="hide" type="text" value="<?php echo $_SESSION['id']; ?>">
                <button class="btn">Envoyer</button>
    </form>


    </div>

    </div>
<?php }
            if ($_SESSION['type'] == 'Proprietaire' && $_SESSION['demande'] == 'appartement') { ?>
    <form action="notificationPlus.php" enctype="multipart/form-data" method="get">
        <div class="contact-box">

            <div class="left">
                <!-- 
                    <label class="input5" for="image"> Selectionnées des images</label>
                    <input type="file" name="images[]" id="images" multiple accept="image/*"> -->
            </div>

            <div class="right">
                <h2>Appartement</h2>
                <input type="text" class="field" placeholder="Tyde de vila" value="4 chambre 2 salon 2 salle de bain">

                <input name="ville" type="text" class="field" placeholder="ville">
                <input name="quartier" type="text" class="field" placeholder="Quartier">
                <select id="typeDeChambre" placeholder="Indication particulier" name="IndicationParticuliaire" required>
                    <option value="Sanitiaire">Sanitiaire</option>
                    <option value="Non Sanitaire">Non Sanitaire</option>
                    <option value="carrelé">carrelé</option>
                    <option value="Non carrelé">Non carrelé</option>
                    <option value="carrelé">carrelé et Sanitaire</option>
                    <option value="Non carrelé">Non carrelé et Sanitaire</option>
                    <option value="Non carrelé">Sanitaire et non Carrelé</option>
                    <option value="Non carrelé non Carrelé">non Sanitaire et non Carrelé</option>
                </select>
                <input type="text" name="type" class="hide" value="<?php echo $_SESSION['type'];  ?>">
                <input type="text" name="demande" class="hide" value="<?php echo $_SESSION['demande'];  ?>">
                <input name="TypeDeProfil" id="socialSituation" onclick="showSmall();" onmouseover="hideSmall();" type="text" class="field" placeholder="type de profile recherché">
                <small id="hideSmall">Seul / etudiant / famille / groupe /aucun en pariculier </small>
                <input name="verified" class="hide" type="text" value="true">
                <button class="btn">Envoyer</button>
    </form>


    </div>

    </div>
<?php }


            if ($_SESSION['type'] == 'Locataire' && $_SESSION['demande'] == 'villa') { ?>
    <form action="notificationPlus.php" enctype="multipart/form-data" method="get">
        <div class="contact-box">

            <div class=" left">
                <!-- 
                    <label class="input5" for="image"> Selectionnées des images</label>
                    <input type="file" name="images[]" id="images" multiple accept="image/*"> -->
            </div>
        </div>
        <div class="right">
            <h2>Demande de location de Villa</h2>
            <input type="text" id="typeDeChambre" nmame="typeDeChambre" class="field" placeholder="Tyde de vila" value="4 chambre 2 salon 2 salle de bain">
            <input name="ville" type="text" class="field" placeholder="ville">
            <input name="quartier" type="text" class="field" placeholder="Quartier">
            <select id="typeDeChambre" placeholder="Indication particulier" name="IndicationParticuliaire" required>
                <option value="Sanitiaire">Sanitiaire</option>
                <option value="Non Sanitaire">Non Sanitaire</option>
                <option value="carrelé">carrelé</option>
                <option value="Non carrelé">Non carrelé</option>
                <option value="carrelé">carrelé et Sanitaire</option>
                <option value="Non carrelé">Non carrelé et Sanitaire</option>
                <option value="Non carrelé">Sanitaire et non Carrelé</option>
                <option value="Non carrelé et non carrelé">non Sanitaire et non Carrelé</option>
            </select>
            <input type="text" name="type" class="hide" value="<?php echo $_SESSION['type'];  ?>">
            <input type="text" name="demande" class="hide" value="<?php echo $_SESSION['demande'];  ?>">
            <input name="TypeDeProfil" id="socialSituation" onclick="showSmall();" onmouseover="hideSmall();" type="text" class="field" placeholder="type de profile">
            <small id="hideSmall">Seul / etudiant / famille / groupe </small>
            <input name="verified" class="hide" type="text" value="true">
            <input name="ville" class="hide" type="text" value="<?php echo $_SESSION['id']; ?>">
            <button class="btn">Envoyer</button>
    </form>


    </div>

    </div>
<?php }
            if ($_SESSION['type'] == 'Proprietaire' && $_SESSION['demande'] == 'villa') { ?>

    <div class="contact-box">

        <div class="left">
            <!-- 
                <label class="input5" for="image"> Selectionnées des images</label>
                <input type="file" name="images[]" id="images" multiple accept="image/*"> -->
        </div>

        <div class="right">
            <h2>Offre de location de Villa</h2>
            <form action="notificationPlus.php" enctype="multipart/form-data" method="get">
                <input type="text" class="field" id="typeDeChambre" nmame="typeDeChambre" placeholder="Tyde de vila" value="4 chambre 2 salon 2 salle de bain">
                <input name="ville" type="text" class="field" placeholder="ville">
                <input name="quartier" type="text" class="field" placeholder="Quartier">
                <select id="typeDeChambre" placeholder="Indication particulier" name="IndicationParticuliaire" required>
                    <option value="Sanitiaire">Sanitiaire</option>
                    <option value="Non Sanitaire">Non Sanitaire</option>
                    <option value="carrelé">carrelé</option>
                    <option value="Non carrelé">Non carrelé</option>
                    <option value="carrelé">carrelé et Sanitaire</option>
                    <option value="Non carrelé">Non carrelé et Sanitaire</option>
                    <option value="Non carrelé">Sanitaire et non Carrelé</option>
                    <option value="Non carrelé non Carrelé">non Sanitaire et non Carrelé</option>
                </select>
                <input type="text" name="type" class="hide" value="<?php echo $_SESSION['type'];  ?>">
                <input type="text" name="demande" class="hide" value="<?php echo $_SESSION['demande'];  ?>">
                <input name="TypeDeProfil" id="socialSituation" onclick="showSmall();" onmouseover="hideSmall();" type="text" class="field" placeholder="type de profile recherché">
                <small id="hideSmall">Seul / etudiant / famille / groupe /aucun en pariculier </small>
                <input name="verified" class="hide" type="text" value="true">
                <button class="btn">Envoyer</button>
            </form>


        </div>

    </div>
<?php }

?>

<?php } ?>

</div>

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