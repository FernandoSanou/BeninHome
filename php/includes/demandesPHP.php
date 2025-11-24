<?php
// redirection pour demande residence
if (isset($_POST['appartement'])) {
     $_SESSION['demande'] = 'appartement';
     header('location: demande2.php?demande=appartement&type=' . $_SESSION['type']);
}
// redirection pour demande de chambre a louer
if (isset($_POST['ChambreALouer'])) {
     $_SESSION['demande'] = 'ChambreALouer';
     header('location: demande2.php?demande=chambreALouer&type=' . $_SESSION['type']);
}
// redirection pour demande parcelles
if (isset($_POST['villa'])) {
     $_SESSION['demande'] = 'villa';
     header('location: demande2.php?demande=villa&type=' . $_SESSION['type']);
}


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