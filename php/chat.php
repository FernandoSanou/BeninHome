<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=getHouse;charset=utf8', 'root', '');

?>
<?php

if (isset($_GET['signalmentChatByTtheAdminer']) && isset($_GET['verification'])) {
    // double verification
    if (isset($_SESSION['adminer'])) {
        if ($_SESSION['adminer'] === 'theBoss') {
            if ($_SESSION['nom'] == 'SANOU' && $_SESSION['prenom'] == 'Fernando' && $_SESSION['number'] == '60421373') {  ?>

                <!DOCTYPE html>
                <html lang="fr">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
                    <title>BéniHome</title>
                    <link rel="stylesheet" href="../style/homePageStyle.css">

                </head>

                <body class="homePage">

                    <?php require('includes/navbar.php');

                    ?>

                    <br>

                    <div class='Description7' style="margin-top: 59px;;">

                        <div class="chat">
                            <div class="head">
                                <!-- <div class="photo"></div>    -->
                                <form action="userChatProfile.php" style="width: auto;height: 50px;" method="get">
                                    <button name="checkProfile" class="noBtn">

                                        <div class="photo"> </div>
                                    </button>
                                    <div class="personne">
                                        <span>
                                            <h4>Signalements</h4>
                                        </span>

                                </form>

                            </div>
                            <div class="container">
                                <?php
                                $requeteGetSignalement = $bdd->prepare('SELECT * FROM signalement ORDER BY date DESC');
                                $requeteGetSignalement->execute(array($_SESSION['id']));


                                while ($resultatsGetSignalement = $requeteGetSignalement->fetch()) {
                                    // recupereation des infos de la victim
                                    $requeteGetVictimInfo = $bdd->prepare('SELECT * FROM user WHERE id=? AND nom=?');
                                    $requeteGetVictimInfo->execute(array($resultatsGetSignalement['idVictim'], $resultatsGetSignalement['nomVictim']));
                                    $resultatsGetVictimInfo = $requeteGetVictimInfo->fetch();

                                    // recuperation des infos de l'auteur
                                    $requeteGetAuteurInfo = $bdd->prepare('SELECT * FROM user WHERE id=? AND nom=?');
                                    $requeteGetAuteurInfo->execute(array($resultatsGetSignalement['idAuteur'], $resultatsGetSignalement['nomAuteur']));
                                    $resultatsGetAuteurInfo = $requeteGetAuteurInfo->fetch();

                                    $requeteMakeVue = $bdd->prepare('UPDATE signalement SET vueAdmin=? WHERE vueAdmin=?');
                                    $requeteMakeVue->execute(array('true', 'false'));
                                ?>
                                    <div class="Signalement">Auteur:<?php echo $resultatsGetAuteurInfo['nom'] . ' ' . $resultatsGetAuteurInfo['prenom'] . '<br>'; ?>
                                        Victim:<?php echo $resultatsGetVictimInfo['nom'] . ' ' . $resultatsGetVictimInfo['prenom'] . '<br>'; ?>
                                        Raison:<?php echo $resultatsGetSignalement['raison'] . '<br>'; ?>
                                        Commentaire:<?php echo $resultatsGetSignalement['commentaire'] . '<br>'; ?>
                                        date:<?php echo $resultatsGetSignalement['date'] . '<br>'; ?>
                                    </div>
                                    <div class="footer">
                                        <form action="chat.php" class="input-box" method="get">
                                        </form>
                                    </div>
                                    <?php ?>
                            </div><br>

                </body>

                </html>


        <?php       }
                            }
                        }
                    } else {
                        // header('location: chatList.php');
                    }
                } else {

                    if (isset($_GET['blocking'])) {
                        $requete = $bdd->prepare('INSERT INTO messages(idAuteur ,nomAuteur,prenomAuteur,idCorrespondant , nomCorrespondant, prenomCorrespondant, message, date) VALUES (?,?,?,?,?,?,?,?)');
                        $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_GET['idCorrespondant'], $_GET['nomCorrespondant'], $_GET['prenomCorrespondant'], htmlspecialchars($message), $date));
                        $dateMessage = date('d/m/Y H:i');
                        $requete = $bdd->prepare('UPDATE chat SET lastMessage=? ,date=? WHERE id=?');
                        $requete->execute(array($_GET['message'], $dateMessage, $_GET['idChat']));
                    }

                    if (isset($_GET['checkProfile'])) {

                        header('location: userProfile.php?checkProfile=true&nomCorrespondant=' . $_GET['nomAuteur'] . '&idCorrespondant=' . $_GET['idAuteur']);
                    }

                    if (isset($_GET['verification'])) {



                        //   $requete = $bdd->prepare('UPDATE chat SET lastMessage =? WHERE  id=? AND nomMessager=?  AND idMessager=? AND nomCorrespondant=? AND idCorrespondant=?');
                        //   $requete->execute(array($_GET['idChat'],$_SESSION['nom'],$_SESSION['id'],$_GET['nomAuteur'],$_GET['idAuteur']));
                        //   $_SESSION['type'] = $typeLocataire;
                        //  header('location: chat.php?idChat='.$_GET['id'].'&idAuteur='.$_GET['idAuteur'].'&nomcorrespondant='.$_GET['nom'].'&prenomCorrespondant='.$_GET['prenom'].'&typeDeChambre='.$_GET['typeDeChambre'].'&quartier='.$_GET['quartier'].'&IndicationParticulaire='.$_GET['IndicationParticulaire'].'&socialSituation='.$_GET['socialSituation'].'&date='.$_GET['date'].'&type='.$_GET['type'].'&verification=true');

                        // verifier si  vous n'ete pas message plutot que  correspondant
                        // code si vous ete messager
                        if ($_GET['nomMessager'] == $_SESSION['nom'] && $_GET['idMessager'] == $_SESSION['id']) {
                            // $requeteMakeVue = $bdd->prepare('UPDATE messages SET vue=? WHERE nomMessager=? AND idMessager=?');
                            //         $requeteMakeVue->execute(array($vue,$_SESSION['nom'],$_SESSION['id']));


                            if (isset($_GET['sendImage'])) {

                                header('location: sendImage.php?link=' . $_GET['link'] . '?nomMessager=' . $_SESSION['nom'] . '&prenomMessager=' . $_SESSION['prenom'] . '&idMessager='
                                    . $_SESSION['id'] . '&idCorrespondant=' . $_GET['idCorrespondant'] . '&nomCorrespondant=' . $_GET['nomCorrespondant'] . '&prenomCorrespondant=' . $_GET['prenomCorrespondant'] . '&idChat=' . $_GET['idChat'] . '&nomMessager=' . $_SESSION['nom'] . '&verification=true&sendImage=true');
                                $_SESSION['linkOfChatForImage'] = $_GET['link'];
                                $_SESSION['idCorrespondant'] = $_GET['idCorrespondant'];
                                $_SESSION['nomCorrespondant'] = $_GET['nomCorrespondant'];
                                $_SESSION['prenomCorrespondant'] = $_GET['prenomCorrespondant'];
                                $_SESSION['idChat'] = $_GET['idChat'];
                            } else {

                                if (isset($_GET['send'])) {
                                    if (empty($_GET['message'])) {
                                        header('location: chat.php?nomMessager=' . $_SESSION['nom'] . '&prenomMessager=' . $_SESSION['prenom'] . '&idMessager='
                                            . $_SESSION['id'] . '&idCorrespondant=' . $_GET['idCorrespondant'] . '&nomCorrespondant=' . $_GET['nomCorrespondant'] . '&prenomCorrespondant=' . $_GET['prenomCorrespondant'] . '&idChat=' . $_GET['idChat'] . '&verification=true');
                                    } else {
                                        $date = date('d-m-Y H:i');
                                        $message = $_GET['message'];
                                        $requete = $bdd->prepare('INSERT INTO messages(idAuteur ,nomAuteur,prenomAuteur,idCorrespondant , nomCorrespondant, prenomCorrespondant, message, date) VALUES (?,?,?,?,?,?,?,?)');
                                        $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_GET['idCorrespondant'], $_GET['nomCorrespondant'], $_GET['prenomCorrespondant'], htmlspecialchars($message), $date));
                                        $dateMessage = date('d/m/Y H:i');
                                        $requete = $bdd->prepare('UPDATE chat SET lastMessage=? ,date=? WHERE id=?');
                                        $requete->execute(array($_GET['message'], $dateMessage, $_GET['idChat']));

                                        header('location: chat.php?nomMessager=' . $_SESSION['nom'] . '&prenomMessager=' . $_SESSION['prenom'] . '&idMessager='
                                            . $_SESSION['id'] . '&idCorrespondant=' . $_GET['idCorrespondant'] . '&nomCorrespondant=' . $_GET['nomCorrespondant']
                                            . '&prenomCorrespondant=' . $_GET['prenomCorrespondant'] . '&idChat=' . $_GET['idChat'] . '&verification=true');
                                    }
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
            <link rel="stylesheet" href="../style/homePageStyle.css">
            <link rel="stylesheet" href="../style/messageris.css">
            <style>
                /* body {
                         overflow-y: hidden;
                         overflow-x: hidden;
                    }

                    .Description7 {
                         text-align: center;
                         max-width: 800px;
                         margin: 0 auto;
                         margin-top: 0px;
                         padding-bottom: 0px;
                         background-color: #fff;
                         border-radius: 10px;
                         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                         margin-top: 35px;
                         color: #555;
                         line-height: 1.6;
                         font-size: 1.1em;
                         height: 500px; 
                         border-radius: 7px;
                    }
                    .sent {
    background: #e3f2fd;
    color: #333;
    text-align: right;
    position: relative;
    max-width: 190px;
    left: 73%;
}
                    button.buttonMessageCheckProfile {
    box-shadow: none;
    padding: 0;
    margin: 0;
} */
                .noBtn {
                    background: none;
                    padding: 0;
                    margin: 0;
                    border: none;
                }

                /* .image-container{

} */
                h2.chatbot-name {
                    margin: 0;
                    padding: 0;
                    display: inline-block;
                    color: white;
                }

                img.image-container {
                    border-radius: 50%;
                    width: 40px;
                    height: 40px;
                    position: relative;
                    top: 5px;
                    margin-right: 5px;
                    display: inline-block;
                }

                button.noBtn {
                    background: none;
                    border: none;
                    width: 100%;
                }

                .chat-header {
                    background: #0d6efd;
                    width: 100%;
                    height: 52px;
                }

                .chatlog {
                    height: 345px;
                    overflow-y: auto;
                }

                .photo {
                    width: 40px;
                    display: inline-block;
                    position: relative;
                    top: 5px;
                    height: 40px;
                    background: #9E9E9E;
                    border-radius: 50%;
                }

                .chatInput {
                    width: 100%;
                    background: #ddd;
                    padding: 5px 0;
                }

                img.imagesVue {
                    width: 10px;
                    height: 10px;
                    border-radius: 52%;
                }


                .sent {
                    background: #0d6efd;
                    color: white;
                    margin-top: 2px;
                    border-radius: 10px;
                    padding: 10px;
                    /* float: right; */
                    margin: 1px 0;
                }

                .az {
                    WIDTH: 65%;
                }

                .bz {
                    width: 48%;
                }

                .received {
                    padding: 10px;
                    border-radius: 10px;
                    background: #dee2e6;
                    margin: 1px 0px;
                }
                svg.userSvg {
    height: 35px;
    margin-top: 5px;
    border-bottom-right-radius: 13px;
    border-bottom-left-radius: 13px;
}
                path.userPath {
    fill: white;
}
.noImage {
    background: #555;
    border-radius: 10px;
}
            </style>
        </head>

        <body class="homePage">

            <?php require('includes/navbar.php');

            ?>

            <!-- <form action="chatBot.php" class="input-box" method="POST">
                    <input type="text" name="message" id="user-input" required placeholder="Type your message...">
                    <button name="send" id="send-button"><span><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                <path d="M120-160v-640l760 320-760 320Zm80-120 474-200-474-200v140l240 60-240 60v140Zm0 0v-400 400Z" />
                            </svg></span></button>
                </form> -->
            <div class="chat-container  mt-1 container p-0 border rounded-3">
                <div class="chat-header">
                    <form action="userChatProfile.php" style="width: auto;height: 50px;" method="get">
                        <button name="checkProfile" class="noBtn">
                            <div class="d-flex justify-content-left">
                                <?php $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? ');
                                $requeteCountImage->execute(array($_GET['idCorrespondant'], $_GET['nomCorrespondant']));
                                $imageCount = $requeteCountImage->fetch()['image_count'];

                                if ($imageCount == 0) { ?>
                                    <div class="photo ml-1"><svg class="userSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                    48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg></div>
                                <?php  } else {
                                    $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE raison=? AND idAuteur = ? ORDER BY id DESC LIMIT 1  ');
                                    $requeteGetImage->execute(array('profile', $_GET['idCorrespondant']));
                                    $result = $requeteGetImage->fetch(); ?>

                                    <img class="image-container" src="<?php echo $result['bin']; ?>" alt="ChatBot Image">
                                    <input type="text" class="hide" value="<?php echo $result['bin']; ?>">
                                <?php
                                }
                                $requeteGetStatus = $bdd->prepare('SELECT online FROM user WHERE id = ? AND nom = ? ');
                                $requeteGetStatus->execute(array($_GET['idCorrespondant'], $_GET['nomCorrespondant']));
                                $resultatsGetStatus = $requeteGetStatus->fetch();
                                if ($resultatsGetStatus['online'] == 'true') {
                                    echo ' <div class="status"></div>';
                                }
                                ?>
                                <input name="idMessager" class="hide" type="text" value="<?php echo $_GET['idMessager']; ?>">
                                <input name="nomMessager" class="hide" type="text" value="<?php echo $_GET['nomMessager']; ?>">
                                <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idCorrespondant']; ?>">
                                <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomCorrespondant']; ?>">
                                <input name="nomAuteur" class="hide" type="text" value="<?php echo $_SESSION['nom']; ?>">
                                <input name="idAuteur" class="hide" type="text" value="<?php echo $_SESSION['id']; ?>">
                                <input name="linkChat" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                <input name="nomVictim" class="hide" type="text" value="<?php echo $_GET['nomCorrespondant']; ?>">
                                <input name="idVictim" class="hide" type="text" value="<?php echo $_GET['idCorrespondant']; ?>">
                                <input name="idChat" class="hide" type="text" value="<?php echo $_GET['idChat']; ?>">
                                <input name="verification" class="hide" type="text" value="true">
                                <h2 class="chatbot-name pl-1 pt-2" style="margin-left: 2px;">
                                    <?php echo  ' ' . $_GET['nomCorrespondant'] . ' ' . $_GET['prenomCorrespondant'];; ?></h2>
                            </div>
                        </button>
                </div>
                <div class="chatlog p-1" id="messagesContainer">
                    <?php

                            $requete = $bdd->prepare('SELECT * FROM messages WHERE idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=? 
OR idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=?  ORDER BY id');
                            $requete->execute(array(
                                $_SESSION['id'], $_SESSION['nom'],
                                $_GET['idCorrespondant'], $_GET['nomCorrespondant'],
                                $_GET['idCorrespondant'], $_GET['nomCorrespondant'],
                                $_SESSION['id'], $_SESSION['nom']
                            ));


                            while ($resultatsGetMessage = $requete->fetch()) {
                                // marquage de vue 
                                if ($resultatsGetMessage['idCorrespondant'] == $_SESSION['id']) {
                                    $requeteMakeVue = $bdd->prepare('UPDATE messages SET vueCorrespondant=? WHERE idCorrespondant=?  AND nomCorrespondant=? AND message=?');
                                    $requeteMakeVue->execute(array('true', $_SESSION['id'], $_SESSION['nom'], $resultatsGetMessage['message']));
                                }
                                if ($resultatsGetMessage['idAuteur'] == $_SESSION['id']) {
                                    $requeteMakeVue = $bdd->prepare('UPDATE messages SET vueMessager=? WHERE idAuteur=?  AND nomAuteur=? AND message=?');
                                    $requeteMakeVue->execute(array('true', $resultatsGetMessage['idAuteur'],  $resultatsGetMessage['nomAuteur'], $resultatsGetMessage['message']));
                                }

                                $requeteGetUserInfo = $bdd->prepare('SELECT * FROM user WHERE short=?');
                                $requeteGetUserInfo->execute(array($resultatsGetMessage['message']));
                                $resultatsGetUserInfo = $requeteGetUserInfo->fetch();
                                if ($resultatsGetUserInfo['short'] == $resultatsGetMessage['message']) {
                                    if ($resultatsGetMessage['idAuteur'] == $_GET['idCorrespondant']) {
                    ?>
                                <div class="d-flex justify-content-between">
                                    <div class="received">
                                        <?php $requeteGetImageOfOffer = $bdd->prepare('SELECT * FROM images WHERE  raison=? AND idAuteur=? AND nomAuteur=? ORDER BY id DESC LIMIT 1  ');
                                        $requeteGetImageOfOffer->execute(array('profile', $resultatsGetUserInfo['id'], $resultatsGetUserInfo['nom']));
                                        $resultatsGetImageOfOffer = $requeteGetImageOfOffer->fetch();
                                        ?>
                                        <form method="get" class="formHome" action="userProfile.php">
                                            <button name="checkProfile" width="160px" style="color:black;" class="noBtn">
                                            <?php if(empty($resultatsGetImageOfOffer['bin'])){ ?>
                                                    <div class="noImage"><svg class="userSvgChat" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                                    48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                                           <?php     }else{  ?>
                                                <img class="img" width="190px" src="<?php echo $resultatsGetImageOfOffer['bin'];  ?>" alt="image principale">
                                                <?php } ?><div class="otherElementHomePage">
                                                    <h3 class="textColor" style="margin: 2px 0px;"><?php echo $resultatsGetUserInfo['nom'] . ' ' . $resultatsGetUserInfo['prenom']; ?></h3>
                                                    <div class="d-flex justify-content-between">
                                                        <small class="textColor"><?php echo $resultatsGetUserInfo['type']; ?></small>
                                                        <div></div>
                                                    </div>
                                                    <input name="idCorrespondant" class="hide" type="text" value="<?php echo $resultatsGetUserInfo['id']; ?>">
                                                    <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultatsGetUserInfo['nom']; ?>">
                                                    <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $resultatsGetUserInfo['prenom']; ?>">
                                                    <input name="verification" class="hide" type="text" value="true">
                                                </div>
                                            </button>
                                        </form>
                                        <?php  ?>
                                    </div>
                                    <div></div>
                                </div>
                            <?php } ?>
                            <?php if ($resultatsGetMessage['idAuteur'] == $_SESSION['id']) {
                            ?>
                                <div class="d-flex justify-content-between">
                                    <div></div>
                                    <div class="sent">
                                        <?php $requeteGetImageOfOffer = $bdd->prepare('SELECT * FROM images WHERE  raison=? AND idAuteur=? AND nomAuteur=?  ORDER BY id desc LIMIT 1 ');
                                        $requeteGetImageOfOffer->execute(array('profile', $resultatsGetUserInfo['id'], $resultatsGetUserInfo['nom']));
                                        $resultatsGetImageOfOffer = $requeteGetImageOfOffer->fetch();
                                        ?>
                                        <form method="get" class="formHome" action="userProfile.php">
                                            <button name="checkProfile" width="160px" style="color:#fff;" class="noBtn">
                                                <?php if(empty($resultatsGetImageOfOffer['bin'])){ ?>
                                                    <div class="noImage"><svg class="userSvgChat" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                                    48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                                           <?php     }else{  ?>
                                                <img class="img" width="190px" src="<?php echo $resultatsGetImageOfOffer['bin'];  ?>" alt="image principale">
                                                <?php } ?>
                                                <div class="otherElementHomePage">
                                                    <h3 class="textColor" style="margin: 2px 0px;"><?php echo $resultatsGetUserInfo['nom'] . ' ' . $resultatsGetUserInfo['prenom']; ?></h3>
                                                    <div class="d-flex justify-content-between">
                                                        <small class="textColor"><?php echo $resultatsGetUserInfo['type']; ?></small>
                                                        <div></div>
                                                    </div>
                                                    <input name="idCorrespondant" class="hide" type="text" value="<?php echo $resultatsGetUserInfo['id']; ?>">
                                                    <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultatsGetUserInfo['nom']; ?>">
                                                    <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $resultatsGetUserInfo['prenom']; ?>">
                                                    <input name="verification" class="hide" type="text" value="true">
                                                </div>

                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <?php    }
                                } else {
                                    $requeteGetOffre = $bdd->prepare('SELECT * FROM offre WHERE short=?');
                                    $requeteGetOffre->execute(array($resultatsGetMessage['message']));
                                    $resultatsGetOffre = $requeteGetOffre->fetch();
                                    if ($resultatsGetOffre['short'] == $resultatsGetMessage['message']) {
                                        if ($resultatsGetMessage['idAuteur'] == $_GET['idCorrespondant']) {
                                            $requeteGetNumber = $bdd->prepare('SELECT number FROM  user WHERE id=? AND nom=?');
                                            $requeteGetNumber->execute(array($resultatsGetOffre['idAuteur'], $resultatsGetOffre['nomAuteur']));
                                            $resultsGetNumber = $requeteGetNumber->fetch(); ?>
                                    <div class="d-flex justify-content-between">

                                        <div class="received">
                                            <?php $requeteGetImageOfOffer = $bdd->prepare('SELECT * FROM imagesdemande WHERE idRequete=? AND raison=? AND idAuteur=? AND nomAuteur=? ');
                                            $requeteGetImageOfOffer->execute(array($resultatsGetOffre['id'], 'imagePrincipale', $resultatsGetOffre['idAuteur'], $resultatsGetOffre['nomAuteur']));
                                            $resultatsGetImageOfOffer = $requeteGetImageOfOffer->fetch();
                                            ?>
                                            <form method="get" class="formHome" action="notificationPlus.php">
                                                <button name="checkOffre" class="noBtn">
                                                    <button name="seeImage" width="160px" style="color:black;" class="noBtn">
                                                        <img class="img" width="190px" src="<?php echo $resultatsGetImageOfOffer['bin'];  ?>" alt="image principale">
                                                        <div class="otherElementHomePage">
                                                            <h5 class="text-left"><?php echo $resultatsGetOffre['typeDeChambre']; ?></h5>
                                                            <div class="d-flex justify-content-between">
                                                                <h6 class="text-left"><?php echo $resultatsGetOffre['quartier']; ?></h6>
                                                                <h6 class="text-right">
                                                                    <?php echo $resultatsGetOffre['prix'] . ' F'; ?></h6>
                                                            </div>

                                                            <input name="idAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['idAuteur']; ?>">
                                                            <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['nomAuteur']; ?>">
                                                            <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['prenomAuteur']; ?>">
                                                            <input name="typeDeChambre" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDeChambre']; ?>">
                                                            <input name="quartier" class="hide" type="text" value="<?php echo $resultatsGetOffre['quartier']; ?>">
                                                            <input name="number" class="hide" type="text" value="<?php echo $resultsGetNumber['number']; ?>">
                                                            <input name="prix" class="hide" type="text" value="<?php echo $resultatsGetOffre['prix']; ?>">
                                                            <input name="ville" class="hide" type="text" value="<?php echo $resultatsGetOffre['ville']; ?>">
                                                            <input name="demande" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDemande']; ?>">
                                                            <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $resultatsGetOffre['IndicationParticulaire']; ?>">
                                                            <input name="socialSituation" class="hide" type="text" value="<?php echo $resultatsGetOffre['socialSituation']; ?>">
                                                            <input name="date" class="hide" type="text" value="<?php echo $resultatsGetOffre['date']; ?>">
                                                            <input name="short" class="hide" type="text" value="<?php echo $resultatsGetOffre['short']; ?>">
                                                            <input name="type" class="hide" type="text" value="<?php echo $resultatsGetOffre['type']; ?>">
                                                            <input name="idNotif" class="hide" type="text" value="<?php echo $resultatsGetOffre['id']; ?>">
                                                            <input name="verification" class="hide" type="text" value="true">
                                                            <span>
                                                            </span>
                                                        </div>
                                                    </button>
                                            </form>
                                        </div>
                                        <div></div>
                                    </div>
                                <?php }
                                        if ($resultatsGetMessage['idAuteur'] == $_SESSION['id']) {
                                ?>
                                    <div class="d-flex justify-content-between">

                                        <div></div>
                                        <div class="sent">
                                            <?php $requeteGetImageOfOffer = $bdd->prepare('SELECT * FROM imagesdemande WHERE idRequete=? AND raison=? AND idAuteur=? AND nomAuteur=? ');
                                            $requeteGetImageOfOffer->execute(array($resultatsGetOffre['id'], 'imagePrincipale', $_SESSION['id'], $_SESSION['nom']));
                                            $resultatsGetImageOfOffer = $requeteGetImageOfOffer->fetch();
                                            $requeteGetNumber = $bdd->prepare('SELECT number FROM  user WHERE id=? AND nom=?');
                                            $requeteGetNumber->execute(array($resultatsGetOffre['idAuteur'], $resultatsGetOffre['nomAuteur']));
                                            $resultsGetNumber = $requeteGetNumber->fetch();
                                            ?>
                                            <?php $requeteGetImageOfOffer = $bdd->prepare('SELECT * FROM imagesdemande WHERE idRequete=? AND raison=? AND idAuteur=? AND nomAuteur=? ');
                                            $requeteGetImageOfOffer->execute(array($resultatsGetOffre['id'], 'imagePrincipale', $resultatsGetOffre['idAuteur'], $resultatsGetOffre['nomAuteur']));
                                            $resultatsGetImageOfOffer = $requeteGetImageOfOffer->fetch();
                                            ?>
                                            <form method="get" class="formHome" action="notificationPlus.php">
                                                <button name="checkOffre" class="noBtn">
                                                    <button name="seeImage" width="160px" style="color:#fff;" class="noBtn">
                                                        <img class="img" width="190px" src="<?php echo $resultatsGetImageOfOffer['bin'];  ?>" alt="image principale">
                                                        <div class="otherElementHomePage">
                                                            <h5 class="text-left"><?php echo $resultatsGetOffre['typeDeChambre']; ?></h5>
                                                            <div class="d-flex justify-content-between">
                                                                <h6 class="text-left"><?php echo $resultatsGetOffre['quartier']; ?></h6>
                                                                <h6 class="text-right">
                                                                    <?php echo $resultatsGetOffre['prix'] . ' F'; ?></h6>
                                                            </div>

                                                            <input name="idAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['idAuteur']; ?>">
                                                            <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['nomAuteur']; ?>">
                                                            <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['prenomAuteur']; ?>">
                                                            <input name="typeDeChambre" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDeChambre']; ?>">
                                                            <input name="quartier" class="hide" type="text" value="<?php echo $resultatsGetOffre['quartier']; ?>">
                                                            <input name="number" class="hide" type="text" value="<?php echo $resultsGetNumber['number']; ?>">
                                                            <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                                            <input name="prix" class="hide" type="text" value="<?php echo $resultatsGetOffre['prix']; ?>">
                                                            <input name="ville" class="hide" type="text" value="<?php echo $resultatsGetOffre['ville']; ?>">
                                                            <input name="demande" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDemande']; ?>">
                                                            <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $resultatsGetOffre['IndicationParticulaire']; ?>">
                                                            <input name="socialSituation" class="hide" type="text" value="<?php echo $resultatsGetOffre['socialSituation']; ?>">
                                                            <input name="date" class="hide" type="text" value="<?php echo $resultatsGetOffre['date']; ?>">
                                                            <input name="short" class="hide" type="text" value="<?php echo $resultatsGetOffre['short']; ?>">
                                                            <input name="type" class="hide" type="text" value="<?php echo $resultatsGetOffre['type']; ?>">
                                                            <input name="idNotif" class="hide" type="text" value="<?php echo $resultatsGetOffre['id']; ?>">
                                                            <input name="verification" class="hide" type="text" value="true">
                                                            <span>
                                                            </span>
                                                        </div>
                                                    </button>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    } else {
                                        $requeteGetImages = $bdd->prepare('SELECT * FROM images WHERE raison=? AND idAuteur=? AND nomAuteur=? AND bin=?');
                                        $requeteGetImages->execute(array('message', $resultatsGetMessage['idAuteur'], $resultatsGetMessage['nomAuteur'], $resultatsGetMessage['message']));
                                        $resultatsGetImages = $requeteGetImages->fetch();
                                        if ($resultatsGetImages['bin'] == $resultatsGetMessage['message']) {
                                            if ($resultatsGetMessage['idAuteur'] == $_GET['idCorrespondant']) { ?>
                                        <div class="d-flex justify-content-between">
                                            <div class="received">
                                                <?php
                                                ?>
                                                <form method="get" class="formHome" action="seeImage.php">
                                                    <button name="seeImageMessage" class="noBtn" style="  padding: 0px; border-radius: 5px;">
                                                        <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultatsGetMessage['nomAuteur']; ?>">
                                                        <input name="idAuteur" class="hide" type="text" value="<?php echo $resultatsGetMessage['idAuteur']; ?>">
                                                        <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                                        <input name="image" type="text" value="<?php echo $resultatsGetMessage['message']; ?>" class="hide">
                                                        <img class="img" width="150px" src="<?php echo $resultatsGetMessage['message'];  ?>" alt="image principale">
                                                    </button>
                                                </form>
                                            </div>
                                            <div></div>
                                        </div>
                                    <?php }
                                            if ($resultatsGetMessage['idAuteur'] == $_SESSION['id']) {    ?>
                                        <div class="d-flex justify-content-between">
                                            <div> </div>

                                            <div class="sent">
                                                <form method="get" class="formHome" action="seeImage.php">
                                                    <button name="seeImageMessage" class="noBtn" style="  padding: 0px; border-radius: 5px;">
                                                        <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultatsGetMessage['nomAuteur']; ?>">
                                                        <input name="idAuteur" class="hide" type="text" value="<?php echo $resultatsGetMessage['idAuteur']; ?>">
                                                        <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                                        <input name="image" type="text" value="<?php echo $resultatsGetMessage['message']; ?>" class="hide">
                                                        <img class="img" width="150px" src="<?php echo $resultatsGetMessage['message'];  ?>" alt="image principale">
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php  }
                                        } else {
                                            if ($resultatsGetMessage['idAuteur'] == $_GET['idCorrespondant']) {

                                                $requeteMakeVue = $bdd->prepare('UPDATE messages SET vueMessager=? WHERE idAuteur=?  AND nomAuteur=? AND message=?');
                                                $requeteMakeVue->execute(array('true', $_GET['idCorrespondant'],  $_GET['nomCorrespondant'], $resultatsGetMessage['message']));

                                    ?> <div class="d-flex justify-content-between">
                                            <div class="received">
                                                <p style="padding:0px; margin:0px;"> <?php echo $resultatsGetMessage['message']; ?></p>
                                            </div>

                                        </div>

                                    <?php } ?>

                                    <?php if ($resultatsGetMessage['idAuteur'] == $_SESSION['id']) {
                                    ?>
                                        <div class="d-flex justify-content-between">
                                            <div></div>
                                            <div class="sent">
                                                <p style="margin: 0; padding:0px;">
                                                    <?php echo $resultatsGetMessage['message']; ?></p>
                                            </div>
                                        </div>
                            <?php }
                                        }
                                    }
                                }
                            }


                            $requeteGetThelastedMessage = $bdd->prepare('SELECT * FROM messages WHERE idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=? 
OR idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=?  ORDER BY id DESC LIMIT 1');
                            $requeteGetThelastedMessage->execute(array(
                                $_SESSION['id'], $_SESSION['nom'],
                                $_GET['idCorrespondant'], $_GET['nomCorrespondant'],
                                $_GET['idCorrespondant'], $_GET['nomCorrespondant'],
                                $_SESSION['id'], $_SESSION['nom']
                            ));
                            $resultatsGetThelastedMessage = $requeteGetThelastedMessage->fetch();
                            if ($resultatsGetThelastedMessage['vueCorrespondant'] == 'true') {
                                if (isset($result['bin'])) { ?>
                            <img class="imagesVue" src="<?php echo $result['bin']; ?>" alt="image">
                        <?php }
                                if (!isset($result['bin'])) { ?><div class="vue"></div> <?php }
                                                                                } ?>
                </div>
                <div class="chatInput">


                    <?php $requeteGetBlockage = $bdd->prepare('SELECT * FROM blocked WHERE idAuteur=? AND nomAuteur=? AND idVictim=? AND nomVictim=? OR idAuteur=? AND nomAuteur=? AND idVictim=? AND nomVictim=? ');
                            $requeteGetBlockage->execute(array($_GET['idMessager'], $_GET['nomMessager'], $_GET['idCorrespondant'], $_GET['nomCorrespondant'], $_GET['idCorrespondant'], $_GET['nomCorrespondant'], $_GET['idMessager'], $_GET['nomMessager']));
                            $resultatsGetBlockage = $requeteGetBlockage->fetch();

                            if (isset($resultatsGetBlockage['blockage'])) {   ?>
                        <div class=" my-3">
                        </div>
                    <?php } else { ?>
                        <form action="chat.php" method="get">

                            <div class="d-flex justify-content-center px-1">
                                <button name="sendImage" id="send-btn" class="btn btn-primary btn-sm ml-1" style="padding: 0 3px;"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 384 512">
                                        <path style="fill:white;" d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM64 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm152 32c5.3 0 10.2 2.6 13.2 6.9l88 128c3.4 4.9 3.7 11.3 1 16.5s-8.2 8.6-14.2 8.6H216 176 128 80c-5.8 0-11.1-3.1-13.9-8.1s-2.8-11.2 .2-16.1l48-80c2.9-4.8 8.1-7.8 13.7-7.8s10.8 2.9 13.7 7.8l12.8 21.4 48.3-70.2c3-4.3 7.9-6.9 13.2-6.9z" />
                                    </svg></button>
                                <input type="text" name="message" class="form-control mx-1" placeholder="Type a Message">
                                <button id="clear-btn" class="btn btn-sm btn-primary mr-1" style="padding: 0 3px;" name="send"><span><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="28">
                                            <path style="fill:white;" d="M120-160v-640l760 320-760 320Zm80-120 474-200-474-200v140l240 60-240 60v140Zm0 0v-400 400Z" />
                                        </svg></span></button>
                                <input name="idMessager" class="hide" type="text" value="<?php echo $_GET['idMessager']; ?>">
                                <input name="prenomMessager" class="hide" type="text" value="<?php echo $_GET['prenomMessager']; ?>">
                                <input name="nomMessager" class="hide" type="text" value="<?php echo $_GET['nomMessager']; ?>">
                                <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idCorrespondant']; ?>">
                                <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomCorrespondant']; ?>">
                                <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomCorrespondant']; ?>">
                                <input name="idChat" class="hide" type="text" value="<?php echo $_GET['idChat']; ?>">
                                <input name="verification" class="hide" type="text" value="true">
                                <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            </div>
      </form>
                        <?php }  ?>


                 
                </div>
            </div>
            <script type="text/javascript">

function scrollToBottom(){
    var chatlog = document.getElementById('messagesContainer');
    chatlog.scrollTop = chatlog.scrollHeight; 

}
window.onload = function() {
    scrollToBottom();
}
            </script>
        </body>

        </html>


        <!--  si le corrrespondant c'est l'utilisateur -->
    <?php }
                        if ($_GET['nomCorrespondant'] == $_SESSION['nom'] && $_GET['idCorrespondant'] == $_SESSION['id']) {

                            if (isset($_GET['sendImage'])) {

                                header('location: sendImage.php?link=' . $_GET['link'] . '?nomMessager=' . $_SESSION['nom'] . '&prenomMessager=' . $_SESSION['prenom'] . '&idMessager='
                                    . $_SESSION['id'] . '&idCorrespondant=' . $_GET['idCorrespondant'] . '&nomCorrespondant=' . $_GET['nomCorrespondant'] . '&prenomCorrespondant=' . $_GET['prenomCorrespondant'] . '&idChat=' . $_GET['idChat'] . '&nomMessager=' . $_SESSION['nom'] . '&verification=true&sendImage=true');
                                $_SESSION['linkOfChatForImage'] = $_GET['link'];
                                $_SESSION['idCorrespondant'] = $_GET['idMessager'];
                                $_SESSION['nomCorrespondant'] = $_GET['nomMessager'];
                                $_SESSION['prenomCorrespondant'] = $_GET['prenomMessager'];
                                $_SESSION['idChat'] = $_GET['idChat'];
                            } else {
                                if (isset($_GET['send'])) {

                                    $date = date('d-m-Y H:i');
                                    $message = $_GET['message'];
                                    $requete = $bdd->prepare('INSERT INTO messages(idAuteur ,nomAuteur,prenomAuteur,idCorrespondant , nomCorrespondant, prenomCorrespondant, message, date) VALUES (?,?,?,?,?,?,?,?)');
                                    $requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_GET['idMessager'], $_GET['nomMessager'], $_GET['prenomMessager'], htmlspecialchars($message), $date));

                                    $dateMessage = date('d/m/Y H:i');
                                    $requete = $bdd->prepare('UPDATE chat SET lastMessage=? ,date=? WHERE id=?');
                                    $requete->execute(array($_GET['message'], $dateMessage, $_GET['idChat']));


                                    header('location: chat.php?nomMessager=' . $_GET['nomMessager'] . '&prenomMessager='
                                        . $_GET['prenomMessager'] . '&idMessager=' . $_GET['idMessager'] . '&idCorrespondant='
                                        . $_SESSION['id'] . '&nomCorrespondant=' . $_SESSION['nom'] . '&prenomCorrespondant='
                                        . $_SESSION['prenom'] . '&idChat=' . $_GET['idChat'] . '&verification=true');
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
            <link rel="stylesheet" href="../style/homePageStyle.css">
            <link rel="stylesheet" href="../style/messageris.css">
            <style>
                button.buttonMessageCheckProfile {
                    background: none;
                    border: none;
                    box-shadow: none;
                    margin: 0;
                    padding: 0;
                }

                .noBtn {
                    background: none;
                    padding: 0;
                    margin: 0;
                    border: none;
                }

                /* .image-container{

} */
                h2.chatbot-name {
                    margin: 0;
                    padding: 0;
                    display: inline-block;
                    color: white;
                }

                img.image-container {
                    border-radius: 50%;
                    width: 40px;
                    height: 40px;
                    position: relative;
                    top: 5px;
                    margin-right: 5px;
                    display: inline-block;
                }

                button.noBtn {
                    background: none;
                    border: none;
                    width: 100%;
                }

                img.imagesVue {
                    width: 10px;
                    height: 10px;
                    border-radius: 52%;
                }

                .chat-header {
                    background: #0d6efd;
                    width: 100%;
                    height: 52px;
                }

                .chatlog {
                    height: 380px;
                    overflow-y: auto;
                }

                .chatInput {
                    width: 100%;
                    background: #ddd;
                    padding: 5px 0;
                }

                .sent {
                    background: #0d6efd;
                    color: white;
                    margin-top: 2px;
                    border-radius: 10px;
                    padding: 10px;
                    /* float: right; */
                    margin: 1px 0;
                }

                .az {
                    WIDTH: 65%;
                }

                .bz {
                    width: 48%;
                }

                .received {
                    padding: 10px;
                    border-radius: 10px;
                    background: #dee2e6;
                    margin: 1px 0px;
                }

                .photo {
                    width: 40px;
                    display: inline-block;
                    position: relative;
                    top: 5px;
                    height: 40px;
                    background: #9E9E9E;
                    border-radius: 50%;
                }
                svg.userSvg {
    height: 35px;
    margin-top: 5px;
    border-bottom-right-radius: 13px;
    border-bottom-left-radius: 13px;
}
path.userPath {
    fill: white;
}
.noImage {
    background: #555;
    border-radius: 10px;
}
            </style>
        </head>

        <body class="homePage">
            <?php require('includes/navbar.php');
            ?>
            <div class="chat-container  mt-1 container p-0 border rounded-3">
                <div class="chat-header">
                    <form action="userChatProfile.php" style="width: auto; height:50px;" method="get">
                        <button name="checkProfile" class="noBtn px-0 py-0">
                            <div class="d-flex justify-content-left">
                                <?php $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ?  AND raison=?');
                                $requeteCountImage->execute(array($_GET['idMessager'], $_GET['nomMessager'],'profile'));
                                $imageCount = $requeteCountImage->fetch()['image_count'];

                                if ($imageCount == 0) { ?>
                                    <div class="photo ml-1"><svg class="userSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                    48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg></div>
                                <?php  } else {
                                    $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE raison=? AND idAuteur = ? ORDER BY id DESC LIMIT 1  ');
                                    $requeteGetImage->execute(array('profile', $_GET['idMessager']));
                                    $result = $requeteGetImage->fetch(); ?>

                                    <img class="image-container" src="<?php echo $result['bin']; ?>" alt="ChatBot Image">
                                <?php }

                                $requeteGetStatus = $bdd->prepare('SELECT online FROM user WHERE id = ? AND nom = ? ');
                                $requeteGetStatus->execute(array($_GET['idMessager'], $_GET['nomMessager']));
                                $resultatsGetStatus = $requeteGetStatus->fetch();

                                if ($resultatsGetStatus['online'] == 'true') {
                                    echo ' <div class="status"></div>';
                                }   ?>
                                <input name="idMessager" class="hide" type="text" value="<?php echo $_GET['idMessager']; ?>">
                                <input name="nomMessager" class="hide" type="text" value="<?php echo $_GET['nomMessager']; ?>">
                                <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idCorrespondant']; ?>">
                                <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomCorrespondant']; ?>">
                                <input name="nomAuteur" class="hide" type="text" value="<?php echo $_SESSION['nom']; ?>">
                                <input name="linkChat" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                <input name="idAuteur" class="hide" type="text" value="<?php echo $_SESSION['id']; ?>">
                                <input name="nomVictim" class="hide" type="text" value="<?php echo $_GET['nomMessager']; ?>">
                                <input name="idVictim" class="hide" type="text" value="<?php echo $_GET['idMessager']; ?>">
                                <input name="idChat" class="hide" type="text" value="<?php echo $_GET['idChat']; ?>">
                                <input name="verification" class="hide" type="text" value="true">


                                <h2 class="chatbot-name pl-1 pt-2" style="margin-left: 2px;">
                                    <?php echo $_GET['nomMessager'] . ' ' . $_GET['prenomMessager']; ?>
                                </h2>
                            </div>
                        </button>
                    </form>
                </div>

                <div class="chatlog p-1" id="messagesContainer">
                    <?php
                            $requete = $bdd->prepare('SELECT * FROM messages WHERE idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=? 
         OR idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=?  ORDER BY id');
                            $requete->execute(array(
                                $_SESSION['id'], $_SESSION['nom'],
                                $_GET['idMessager'], $_GET['nomMessager'],
                                $_GET['idMessager'], $_GET['nomMessager'],
                                $_SESSION['id'], $_SESSION['nom']
                            ));

                            while ($resultatsGetMessage = $requete->fetch()) {

                                if ($resultatsGetMessage['idAuteur'] == $_SESSION['id']) {
                                    $requeteMakeVue = $bdd->prepare('UPDATE messages SET vueMessager=? WHERE idAuteur=?  AND nomAuteur=? AND message=?');
                                    $requeteMakeVue->execute(array('true', $_SESSION['id'], $_SESSION['nom'], $resultatsGetMessage['message']));
                                }
                                if ($resultatsGetMessage['idCorrespondant'] == $_SESSION['id']) {
                                    $requeteMakeVue = $bdd->prepare('UPDATE messages SET vueCorrespondant=? WHERE idCorrespondant=?  AND nomCorrespondant=? AND message=?');
                                    $requeteMakeVue->execute(array('true', $resultatsGetMessage['idCorrespondant'],  $resultatsGetMessage['nomCorrespondant'], $resultatsGetMessage['message']));
                                }

                                $requeteGetUserInfo = $bdd->prepare('SELECT * FROM user WHERE short=?');
                                $requeteGetUserInfo->execute(array($resultatsGetMessage['message']));
                                $resultatsGetUserInfo = $requeteGetUserInfo->fetch();
                                if ($resultatsGetUserInfo['short'] == $resultatsGetMessage['message']) {
                                    if ($resultatsGetMessage['idAuteur'] == $_GET['idMessager']) {
                    ?>
                                <div class="d-flex justify-content-between">
                                    <div class="received">
                                        <?php $requeteGetImageOfOffer = $bdd->prepare('SELECT * FROM images WHERE  raison=? AND idAuteur=? AND nomAuteur=? ORDER BY id DESC LIMIT 1 ');
                                        $requeteGetImageOfOffer->execute(array('profile', $resultatsGetUserInfo['id'], $resultatsGetUserInfo['nom']));
                                        $resultatsGetImageOfOffer = $requeteGetImageOfOffer->fetch();
                                        ?>
                                        <form method="get" class="formHome" action="userProfile.php">
                                            <button name="checkProfile" width="160px" style="color:black;" class="noBtn">
                                            <?php if(empty($resultatsGetImageOfOffer['bin'])){ ?>
                                                    <div class="noImage"><svg class="userSvgChat" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                                    48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                                           <?php     }else{  ?>
                                                <img class="img" width="190px" src="<?php echo $resultatsGetImageOfOffer['bin'];  ?>" alt="image principale">
                                                <?php } ?> <div class="otherElementHomePage">
                                                    <h3 class="textColor" style="margin: 2px 0px;"><?php echo $resultatsGetUserInfo['nom'] . ' ' . $resultatsGetUserInfo['prenom']; ?></h3>
                                                    <div class="d-flex justify-content-between">
                                                        <small class="textColor"><?php echo $resultatsGetUserInfo['type']; ?></small>
                                                        <div></div>
                                                    </div>
                                                    <input name="idCorrespondant" class="hide" type="text" value="<?php echo $resultatsGetUserInfo['id']; ?>">
                                                    <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultatsGetUserInfo['nom']; ?>">
                                                    <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $resultatsGetUserInfo['prenom']; ?>">
                                                    <input name="verification" class="hide" type="text" value="true">
                                                </div>
                                            </button>
                                        </form>
                                        <div></div>
                                    </div>
                                </div> <?php } ?>
                            <?php
                                    if ($resultatsGetMessage['idAuteur'] == $_SESSION['id']) {
                            ?>
                                <div class="d-flex justify-content-between">
                                    <div></div>
                                    <div class="sent  ">
                                        <?php $requeteGetImageOfOffer = $bdd->prepare('SELECT * FROM images WHERE  raison=? AND idAuteur=? AND nomAuteur=? ORDER BY id DESC LIMIT 1 ');
                                        $requeteGetImageOfOffer->execute(array('profile', $resultatsGetUserInfo['id'], $resultatsGetUserInfo['nom']));
                                        $resultatsGetImageOfOffer = $requeteGetImageOfOffer->fetch();
                                        ?>
                                        <form method="get" class="formHome" action="userProfile.php">
                                            <button name="checkProfile" width="160px" style="color:#fff;" class="noBtn">
                                            <?php if(empty($resultatsGetImageOfOffer['bin'])){ ?>
                                                    <div class="noImage"><svg class="userSvgChat" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path class="userPath" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7
                                                    48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </div>
                                           <?php     }else{  ?>
                                                <img class="img" width="190px" src="<?php echo $resultatsGetImageOfOffer['bin'];  ?>" alt="image principale">
                                                <?php } ?>
                                                <h3 class="textColor" style="margin: 2px 0px;"><?php echo $resultatsGetUserInfo['nom'] . ' ' . $resultatsGetUserInfo['prenom']; ?></h3>
                                                    <div class="d-flex justify-content-between">
                                                        <div></div>
                                                        <small class="text-left"><?php echo $resultatsGetUserInfo['type']; ?></small>
                                                    </div>
                                                    <input name="idCorrespondant" class="hide" type="text" value="<?php echo $resultatsGetUserInfo['id']; ?>">
                                                    <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $resultatsGetUserInfo['nom']; ?>">
                                                    <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $resultatsGetUserInfo['prenom']; ?>">
                                                    <input name="verification" class="hide" type="text" value="true">
                                                </div>

                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <?php }
                                } else {

                                    $requeteGetOffre = $bdd->prepare('SELECT * FROM offre WHERE short=? ');
                                    $requeteGetOffre->execute(array($resultatsGetMessage['message']));
                                    $resultatsGetOffre = $requeteGetOffre->fetch();
                                    if ($resultatsGetOffre['short'] == $resultatsGetMessage['message']) {
                                        if ($resultatsGetMessage['idAuteur'] == $_GET['idMessager']) {
                                            $requeteGetNumber = $bdd->prepare('SELECT number FROM  user WHERE id=? AND nom=?');
                                            $requeteGetNumber->execute(array($resultatsGetOffre['idAuteur'], $resultatsGetOffre['nomAuteur']));
                                            $resultsGetNumber = $requeteGetNumber->fetch(); ?>
                                    <div class="d-flex justify-content-between">
                                        <div class="received">
                                            <?php $requeteGetImageOfOffer = $bdd->prepare('SELECT * FROM imagesdemande WHERE idRequete=? AND raison=? AND idAuteur=? AND nomAuteur=? ');
                                            $requeteGetImageOfOffer->execute(array($resultatsGetOffre['id'], 'imagePrincipale', $resultatsGetOffre['idAuteur'], $resultatsGetOffre['nomAuteur']));
                                            $resultatsGetImageOfOffer = $requeteGetImageOfOffer->fetch();
                                            ?>
                                            <form method="get" class="formHome" action="notificationPlus.php">
                                                <button name="seeImage" class="noBtn">
                                                    <button name="seeImage" width="160px" style="color:black;" class="noBtn">
                                                        <img class="img" width="190px" src="<?php echo $resultatsGetImageOfOffer['bin'];  ?>" alt="image principale">
                                                        <div class="otherElementHomePage">
                                                            <h5 class="text-left"><?php echo $resultatsGetOffre['typeDeChambre']; ?></h5>
                                                            <div class="d-flex justify-content-between">
                                                                <h6 class="text-left"><?php echo $resultatsGetOffre['quartier']; ?></h6>
                                                                <h6 class="text-right">
                                                                    <?php echo $resultatsGetOffre['prix'] . ' F'; ?></h6>
                                                            </div>
                                                            <input name="idAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['idAuteur']; ?>">
                                                            <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['nomAuteur']; ?>">
                                                            <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['prenomAuteur']; ?>">
                                                            <input name="typeDeChambre" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDeChambre']; ?>">
                                                            <input name="quartier" class="hide" type="text" value="<?php echo $resultatsGetOffre['quartier']; ?>">
                                                            <input name="number" class="hide" type="text" value="<?php echo $resultsGetNumber['number']; ?>">
                                                            <input name="prix" class="hide" type="text" value="<?php echo $resultatsGetOffre['prix']; ?>">
                                                            <input name="ville" class="hide" type="text" value="<?php echo $resultatsGetOffre['ville']; ?>">
                                                            <input name="demande" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDemande']; ?>">
                                                            <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $resultatsGetOffre['IndicationParticulaire']; ?>">
                                                            <input name="socialSituation" class="hide" type="text" value="<?php echo $resultatsGetOffre['socialSituation']; ?>">
                                                            <input name="date" class="hide" type="text" value="<?php echo $resultatsGetOffre['date']; ?>">
                                                            <input name="short" class="hide" type="text" value="<?php echo $resultatsGetOffre['short']; ?>">
                                                            <input name="type" class="hide" type="text" value="<?php echo $resultatsGetOffre['type']; ?>">
                                                            <input name="idNotif" class="hide" type="text" value="<?php echo $resultatsGetOffre['id']; ?>">
                                                            <input name="verification" class="hide" type="text" value="true">
                                                            <span>
                                                            </span>
                                                        </div>
                                                    </button>
                                            </form>
                                            <?php  ?>
                                        </div>
                                        <div></div>
                                    </div> <?php } ?>
                                <?php if ($resultatsGetMessage['idAuteur'] == $_SESSION['id']) {
                                ?>
                                    <div class="d-flex justify-content-between">
                                        <div></div>
                                        <div class="sent">
                                            <?php $requeteGetImageOfOffer = $bdd->prepare('SELECT * FROM imagesdemande WHERE idRequete=? AND raison=? AND idAuteur=? AND nomAuteur=? ');
                                            $requeteGetImageOfOffer->execute(array($resultatsGetOffre['id'], 'imagePrincipale', $_SESSION['id'], $_SESSION['nom']));
                                            $resultatsGetImageOfOffer = $requeteGetImageOfOffer->fetch();
                                            $requeteGetNumber = $bdd->prepare('SELECT number FROM  user WHERE id=? AND nom=?');
                                            $requeteGetNumber->execute(array($resultatsGetOffre['idAuteur'], $resultatsGetOffre['nomAuteur']));
                                            $resultsGetNumber = $requeteGetNumber->fetch();
                                            ?>
                                            <?php $requeteGetImageOfOffer = $bdd->prepare('SELECT * FROM imagesdemande WHERE idRequete=? AND raison=? AND idAuteur=? AND nomAuteur=? ');
                                            $requeteGetImageOfOffer->execute(array($resultatsGetOffre['id'], 'imagePrincipale', $resultatsGetOffre['idAuteur'], $resultatsGetOffre['nomAuteur']));
                                            $resultatsGetImageOfOffer = $requeteGetImageOfOffer->fetch();
                                            ?>
                                            <form method="get" class="formHome" action="notificationPlus.php">
                                                <button name="seeImage" width="160px" style="color:#fff;" class="noBtn">
                                                    <img class="img" width="190px" src="<?php echo $resultatsGetImageOfOffer['bin'];  ?>" alt="image principale">
                                                    <div class="otherElementHomePage">
                                                        <h5 class="text-left"><?php echo $resultatsGetOffre['typeDeChambre']; ?></h5>
                                                        <div class="d-flex justify-content-between">
                                                            <h6 class="text-left"><?php echo $resultatsGetOffre['quartier']; ?></h6>
                                                            <h6 class="text-right">
                                                                <?php echo $resultatsGetOffre['prix'] . ' F'; ?></h6>
                                                        </div>

                                                        <input name="idAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['idAuteur']; ?>">
                                                        <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['nomAuteur']; ?>">
                                                        <input name="prenomAuteur" class="hide" type="text" value="<?php echo $resultatsGetOffre['prenomAuteur']; ?>">
                                                        <input name="typeDeChambre" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDeChambre']; ?>">
                                                        <input name="quartier" class="hide" type="text" value="<?php echo $resultatsGetOffre['quartier']; ?>">
                                                        <input name="number" class="hide" type="text" value="<?php echo $resultsGetNumber['number']; ?>">
                                                        <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                                        <input name="prix" class="hide" type="text" value="<?php echo $resultatsGetOffre['prix']; ?>">
                                                        <input name="ville" class="hide" type="text" value="<?php echo $resultatsGetOffre['ville']; ?>">
                                                        <input name="demande" class="hide" type="text" value="<?php echo $resultatsGetOffre['typeDemande']; ?>">
                                                        <input name="IndicationParticulaire" class="hide" type="text" value="<?php echo $resultatsGetOffre['IndicationParticulaire']; ?>">
                                                        <input name="socialSituation" class="hide" type="text" value="<?php echo $resultatsGetOffre['socialSituation']; ?>">
                                                        <input name="date" class="hide" type="text" value="<?php echo $resultatsGetOffre['date']; ?>">
                                                        <input name="short" class="hide" type="text" value="<?php echo $resultatsGetOffre['short']; ?>">
                                                        <input name="type" class="hide" type="text" value="<?php echo $resultatsGetOffre['type']; ?>">
                                                        <input name="idNotif" class="hide" type="text" value="<?php echo $resultatsGetOffre['id']; ?>">
                                                        <input name="verification" class="hide" type="text" value="true">
                                                        <span>
                                                        </span>
                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <?php }
                                    } else {
                                        $requeteGetImages = $bdd->prepare('SELECT * FROM images WHERE  raison=? AND idAuteur=? AND nomAuteur=? AND bin=?');
                                        $requeteGetImages->execute(array('message', $resultatsGetMessage['idAuteur'], $resultatsGetMessage['nomAuteur'], $resultatsGetMessage['message']));
                                        $resultatsGetImages = $requeteGetImages->fetch();
                                        if ($resultatsGetImages['bin'] == $resultatsGetMessage['message']) {
                                            if ($resultatsGetMessage['idAuteur'] == $_GET['idMessager']) { ?>
                                        <div class="d-flex justify-content-between">
                                            <div class="received">

                                                <form method="get" class="formHome" action="seeImage.php">
                                                    <button name="seeImageMessage" class="noBtn" style="  padding: 0px; border-radius: 5px;">
                                                        <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultatsGetMessage['nomAuteur']; ?>">
                                                        <input name="idAuteur" class="hide" type="text" value="<?php echo $resultatsGetMessage['idAuteur']; ?>">
                                                        <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                                        <input name="image" type="text" value="<?php echo $resultatsGetMessage['message']; ?>" class="hide">
                                                        <img class="img" width="150px" src="<?php echo $resultatsGetMessage['message'];  ?>" alt="image principale">
                                                    </button>
                                                </form>
                                            </div>
                                            <div></div>
                                        </div>
                                    <?php }
                                            if ($resultatsGetMessage['idAuteur'] == $_SESSION['id']) {    ?>
                                        <div class="d-flex justify-content-between">
                                            <div></div>
                                            <div class="sent">
                                                <form method="get" class="formHome" action="seeImage.php">
                                                    <input name="nomAuteur" class="hide" type="text" value="<?php echo $resultatsGetMessage['nomAuteur']; ?>">
                                                    <button name="seeImageMessage" class="noBtn" style="  padding: 0px; border-radius: 5px;">
                                                        <input name="idAuteur" class="hide" type="text" value="<?php echo $resultatsGetMessage['idAuteur']; ?>">
                                                        <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                                        <input name="image" type="text" value="<?php echo $resultatsGetMessage['message']; ?>" class="hide">
                                                        <img class="img" width="150px" src="<?php echo $resultatsGetMessage['message'];  ?>" alt="image principale">
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php  }
                                        } else { ?>

                                    <?php if ($resultatsGetMessage['idAuteur'] == $_GET['idMessager']) {
                                    ?>
                                        <div class="d-flex justify-content-between">
                                            <div class="received">
                                                <p style="padding:0px; margin:0px;"> <?php echo $resultatsGetMessage['message']; ?></p>
                                            </div>
                                            <div class=""></div>
                                        </div><?php } ?>
                                    <?php if ($resultatsGetMessage['idAuteur'] == $_SESSION['id']) { ?>
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                            </div>
                                            <div class="sent">
                                                <p style="margin: 0; padding:0px;">
                                                    <?php echo $resultatsGetMessage['message']; ?></p>
                                            </div>
                                        </div>
                            <?php }
                                        }
                                    }
                                }
                            }
                            $requeteGetThelastedMessage = $bdd->prepare('SELECT * FROM messages WHERE idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=? 
                                    OR idAuteur=? AND nomAuteur=? AND   idCorrespondant =? AND nomCorrespondant=?  ORDER BY id DESC LIMIT 1');
                            $requeteGetThelastedMessage->execute(array(
                                $_SESSION['id'], $_SESSION['nom'],
                                $_GET['idMessager'], $_GET['nomMessager'],
                                $_GET['idMessager'], $_GET['nomMessager'],
                                $_SESSION['id'], $_SESSION['nom']
                            ));
                            $resultatsGetThelastedMessage = $requeteGetThelastedMessage->fetch();
                            if ($resultatsGetThelastedMessage['vueMessager'] == 'true') {
                                if (isset($result['bin'])) { ?>
                            <img style="float: right;" class="imagesVue" src="<?php echo $result['bin']; ?>" alt="image">
                        <?php } else { ?><div class="vue"></div> <?php }
                                                            } ?>
                </div>

                <div class="chatInput">
                    <form action="chat.php" class="chat-input" method="get">
                        <div class="d-flex justify-content-center px-1">

                            <?php $requeteGetBlockage = $bdd->prepare('SELECT * FROM blocked WHERE idAuteur=? AND nomAuteur=? AND idVictim=? AND nomVictim=? OR idAuteur=? AND nomAuteur=? AND idVictim=? AND nomVictim=? ');
                            $requeteGetBlockage->execute(array($_GET['idMessager'], $_GET['nomMessager'], $_GET['idCorrespondant'], $_GET['nomCorrespondant'], $_GET['idCorrespondant'], $_GET['nomCorrespondant'], $_GET['idMessager'], $_GET['nomMessager']));
                            $resultatsGetBlockage = $requeteGetBlockage->fetch();

                            if (isset($resultatsGetBlockage['blockage'])) {   ?>
                                <div class=" my-3">
                                </div>
                            <?php } else { ?>

                                <button name="sendImage" id="send-btn" class="btn btn-primary btn-sm ml-1" style="padding: 0 3px;"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 384 512">
                                        <path style="fill:white;" d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM64 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm152 32c5.3 0 10.2 2.6 13.2 6.9l88 128c3.4 4.9 3.7 11.3 1 16.5s-8.2 8.6-14.2 8.6H216 176 128 80c-5.8 0-11.1-3.1-13.9-8.1s-2.8-11.2 .2-16.1l48-80c2.9-4.8 8.1-7.8 13.7-7.8s10.8 2.9 13.7 7.8l12.8 21.4 48.3-70.2c3-4.3 7.9-6.9 13.2-6.9z" />
                                    </svg></button>
                                <input type="text" name="message" class="user-input form-control mx-1" placeholder="Type a Message">
                                <button name="send" id="clear-btn" class="btn btn-sm btn-primary mr-1" styl="padding: 0 3px;"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="28">
                                        <path style="fill:white;" d="M120-160v-640l760 320-760 320Zm80-120 474-200-474-200v140l240 60-240 60v140Zm0 0v-400 400Z" />
                                    </svg></button>
                                <input name="idMessager" class="hide" type="text" value="<?php echo $_GET['idMessager']; ?>">
                                <input name="prenomMessager" class="hide" type="text" value="<?php echo $_GET['prenomMessager']; ?>">
                                <input name="nomMessager" class="hide" type="text" value="<?php echo $_GET['nomMessager']; ?>">
                                <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idCorrespondant']; ?>">
                                <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomCorrespondant']; ?>">
                                <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomCorrespondant']; ?>">
                                <input name="idChat" class="hide" type="text" value="<?php echo $_GET['idChat']; ?>">
                                <input name="verification" class="hide" type="text" value="true">
                                <input name="link" class="hide" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                <!-- <input name="send" class="hide" type="text" value="true"> -->
                        </div>
                    </form>
                <?php }  ?>

                </div>
            </div>

            <!-- </div>     -->
            <script type="text/javascript">

function scrollToBottom(){
    var chatlog = document.getElementById('messagesContainer');
    chatlog.scrollTop = chatlog.scrollHeight; 

}
window.onload = function() {
    scrollToBottom();
}
            </script>
        </body>

        </html>
<?php
                        }
                    } else {
                        header('location: chatList.php');
                    }
                } ?>