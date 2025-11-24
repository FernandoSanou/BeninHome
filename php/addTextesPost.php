<?php require('includes/require.php'); 
if(isset($_GET['sendPostText'])){
    $date = date('d-m-Y H:i');
    $short = time().rand().time();
   $requetes= $bdd->prepare('INSERT INTO pulications(idAuteur,nomAuteur,prenomAuteur, text,template,date,specialId) VALUES(?,?,?,?,?,?,?)');
    $requetes->execute(array($_SESSION['id'],$_SESSION['nom'],$_SESSION['prenom'],htmlspecialchars($_GET['postObject']),$_GET['template'],$date,$short));
// echo 'id : '.$_SESSION['id'].'<br>nom :'.$_SESSION['nom'].'<br> prenom :'.$_SESSION['prenom'].'<br> post : '.$_GET['postObject'].'<BR> image : none'.'<br> template : '.$_GET['template'].'<br> date : '.$date;
$requete = $bdd->prepare('SELECT * FROM pulications WHERE idAuteur=? AND nomAuteur=? AND prenomAuteur=? AND text=? AND template=? AND date=?');
$requete->execute(array($_SESSION['id'],$_SESSION['nom'],$_SESSION['prenom'],htmlspecialchars($_GET['postObject']),$_GET['template'],$date));
$resulte = $requete->fetch();

// insere la notifications
$link = 'posts.php?idAuteur='.$_SESSION['id'].'&nomAuteur='.$_SESSION['nom'].'&prenomAuteur='.$_SESSION['prenom'].'&idPost='.$resulte['id'].'&specialId='.$resulte['specialId'].'';
$requete = $bdd->prepare('INSERT INTO notification (idVictim, nomVictim, prenomVictim, type,link,date) VALUES (?,?,?, ?, ?,?)');
$requete->execute(array($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'],'Publication',$link,$date));
header('location:  posts.php?idAuteur='.$_SESSION['id'].'&nomAuteur='.$_SESSION['nom'].'&prenomAuteur='.$_SESSION['prenom'].'&idPost='.$resulte['id'].'&specialId='.$resulte['specialId']);
}
if(isset($_GET['sendModification'])){
    $date = date('d-m-Y H:i');
    $requete = $bdd->prepare('UPDATE pulications SET text=?,template=?,date=? WHERE specialId=?');
    $requete->execute(array($_GET['postObject'],$_GET['template'],$date,$_GET['specialId']));
header('location:  posts.php?idAuteur='.$_SESSION['id'].'&nomAuteur='.$_SESSION['nom'].'&prenomAuteur='.$_SESSION['prenom'].'&idPost='.$_GET['idPost'].'&specialId='.$_GET['specialId']);

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
<?php if(isset($_GET['modification'])){ 
       if(isset($_GET['style'])){  
        $requete=  $bdd->prepare('SELECT * FROM pulications WHERE specialId=?');
        $requete->execute(array($_GET['specialId']));
        $resulte = $requete->fetch();

        ?>
<body class="homePage">
        <br><br>
        <div class='container'>  <center>
          <p class="h5">Entrez l'object de votre publicaion .</p>
          <form style="width: 260px;" action="" method="get">
              <div class="templateApercuText <?php echo $_GET['template']; ?>">Apercu</div>
                <div class="form-group"><textarea name="postObject" class="form-control"><?php echo $resulte['text'];  ?></textarea>
           </div>
              <input name="template" class="hide" type="text" value="<?php echo $_GET['template']; ?>">
              <input type="text" name="specialId"  class="hide" value="<?php echo $_GET['specialId']; ?>">
              <input type="text" name="idPost"  class="hide" value="<?php echo $resulte['id']; ?>">
              <button name="sendModification" class="btn btn-primary btn-block">Publier</button>
         
          </form>     </center>
          <br>   
   </body>
</html>
  <?php   
}else{ ?>

    <body class="homePage">
                <br><br>
                <div class='container text-center'>
                  <p class="h4 text-center">Choissez un autre design</p>
                  <div class="template" >
      <a  href="addTextesPost.php?style=true&template=template1<?php echo'&specialId='.$_GET['specialId'].'&modification=true'; ?>"><div class="postText text-center template1">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template2<?php echo'&specialId='.$_GET['specialId'].'&modification=true'; ?>"><div class="postText text-center template2">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template3<?php echo'&specialId='.$_GET['specialId'].'&modification=true'; ?>"><div class="postText text-center template3">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template4<?php echo'&specialId='.$_GET['specialId'].'&modification=true'; ?>"><div class="postText text-center template4">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template5<?php echo'&specialId='.$_GET['specialId'].'&modification=true'; ?>"><div class="postText text-center template5">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template6<?php echo'&specialId='.$_GET['specialId'].'&modification=true'; ?>"><div class="postText text-center template6">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template7<?php echo'&specialId='.$_GET['specialId'].'&modification=true'; ?>"><div class="postText text-center template7">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template8<?php echo'&specialId='.$_GET['specialId'].'&modification=true'; ?>"><div class="postText text-center template8">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template9<?php echo'&specialId='.$_GET['specialId'].'&modification=true'; ?>"><div class="postText text-center template9">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template10<?php echo'&specialId='.$_GET['specialId'].'&modification=true'; ?>"><div class="postText text-center template10">Text</div>      </a>
      </div>     
            
                  <br>   
                  <a class=" text-primary" href="addPost.php">Retour >
                                                             <!-- <button class="btn btn-primary">Aller voir</button> -->
                        </div>                               </a>
           </body>
      </html>

<?php  }
}else{ 
     if(isset($_GET['style'])){ ?>


        <body class="homePage">
                <br><br>
                <div class='container'>  <center>
                  <p class="h5">Entrez l'object de votre publicaion .</p>
                  <form style="width: 260px;" action="" method="get">
                      <div class="templateApercuText <?php echo $_GET['template']; ?>">Apercu</div>
                        <div class="form-group"><textarea name="postObject" class="form-control">Votre publication</textarea>
                   </div>
                      <input name="template" class="hide" type="text" value="<?php echo $_GET['template']; ?>">
                      <button name="sendPostText" class="btn btn-primary btn-block">Publier</button>
                 
                  </form>     </center>
                  <br>   
           </body>
      </html>
          <?php   
      }else{
       ?>
           <body class="homePage">
                <br><br>
                <div class='container text-center'>
                  <p class="h4 text-center">Choissez un design parmis ceux disponibles</p>
                  <div class="template" >
      <a  href="addTextesPost.php?style=true&template=template1"><div class="postText text-center template1">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template2"><div class="postText text-center template2">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template3"><div class="postText text-center template3">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template4"><div class="postText text-center template4">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template5"><div class="postText text-center template5">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template6"><div class="postText text-center template6">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template7"><div class="postText text-center template7">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template8"><div class="postText text-center template8">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template9"><div class="postText text-center template9">Text</div></a>
      <a  href="addTextesPost.php?style=true&template=template10"><div class="postText text-center template10">Text</div>      </a>
      </div>     
            
                  <br>   
                  <a class=" text-primary" href="addPost.php">Retour >
                                                             <!-- <button class="btn btn-primary">Aller voir</button> -->
                        </div>                               </a>
           </body>
      </html>
      <?php }
 }?>