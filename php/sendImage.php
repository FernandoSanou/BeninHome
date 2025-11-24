<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=getHouse;charset=utf8', 'root', '');


if (isset($_POST['validateImage'])) {
    if (isset($_FILES['imagePrincipale'])) {
        echo $_FILES['imagePrincipale']['name'];

        require('includes/require.php');
        echo $_SESSION['linkOfChatForImage'];
        $raison = 'message';
        $informationImage = pathinfo($_FILES['imagePrincipale']['name']);
        $exetionImage = $informationImage['extension'];
        $exetionArray = array('jpg', 'jpeg', 'png', 'gif');
        $adress = '../images/' . time() . rand();
        // echo 'pas mal !!!';
        if (in_array($exetionImage, $exetionArray)) {
            // echo '<br>'.$raison.''.$_SESSION['id'].''. $_SESSION['nom'].''. $_FILES['imagePrincipale']['name'].''. $adress.''.$_FILES['imagePrincipale']['type'].''. $_FILES['imagePrincipale']['size'];
            move_uploaded_file($_FILES['imagePrincipale']['tmp_name'], $adress);
            $requete = $bdd->prepare('INSERT INTO images(raison, idAuteur, nomAuteur, name, bin, types, size) VALUES (?,?,?,?,?,?,?)');
            $requete->execute(array('message', $_SESSION['id'], $_SESSION['nom'], $_FILES['imagePrincipale']['name'], $adress,$_FILES['imagePrincipale']['type'], $_FILES['imagePrincipale']['size']));
            $date = date('d/m/Y');

            $requete = $bdd->prepare('INSERT INTO messages(idAuteur ,nomAuteur,prenomAuteur,idCorrespondant , nomCorrespondant, prenomCorrespondant, message, date) VALUES (?,?,?,?,?,?,?,?)');
            $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_SESSION['idCorrespondant'], $_SESSION['nomCorrespondant'], $_SESSION['prenomCorrespondant'], $adress , $date));
            $dateMessage = date('d-m-Y H:i');
            $requete = $bdd->prepare('UPDATE chat SET lastMessage=? ,date=? WHERE id=?');
            $requete->execute(array($adress, $dateMessage, $_POST['idChat']));
            header('location: '.$_SESSION['linkOfChatForImage']);
          }
    }
    echo $_SESSION['linkOfChatForImage'];
}
 ?>
<!DOCTYPE html>
<html lang="fr">

     <head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

          .btn {
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
          }

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
          </style>
          <link rel="stylesheet" href="../style/homePageStyle.css">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="../style/bootstrap.min.css">
<script src="../js/bootstrap.bundle.min.js"></script>
     </head>

     <body class="homePage">
          <div class="container  text-center">
          <div class="d-flex justify-content-center align-items-center mt-5 pt-5">
          <center>
               <form class="form-group" action="sendImage.php" enctype="multipart/form-data" method="POST">
                    <h3 class="">Importation d'image</h3>
                    <p class="text-muted lead">Veuillez choissir une image a importe dans le chat</p>
                    <input type="file" class="form-control" name="imagePrincipale" id="images">
                    <input name="idMessager" class="hide" type="text" value="<?php $_GET['idMessager'];  ?>">
                                             <input name="prenomMessager" class="hide" type="text" value="<?php $_GET['prenomMessager'];?>">
                                             <input name="nomMessager" class="hide" type="text" value="<?php  $_GET['nomMessager']; ?>">
                                             <input name="idCorrespondant" class="hide" type="text" value="<?php  $_GET['idCorrespondant']; ?>">
                                             <input name="nomCorrespondant" class="hide" type="text" value="<?php  $_GET['nomCorrespondant'];?>">
                                             <input name="prenomCorrespondant" class="hide" type="text" value="<?php  $_GET['prenomCorrespondant']; ?>">
                                             <input name="idChat" class="hide" type="text" value="<?php  $_GET['idChat'];?>">
                                             <input name="link" class="hide" type="text" value="<?php $_SESSION['linkOfChatForImage']; ?>">
                                             <input name="verification" class="hide" type="text" value="true">
                    <input name="verificationImage" type="text" class="hide" value="<?php //echo 'true'; 
                                                                            ?>">

                    <button  style="margin-top:5px;" name="validateImage" class="btn btn-primary mt-3 btn-block">Envoyer</button>
               </form>
               </center> 
               </div>

               <?php    ?>

          </div>
     
     </body>

</html>