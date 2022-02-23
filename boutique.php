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
    <link rel="stylesheet" href="boutique.css">

</head>
<body>
<?php
require_once("Inc/config.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AFFICHAGE DES CATEGORIES ---//
$categories_articles = queryMysql("SELECT DISTINCT categories FROM article");
$contenu .= '<div class="boutique-gauche">';
$contenu .= "<ul>";
while($cat = $categories_articles->fetch_assoc())
{
    $contenu .= "<li><a href='?categories=" . $cat['categories'] . "'>" . $cat['categories'] . "</a></li>";
}
$contenu .= "</ul>";
$contenu .= "</div>";
//--- AFFICHAGE DES PRODUITS ---//
$contenu .= '<div class="fiche">';
if(isset($_GET['categories']))
{
    $donnees = queryMysql("select id_article,reference,titre,photo,prix from article where categories='$_GET[categories]'");


    while($article = $donnees->fetch_assoc())
    {
        $contenu .= '<div class="card">';
        $contenu .= "<h2>$article[titre]</h2>";
        $contenu .= "<a href=\"description_article.php?id_article=$article[id_article]\"><img src=\"$article[photo]\" =\"130\" height=\"100\"></a>";
        $contenu .= "<p class='prix'>$article[prix] €</p>";
        $contenu .= '<a href="description_article.php?id_article=' . $article['id_article'] . '">Voir la fiche</a>';
        $contenu .= '</div>';

    }
}
$contenu .= '</div>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once ("Inc/header.php");
echo $contenu;
require_once("Inc/footer.php"); ?>
