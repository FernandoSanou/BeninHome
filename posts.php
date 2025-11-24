<?php require('includes/require.php'); 



?>
        <?php 
        if(isset($_GET['specialId'])&&isset($_GET['idPost'])){
                      ?>
<!DOCTYPE html>
<html lang="fr">

     <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
<title>beninHome</title>
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
.postText {
    width: 130px;
    padding: 20px 0;
    border: solid 1px #555;
    margin: 2px 0;
    display: inline-block;
}

.template1 {
    background: #37474F;
    color: white;
}
.template2 {
    background: #E53935;
    color: white;
}
.template3 {
    background: #2196F3;
    color: white;
}
.template4 {
    background: #EF6C00;
    color: white;
}
.template5 {
    background: #673AB7;
    color: white;
}
.template6 {
    background: #388E3C;
    color: white;
}
.template7 {
    color: white;
    background: linear-gradient(to left, #FF9800, #60bbdf);
}
.template8 {
    color: white;
    background: linear-gradient(to right, #F44336, #009688);
}
.template9 {
    background: #FDD835;
    color: #555;
}
.template10 {
    background: #555;
    color: wheat;
}
.textPostInput{
    text-align: center;
    padding: 13px 5px;
    font-size: 1.05em;
    width: 250px;
    height: 50px;
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
.post{
    width: 300px;
    margin: 0 auto;
    border: solid 1px #555;
}

.checkProfilePost {
    background-color: transparent;
    border: none;
    cursor: pointer;
    color: #555;
    font-family: sans-serif;
    font-size: 0.9em;
    padding: 0;
    margin-left: auto;
}

h2 {
    padding: 0 0 10px;
    width: 150px;
    margin-bottom: 10px;
    display: inline-block;
    font-size: 1.1em;
}
.pubs{
    padding:20px;
    font-size: 1.24em;
}

img.userImagePost {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-bottom: -21px;
}
.userPost {
    border: none;
    background: transparent;
    height: auto;
    width: 100%;
    text-align: left;
    color: #555;
    font-size: 0.9em;
}
.imagePost {
    border-top: 1px solid #d6cece;
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
    <?php   

 ?>
     <body class="homePage">
<br>
          <div class='Description'>        
        <?php 
    $requete = $bdd->prepare('SELECT * FROM pulications WHERE id=? AND idAuteur=? AND nomAuteur=? AND prenomAuteur=? AND specialId=?');
       $requete->execute(array($_GET['idPost'],$_SESSION['id'],$_SESSION['nom'],$_SESSION['prenom'],$_GET['specialId']));
       $resultGetPost = $requete->fetch(); 
       if(!empty($resultGetPost['template'])){
       ?>
           <form action="posts.php" method="get" class="post">
 <?php $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? ');
 $requeteCountImage->execute(array($_GET['idAuteur'], $_GET['nomAuteur']));
 $imageCount = $requeteCountImage->fetch()['image_count'];

 if ($imageCount == 0) { ?>
      <!-- <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">  <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>"> -->
      <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
      <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
      <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomAuteur']; ?>">
      <button name="checkProfile" class="userPost">
           <div onmouseover="showIcon();" class="circle"> </div>
           <div id="addPictures1" class="addPictures1">
 <h2><?php echo $_GET['nomAuteur'].' '.$_GET['prenomAuteur'] ?></h2>
      </button>
</div>
<?php  } else {
      $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE idAuteur = ? ORDER BY id DESC LIMIT 1  ');
      $requeteGetImage->execute(array($_GET['idAuteur']));
      while ($result = $requeteGetImage->fetch()) { ?>
 <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">
 <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
 <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
 <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomAuteur']; ?>">
 <button name="checkProfile" class="userPost">
           <img class="userImagePost" src="<?php echo $result['bin']; ?>" alt="image">
           <h2><?php echo $_GET['nomAuteur'].' '.$_GET['prenomAuteur'] ?></h2>
 </button>
 <?php } } ?>

        <div class="postsText">
            <div class="pubs <?php echo $resultGetPost['template']; ?>">
<p style="color: white;"><?php echo $resultGetPost['text']; ?></p>
            </div>
            <div class="actionPost">
                <p>j'aime  | commentaire | vue</p>
            </div>
        </div>
        <?php } if(empty($resultGetPost['template'])){ ?>
            <form action="posts.php" method="get" class="post">
 <?php $requeteCountImage = $bdd->prepare('SELECT COUNT(*) AS image_count FROM images WHERE idAuteur = ? AND nomAuteur = ? ');
 $requeteCountImage->execute(array($_GET['idAuteur'], $_GET['nomAuteur']));
 $imageCount = $requeteCountImage->fetch()['image_count'];

 if ($imageCount == 0) { ?>
      <!-- <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">  <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>"> -->
      <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
      <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
      <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomAuteur']; ?>">
      <button name="checkProfile" class="userPost">
           <div onmouseover="showIcon();" class="circle"> </div>
           <div id="addPictures1" class="addPictures1">
 <h2><?php echo $_GET['nomAuteur'].' '.$_GET['prenomAuteur'] ?></h2>
      </button>
</div>
<?php  } else {
      $requeteGetImage = $bdd->prepare('SELECT * FROM images WHERE idAuteur = ? ORDER BY id DESC LIMIT 1  ');
      $requeteGetImage->execute(array($_GET['idAuteur']));
      while ($result = $requeteGetImage->fetch()) { ?>
 <input name="images" type="text" value="<?php echo $result['bin']; ?>" class="hide">
 <input name="idCorrespondant" class="hide" type="text" value="<?php echo $_GET['idAuteur']; ?>">
 <input name="nomCorrespondant" class="hide" type="text" value="<?php echo $_GET['nomAuteur']; ?>">
 <input name="prenomCorrespondant" class="hide" type="text" value="<?php echo $_GET['prenomAuteur']; ?>">
 <button name="checkProfile" class="userPost">
           <img class="userImagePost" src="<?php echo $result['bin']; ?>" alt="image">
           <h2><?php echo $_GET['nomAuteur'].' '.$_GET['prenomAuteur'] ?></h2>
 </button>
 <?php } } ?>

            <div class="postsText">
            <div class="imagePost">
<p style="color: black; text-align:left; margin:0px;"><?php echo $resultGetPost['text']; ?></p>
<img style="  width: 100%;max-height: 250px;" src="<?php echo $resultGetPost['image'];  ?>" alt="image indisponible">
            </div>
            <div class="actionPost">
                <p>j'aime  | commentaire | vue</p>
            </div>
        </div>
       <?php } ?>
            </form>

          </div>
            <br>   
     </body>
</html>
<?php }else{
    header('location: home.php');
} ?>