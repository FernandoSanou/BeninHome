<?php


require('includes/require.php');

if (isset($_SESSION['adminer'])) {
    if ($_SESSION['adminer'] = 'theBoss') {
        if ($_SESSION['nom'] = 'SANOU' && $_SESSION['prenom'] = 'Fernando' && $_SESSION['number'] = '60421373') {

?>



<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
<title>BéniHome</title>
        <style>
        table {
            border: solid 1px #5e7bdd;
            margin: 0 auto;
        }

        td,
        tr,
        th {
            border: solid 1px #5e7bdd;
        }

        .cirle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #555;
        }

        .images {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        </style>
    </head>

    <body>
        <br><br>
        <?php
                $requeteCount = $bdd->prepare('SELECT COUNT(*) AS user_count FROM user WHERE id ');
                $requeteCount->execute(array('7'));
                $count = $requeteCount->fetch()['user_count'];
                ?>
        <h2>Utilisateur (<?php echo $count; ?>)</h2>
        <?php
                // compter le nombre de prorietaire 
                $requeteCountProprietaire = $bdd->prepare('SELECT COUNT(*) AS proprietaire_count FROM user WHERE type=? ');
                $requeteCountProprietaire->execute(array('Proprietaire'));
                $countProprietaire = $requeteCountProprietaire->fetch()['proprietaire_count'];
                ?>
        <h2>Propriétaire (<?php echo $countProprietaire; ?>)</h2>
        <?php
                // compter le nombre de locataire 

                $requeteCountLocataire = $bdd->prepare('SELECT COUNT(*) AS locataire_count FROM user WHERE type=? ');
                $requeteCountLocataire->execute(array('Locataire'));
                $countLocataire = $requeteCountLocataire->fetch()['locataire_count'];
                ?>
        <h2>Locataire (<?php echo $countLocataire; ?>)</h2>

        <div class="">
            <?php
                    $requete = $bdd->query('SELECT * 
                                                      FROM user
                                                      ORDER BY id');
                    echo '<table>
                                                <form method="get" action="form.php">
                                                                <tr clas="tete">
                                                                <th>ID</th>
                                                                <th>Photo</th>
                                                                <th>Nom</th>
                                                                <th>Prenom</th>
                                                                <th>Actions</th>
                                                                <th>Email</td>
                                                                <th>Ville</th>
                                                                <th>Type</th>
                                                                <th>numeros</th>
                                                                 <th>status</th>
                                                                 <th>password</th>
                                                                </tr>';
                    while ($donnees = $requete->fetch()) {
                        $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? ');
                        $requeteCountImage->execute(array($donnees['id'], $donnees['nom']));
                        $imageCount = $requeteCountImage->fetch()['image_count'];

                        echo '
                <tr>
                    <td>' . $donnees['id'] . '</td> ';
                        if ($imageCount == 0) { ?><td>
                <div class="cirle"></div>
            </td><?php  } else {
                                    $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE idAuteur = ? AND nomAuteur = ?  ORDER BY id DESC LIMIT 1  ');
                                    $requeteGetImage->execute(array($donnees['id'], $donnees['nom']));
                                    while ($result = $requeteGetImage->fetch()) { ?> <td><img class="images"
                    src="<?php echo $result['bin']; ?>" alt="profile"></td>
            <?php }
                                }
                                echo '   <td>' . $donnees['nom'] . '</td>
                    <td>' . $donnees['prenom'] . '</td>
                    <td></td>
                    <td>' . $donnees['email'] . '</td>
                    <td>' . $donnees['ville'] . '</td>
                    <td>' . $donnees['type'] . '</td>
                    <td>' . $donnees['number'] . '</td>
                    <td>' . $donnees['online'] . '</td>
                    <td>' . $donnees['password'] . '</td>
                </tr>
            </form>';
                            }
                            echo '</table>';
                            $requete->closeCursor(); ?>
        </div>
    </body>

</html>


<?php
        } else {

            header('location: login.php');
        }
    } else {
        header('location: login.php');
    }
} else {
    header('location: login.php');
}