<?php
require('includes/require.php');
require('includes/profilePHP.php');

?>

<!DOCTYPE html>
<html lang="fr">

     <head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
<title>BéniHome</title>
          <link rel="stylesheet" href="../style/homePageStyle.css">
          <link rel="stylesheet" href="style.css"> <!-- Ajoutez un fichier CSS pour le style du défilement -->
          <style>
          body {
               margin: 0;
               display: flex;
               justify-content: center;
               /* Centre horizontalement le contenu */
               align-items: center;
               background:black;
          }

          #slider-container {
               width: 100%;
               overflow: hidden;
               position: relative;
          }
          .image {
    width: 350px;
    height: 300px;
    position: relative;
    display: none;
    margin-top: 16%;
 
}

          @media only screen and (max-width: 600px) {
                        .image {
               width: 350px;
               height: 300px;
               position: relative;
               display: none;
               margin-top: 35%;
          } }

          button {
               margin-top: 10px;
          }

          #prevBtn {
    position: fixed;
    left: -2%;
    top: 45%;
    background-color: #ffffff4f;
    border: none;
    transition: .3s;
    margin-left: 5px;
}

          #prevBtn:hover {
               background-color: #ffffff59;
          }

          #prevBtn:hover>.prevIcon {
               fill: black;
          }

          #nextBtn {
               position: fixed;
    right: 0;
    top: 45%;
    background-color: #ffffff4f;
    border: none;
    transition: .3s;
               margin-left: 5px;
          }

          #nextBtn:hover {
               background-color: #ffffff59;
          }

          #nextBtn:hover>.nextIcon {
               fill: black;
          }

          .prevIcon {
               fill: white;
          }

          .nextIcon {
               fill: white;
          }

          .outFleche {
               background-color: #ffffff4d;
               margin: 5px;
               position: fixed;
               top: 0;
               left: 0;
               transition: .3s;
               padding: 0px 5px;
               border-radius: 50%;
          }

          #outFleche {
               fill: white;
          }

          .outFleche:hover {
               background-color: white;
          }

          .outFleche:hover>#outFleche {
               fill: black;
          }

          /* .image {}; */
          </style>
     </head>

     <body class="seeImage">
          <a href="<?php if(isset($_GET['link'])){if(isset($_GET['linkChatProfile'])){echo $_GET['link'].'&'.$_GET['linkChatProfile'];}else{ echo $_GET['link']; }} ?>"><svg class="outFleche" width="25px" height="35px" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512">
                    <path id="outFleche"
                         d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
               </svg></a>
          <!-- ... (votre contenu actuel) ... -->
          
       
  <?php
    if (isset($_GET['seeImageProfile'])) {
        $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE raison=? AND idAuteur = ? AND nomAuteur = ? ORDER BY id DESC');
        $requeteGetImage->execute(array('profile',$_GET['idAuteur'], $_GET['nomAuteur']));
        if ($requeteGetImage->rowCount() > 0) {
            while ($row = $requeteGetImage->fetch()) { ?>
          <img class="image" src="<?php echo $row['bin']; ?>">
          <?php     }
            // Afficher une image par défaut si aucune image n'est trouvée dans la base de données
        } else { ?>
          <img class="image" src='<?php echo $_GET['image']; ?>' alt='Image par défaut'>";
          <?php     } ?>
          <button class="next" onclick="plusSlides(1)" id="prevBtn"><svg class="prevIcon" width="20px" height="50px"
                    xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path id="prevIcon"
                         d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
               </svg></button>
          <button class="prev" onclick="plusSlides(-1)" id="nextBtn"><svg class=" nextIcon" width="20px" height="50px"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path id="nextIcon"
                         d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
               </svg>
          </button>

          <script>
          var slideIndex = 1;
          showSlides(slideIndex);

          function plusSlides(n) {
               showSlides(slideIndex += n);
          }

          function showSlides(n) {
               var i;
               var slides = document.getElementsByTagName("img");
               if (n > slides.length) {
                    slideIndex = 1
               }
               if (n < 1) {
                    slideIndex = slides.length
               }
               for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
               }
               slides[slideIndex - 1].style.display = "block";
          }
          </script>

          <?php
    
}
     if (isset($_GET['seeImageMessage'])) {
       ?>
          <img class="image" src="<?php echo $_GET['image']; ?>" alt='Image par défaut'>
          <?php
    }
    if (isset($_GET['seeOtherImagesOffer'])) { ?>
          <div class="carousel">

               <?php
            $requeteGetImage = $bdd->prepare('SELECT * FROM imagesdemande WHERE idAuteur=? AND nomAuteur=? AND  idRequete=? ORDER BY id');
            $requeteGetImage->execute(array($_GET['idAuteur'], $_GET['nomAuteur'], $_GET['idNotif']));
            // $result = $requeteGetImage->fetchAll(PDO::FETCH_ASSOC);

            if ($requeteGetImage->rowCount() > 0) {
                while ($row = $requeteGetImage->fetch()) { ?>
               <img class="image" src="<?php echo $row['bin']; ?>">
               <?php     }
                // Afficher une image par défaut si aucune image n'est trouvée dans la base de données
            } else { ?>
               <img class="image" src='<?php echo $_GET['binImage']; ?>' alt='Image par défaut'>";
               <?php     } ?>
               <button class="next" onclick="plusSlides(1)" id="prevBtn"><svg class="prevIcon" width="20px"
                         height="50px" xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                         <path id="prevIcon"
                              d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg></button>
               <button class="prev" onclick="plusSlides(-1)" id="nextBtn"><svg class=" nextIcon" width="20px"
                         height="50px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                         <path id="nextIcon"
                              d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                    </svg>
               </button>

               <script>
               var slideIndex = 1;
               showSlides(slideIndex);

               function plusSlides(n) {
                    showSlides(slideIndex += n);
               }

               function showSlides(n) {
                    var i;
                    var slides = document.getElementsByTagName("img");
                    if (n > slides.length) {
                         slideIndex = 1
                    }
                    if (n < 1) {
                         slideIndex = slides.length
                    }
                    for (i = 0; i < slides.length; i++) {
                         slides[i].style.display = "none";
                    }
                    slides[slideIndex - 1].style.display = "block";
               }
               </script>

               <?php
    } else {
        // header('location: home.php');
    }  ?>
     </body>

</html>




<!-- var phrase = "Ceci est une phrase de test pour vérifier sa longueur.";

if (phrase.length > 30) {
    console.log("La phrase est trop longue!");
} else {
    console.log("La phrase est de longueur acceptable.");
}
 
 var phrase = "Ceci est une phrase de test pour vérifier sa longueur.";


$phrase = "Ceci est une phrase de test pour vérifier sa longueur.";

if (strlen($phrase) > 30) {
    echo "La phrase est trop longue!";
} else {
    echo "La phrase est de longueur acceptable.";
}


 -->