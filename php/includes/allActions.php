<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=getHouse;charset=utf8', 'root', '');





if (isset($_GET['viewNotif']) && isset($_GET['idNotif'])) {
    $requete = $bdd->prepare('UPDATE notification SET view=? WHERE id=?');
    $requete->execute(array($_GET['viewNotif'], $_GET['idNotif']));
    // echo'azertyuiuytreza';
}



if (isset($_GET['retrait']) && isset($_GET['typeRetrait'])) {
    // verifier le type du compte
    if ($_SESSION['type'] == 'Locataire') {

        // verifier les options de connexion
        if ($_GET['nom'] == $_SESSION['nom'] && $_GET['prenom'] == $_SESSION['prenom'] && $_GET['password'] == $_SESSION['password']) {
            // recuperation de l'id dans la base de donnees
            $requete = $bdd->prepare('SELECT * FROM demande WHERE idAuteur=? AND nomAuteur=? AND prenomAuteur=? AND typeDeChambre=? AND quartier=? AND IndicationParticulaire=? AND socialSituation=? ');
            $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_GET['typeDeChambre'], $_GET['quartier'], $_GET['IndicationParticulaire'], $_GET['socialSituation']));
            $result = $requete->fetch();
            // supreesion de la demand ou se trouve l'id de la demande

            $requete = $bdd->prepare('DELETE FROM demande WHERE id=?');
            $requete->execute(array($result['id']));
            header('location: notifications.php?message=Votre demande a bien été suprimé');
        } else {
            header('location: demande2.php?&typeDeChambre=' . $_GET['typeDeChambre'] . '&quartier=' . $_GET['quartier'] . '&IndicationParticulaire=' . $_GET['IndicationParticulaire'] . '&socialSituation=' . $_GET['socialSituation'] . '&error=true&message=Information Invalid Reéssayer&verification=true&retrait=true');
        }
    }
    if ($_SESSION['type'] == 'Proprietaire') {

        // verifier les options de connexions
        if ($_GET['nom'] == $_SESSION['nom'] && $_GET['prenom'] == $_SESSION['prenom'] && $_GET['password'] == $_SESSION['password']) {
            // recuperation de l'id dans la base de donnees
            $requete = $bdd->prepare('SELECT * FROM offre WHERE idAuteur=? AND nomAuteur=? AND prenomAuteur=? AND typeDeChambre=? AND quartier=? AND IndicationParticulaire=? AND socialSituation=? ');
            $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_GET['typeDeChambre'], $_GET['quartier'], $_GET['IndicationParticulaire'], $_GET['socialSituation']));
            $result = $requete->fetch();
            // supreesion de la demand ou se trouve l'id de la demande

            $requete = $bdd->prepare('DELETE FROM offre WHERE id=?');
            $requete->execute(array($result['id']));
            header('location: ../notifications.php?message=Votre offre a bien été retiré');
        } else {
            header('location: ../demande2.php?typeDeChambre=' . $_GET['typeDeChambre'] . '&quartier=' . $_GET['quartier'] . '&IndicationParticulaire=' . $_GET['IndicationParticulaire'] . '&socialSituation=' . $_GET['socialSituation'] . '&error=true&message=Information Invalid Reéssayer&verification=true&retrait=true');
        }
    }
}

//authentification de la connexion
if (!isset($_SESSION['id'])) {
    header('Location: ../php/signUp.php');
    exit(); // Ajout de l'instruction exit pour terminer le script après la redirection
} else {
    // conditions a respecter apres verifications

}

// vue et commentaire 

if (isset($_GET['viewPost'])) {
    // Vérifiez si l'enregistrement existe déjà
    $requete = $bdd->prepare('SELECT * FROM view WHERE idAuteur=? AND nomAuteur=? AND prenomAuteur=? AND idPost=? AND specialId=?');
    $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_GET['idPost'], $_GET['specialId']));
    $result = $requete->fetch();

    // Si l'enregistrement existe et que view est 'true', redirigez
    if ($result && $result['view'] == 'true') {
        header('Location: ' . $_GET['link']);
        exit();
    }
    // Sinon, insérez l'enregistrement dans la base de données
    else {
        $date = date('d-m-Y H:i');
        $requete = $bdd->prepare('INSERT INTO view(idAuteur, nomAuteur, prenomAuteur, view, idPost, specialId, date) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], 'true', $_GET['idPost'], $_GET['specialId'], $date));

        // Redirigez après l'insertion
        header('Location: ' . $_GET['link']);
        exit();
    }
}

if (isset($_GET['comment'])) {
    $requete = $bdd->prepare('SELECT * FROM pulications WHERE specialId=? ');
    $requete->execute(array($_GET['specialId']));
    $resultPost = $requete->fetch();
    $date = date('d-m-Y H:i');
    //   inserer le commentaire
    $requete = $bdd->prepare('INSERT INTO coomments(idAuteur, nomAuteur, prenomAuteur, commentaire, idPost, specialId, date) VALUES (?, ?, ?, ?, ?, ?,?)');
    $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_GET['commentaire'], $_GET['idPost'], $_GET['specialId'], $date));

    // insere la notifications 
    if ($resultPost['idAuteur'] == $_SESSION['id'] && $resultPost['nomAuteur'] == $_SESSION['nom']) {
    } else {
        $requete = $bdd->prepare('SELECT * FROM notification WHERE link=? ');
        $requete->execute(array($_GET['link']));
        $resultNotif = $requete->fetch();
        if (isset($resultNotif['idVictim'])) {
            $requete = $bdd->prepare('UPDATE notification SET idAuteur=? AND nomAuteur=? AND  prenomAuteur=? WHERE link=?');
            $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_GET['link']));

        } else {
            $requete = $bdd->prepare('INSERT INTO notification (idAuteur, nomAuteur, prenomAuteur, idVictim, nomVictim, prenomVictim, type,link,date) VALUES (?, ?, ?, ?,?,?, ?, ?,?)');
            $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $resultPost['idAuteur'], $resultPost['nomAuteur'], $resultPost['prenomAuteur'], 'commentaires', $_GET['link'], $date));
            // echo  $resultPost['idAuteur'].'<br>'.$resultPost['nomAuteur'].'<br>'.$resultPost['prenomAuteur'].'<br>'.'commentaires'.'<br>'.$_GET['link'].'<br>'.$date;

        }
    }
                header('Location: posts.php?idAuteur=' . $_GET['idAuteur'] . '&nomAuteur=' . $_GET['nomAuteur'] . '&prenomAuteur=' . $_GET['prenomAuteur'] . '&idPost=' . $_GET['idPost'] . '&specialId=' . $_GET['specialId']); // Redirection vers la page précédente
            exit(); // Terminer le script après la redirection
}

if (isset($_GET['viewNotif'])) {

    $requete = $bdd->prepare('UPDATE notification SET view=? AND globalView=? WHERE id=?');
    $requete->execute(array('true', 'true', $_GET['idNotif']));
}


if (isset($_GET['supressionPost'])) {
    $requete = $bdd->prepare('DELETE FROM pulications WHERE specialId=?');
    $requete->execute(array($_GET['specialId']));
    header('Location: posts.php?message=Votre poste à été suprimer '); // Redirection vers la page précédente

}
if (isset($_GET['modificationPost'])) {
    if (empty($_GET['template'])) {
        header('Location: addImagesPost.php?specialId=' . $_GET['specialId'] . '&modification=true'); // Redirection vers la page précédente
    }
    if (empty($_GET['image'])) {
        header('Location: addTextesPost.php?specialId=' . $_GET['specialId'] . '&template=' . $_GET['template'] . '&modification=true'); // Redirection vers la page précédente
    }

    // header('Location: posts.php?message=Votre posts à été suprimer '); // Redirection vers la page précédente

}

if(isset($_GET['delComment'])){
    $requete = $bdd->prepare('DELETE FROM coomments WHERE id=? AND  idAuteur=? AND nomAuteur=? AND prenomAuteur = ? AND idPost=? AND specialId=?');
    $requete->execute(array($_GET['idComment'],$_GET['idAuteur'],$_GET['nomAuteur'],$_GET['prenomAuteur'],$_GET['idPost'],$_GET['specialId']));
    header('Location: posts.php?idAuteur=' . $_GET['idAuteur'] . '&nomAuteur=' . $_GET['nomAuteur'] . '&prenomAuteur=' . $_GET['prenomAuteur'] . '&idPost=' . $_GET['idPost'] . '&specialId=' . $_GET['specialId']); // Redirection vers la page précédente
}



if (isset($_POST['logOut'])) {
    $requete = $bdd->prepare('UPDATE user SET online=? WHERE id=? AND prenom=?');
    $requete->execute(array('false', $_SESSION['id'], $_SESSION['prenom']));
    $_SESSION = [];
    session_destroy();
    header('location: ../php/login.php');
}


if (empty($_SESSION['type'])) {
    //    code pour afficher les caracteristiques de mon site     
}
