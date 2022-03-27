<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
    <link href='https://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link href="<?php echo RACINE_SITE; ?>Inc/CSS/style.css" rel="stylesheet">

</head>
<body>
<?php
require_once("Inc/config.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
    session_destroy();
}
if(internauteEstConnecte())
{
    header("location:moncompte.php");
}
/***********************Affichage des articles*******************************************/

if(isset($_GET['categorie']))
{
    $donnees = queryMysql("select id_article,reference,titre, description, couleur, taille, photo,prix from article where categorie='$_GET[categorie]'");


    while($article = $donnees->fetch_assoc())
    {
        $contenu .= '<div class="card">';
        $contenu .= "<a href=\"description_article.php?id_article=$article[id_article]\"><img src=\"$article[photo]\" =\"130\" height=\"100\" alt='photo'></a>";
        $contenu .= "<p class='prix'>$article[prix] €</p>";
        $contenu .= '<a href="description_article.php?id_article=' . $article['id_article'] . '">Voir la fiche</a>';
        $contenu .= '</div>';

    }



}
else{
    $donnees = queryMysql("select id_article, categorie,titre, taille, photo,prix from article order by date_ajout desc limit 0,8 ");



    while ($article = $donnees->fetch_assoc()) {
      $contenu .=' <div class="album py-5 ">';
        $contenu .= ' <div class="container">';


    $contenu .='  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';
    $contenu .='    <div class="col">';


     $contenu .='      <div class="card shadow-sm">';
        $contenu .= '<div class="card-body ">';
        $contenu .= "<p class='prix'>$article[categorie] </p>";
        $contenu .= "<p><img src=\"$article[photo]\" =\"130\" height=\"100\" alt='photo'></a></p>";
        $contenu .= "<p class='prix'>$article[prix] €</p>";
        $contenu .= '<div class="card-text"></div><a href="description_article.php?id_article=' . $article['id_article'] . '">Voir la fiche</a></div>';
        $contenu .= '</div>';
        $contenu .= '</div>';
        $contenu .= '</div>';
        $contenu .= '</div>';
        $contenu .= '</div>';
        $contenu .= '</div>';



    }
}





require_once ("Inc/header.php");


echo $contenu;


require_once("Inc/footer.php"); ?>
