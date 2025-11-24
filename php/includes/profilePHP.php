<?php 


if(isset($_POST['seeImage'])){

header('location: ../php/seeImage.php?seeImage=true');

}

if (isset($_GET['valider'])) {
        // verifier si l'image est bien recu
    if (isset($_FILES['images'])) {
        $informationImage = pathinfo($_FILES['images']['name']);
        $exetionImage = $informationImage['extension'];
        $exetionArray = array('jpg', 'jpeg', 'png', 'gif');
        $adress = '../../images/' . rand() . time() . rand();
        if (in_array($exetionImage, $exetionArray)) {
            move_uploaded_file($_FILES['images']['tmp_name'], $adress);
            $requete = $bdd->prepare('INSERT INTO images(idAuteur,nomAuteur,name, bin, types, size) VALUES (?,?,?,?,?,?)');
            $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_FILES['images']['name'], $adress, $_FILES['images']['type'], $_FILES['images']['size']));
            header('location: ../php/profile.php');
        }
    }else{
    header('location: profile.php?message= pas possible');
    }
}

if (isset($_POST['logOut'])) {
    $_SESSION = [];
    session_destroy();
    header('location: ../php/login.php');
}










?>