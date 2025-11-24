<?php require('includes/require.php'); 

if(isset($_POST['sendModification'])){
    $date = date('d-m-Y H:i');
    if(isset($_POST['saveMyImage'])){
    $informationImage = pathinfo($_FILES['imagePost']['name']);
        $exetionImage = $informationImage['extension'];
        $exetionArray = array('jpg', 'jpeg', 'png', 'gif');
        $bin = '../images/imagesPost/' . time() . rand();
        if (in_array($exetionImage, $exetionArray)) {   
            move_uploaded_file($_FILES['imagePost']['tmp_name'], $bin);
            $requete = $bdd->prepare('UPDATE pulications SET text=?,image=?,date=? WHERE specialId=?');
            $requete->execute(array($_POST['postdescription'],$bin,$date,$_POST['specialId']));
        header('location:  posts.php?idAuteur='.$_SESSION['id'].'&nomAuteur='.$_SESSION['nom'].'&prenomAuteur='.$_SESSION['prenom'].'&idPost='.$_POST['idPost'].'&specialId='.$_POST['specialId']);
        
        }

    }else{
        $requete = $bdd->prepare('UPDATE pulications SET text=?,date=? WHERE specialId=?');
        $requete->execute(array($_POST['postdescription'],$date,$_POST['specialId']));
    header('location:  posts.php?idAuteur='.$_SESSION['id'].'&nomAuteur='.$_SESSION['nom'].'&prenomAuteur='.$_SESSION['prenom'].'&idPost='.$_POST['idPost'].'&specialId='.$_POST['specialId']);
    
    } 
 
}

if(isset($_POST['sendPostImage'])){
    echo $_FILES['imagePost']['name'];
     if (isset($_FILES['imagePost'])) {
    $date = date('d-m-Y H:i');
    $informationImage = pathinfo($_FILES['imagePost']['name']);
        $exetionImage = $informationImage['extension'];
        $exetionArray = array('jpg', 'jpeg', 'png', 'gif');
        $bin = '../images/imagesPost/' . time() . rand();
        if (in_array($exetionImage, $exetionArray)) {
            move_uploaded_file($_FILES['imagePost']['tmp_name'], $bin);
        $short = time().rand().time();
    $requete = $bdd->prepare('INSERT INTO pulications (idAuteur, nomAuteur, prenomAuteur, text,image,date,specialId) VALUES (?,?,?,?,?,?,?)');
    $requete->execute(array($_SESSION['id'],$_SESSION['nom'],$_SESSION['prenom'],htmlspecialchars($_POST['postdescription']),$bin,$date,$short));
    echo  'id:'.$_SESSION['id'].'<br> nom :'.$_SESSION['nom'].'<br> prenom : '.$_SESSION['prenom'].'<br> description : '.$_POST['postdescription'].'<br> bin : '.$bin.'<br> date : '.$date.'<br> short : '.$short;
    $requete = $bdd->prepare('SELECT * FROM pulications WHERE idAuteur=? AND nomAuteur=? AND prenomAuteur=? AND text=? AND image=? AND date=?');
    $requete->execute(array($_SESSION['id'],$_SESSION['nom'],$_SESSION['prenom'],htmlspecialchars($_POST['postdescription']),$bin,$date));
    $resulte = $requete->fetch();
    header('location:  posts.php?idAuteur='.$_SESSION['id'].'&nomAuteur='.$_SESSION['nom'].'&prenomAuteur='.$_SESSION['prenom'].'&idPost='.$resulte['id'].'&specialId='.$resulte['specialId']);
        }
    }
    
// insere la notifications
$date = date('d-m-Y H:i');
$link = 'posts.php?idAuteur='.$_SESSION['id'].'&nomAuteur='.$_SESSION['nom'].'&prenomAuteur='.$_SESSION['prenom'].'&idPost='.$resulte['id'].'&specialId='.$resulte['specialId'].'';
$requete = $bdd->prepare('INSERT INTO notification (idVictim, nomVictim, prenomVictim, type,link,date) VALUES (?,?,?, ?, ?,?)');
$requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'],'Publication',$link,$date));
header('location:  posts.php?idAuteur='.$_SESSION['id'].'&nomAuteur='.$_SESSION['nom'].'&prenomAuteur='.$_SESSION['prenom'].'&idPost='.$resulte['id'].'&specialId='.$resulte['specialId']);

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
          <style>
            button.buttonTypePost{
    padding: 7px 10px;
    border: none;
    font-size: 1.4em;
    color: white;
    background: #5e7bdd;
    border-radius: 5px;
}
.buttonTypePost2 {
    border: none;
    font-size: 1.4em;
    color: white;
    background: #5e7bdd;
    border-radius: 5px;
}

.textPostInput{
    text-align: center;
    padding: 13px 5px;
    font-size: 1.05em;
    width: 250px;
    height: 25px;
    border:none;
    font-family: sans-serif;
    background: #EEEEEE;
}
button.buttonPostText {
    padding: 7px 10px;
    font-size: 0.9em;
    width: 261px;
    color: white;
    background: #4527A0;
    border: none;
    font-family: sans-serif;
}
.templateApercuText {
    width: 100%;
    padding: 10px 0px;
    margin-bottom: 10px;
}

        </style>
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
          <?php
    }
    ?>
     </head>
<?php       require('includes/navbar.php'); ?>
     <body class="homePage">
        <?php if(isset($_GET['modification'])){  
            
            $requete=  $bdd->prepare('SELECT * FROM pulications WHERE specialId=?');
            $requete->execute(array($_GET['specialId']));
            $resulte = $requete->fetch();
            $_SESSION['specialId'] = $resulte['specialId'];
            $_SESSION['idPost'] = $resulte['id'];

            ?>

            <br><br>
          <div class='container'>
            <p class="text-center text-muted lead" >Remplissez la descrption et importez une image.</p>
            <center>
            <form  enctype="multipart/form-data" action="addImagesPost.php" class="form-group" enctype="multipart/form-data" method="post">
                <textarea name="postdescription" class="form-control"><?php echo $resulte['text']; ?></textarea>
                <div class="form-group text-center my-0 py-0 ">
                      <input class="checkbox" type="checkbox" name="saveMyImage">
                        <label class="labelCheckbox  mt-1  text-muted lead" for="checkbox">Je veux changer l'image</label>
                      </div>
                <input style="margin-top:5px;" id="images" type="file" class="form-control" name="imagePost">
                    <br>
                    <input type="text" name="specialId"  class="hide" value="<?php echo $_SESSION['specialId']; ?>">
              <input type="text" name="idPost"  class="hide" value="<?php echo $resulte['id']; ?>">
                <button style="margin-top:5px;" name="sendModification" class="btn btn-primary btn-block">Publier</button>
           
            </form>   
          </center>    
          </div>
     </body>
</html>

<?php        }else{  ?>
    <br><br>
          <div class='container'>
            <p class="text-center text-muted lead" >Remplissez la descrption et importez une image.</p>
            <center>
            <form  enctype="multipart/form-data" action="addImagesPost.php" class="form-group" method="post">
                <textarea name="postdescription" class="form-control">Votre description</textarea>
                <br>
                <input style="margin-top:5px;" id="images" type="file" class="form-control" name="imagePost">
                    <br>
                <button style="margin-top:5px;" name="sendPostImage" class="btn btn-primary btn-block">Publier</button>
           
            </form>   
          </center>    
          </div>
     </body>
</html>
<?php
} ?>
         