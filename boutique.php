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
if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
    session_destroy();
}
if(internauteEstConnecte())
{
    header("location:moncompte.php");
}
//--- AFFICHAGE DES CATEGORIES ---//
$contenu .= '<div class="container-fluid bcontent">';

$contenu .= '<div class="row">';
$contenu .= '<div class="col">';

$contenu .= '<nav class=" navbar">';
$contenu .= '<ul class="navbar-nav">';
$resultat = queryMysql('SELECT * FROM categories');

while ($donnees= mysqli_fetch_assoc($resultat) )
{
    $contenu.= '<li ><a  href="?categorie=' . $donnees['id'].'">' .$donnees['name']. '</a></li>'."\n"; //boucle pour lister les catégories et en faire des liens
}
$contenu .= '</ul>';
$contenu .= '</nav>';

if(isset($_GET['categorie']))
{
    $donnees = queryMysql("select id_article,reference,titre, description, couleur, taille, photo,prix from article where categorie='$_GET[categorie]'");


    while($article = $donnees->fetch_assoc())
    {
        $contenu .= '<div class="card">';
        $contenu .= "<h2 >$article[titre]</h2>";
        $contenu .= "<a href=\"description_article.php?id_article=$article[id_article]\"><img src=\"$article[photo]\" =\"130\" height=\"100\"></a>";
        $contenu .= "<p class='prix'>$article[prix] €</p>";
        $contenu .= '<a href="description_article.php?id_article=' . $article['id_article'] . '">Voir la fiche</a>';
        $contenu .= '</div>';

    }
    $contenu .= '</div>';
    $contenu .= '</div>';

}




//--- AFFICHAGE DES FICHES ARTICLES ---//




require_once ("Inc/header.php");




echo $contenu;




require_once("Inc/footer.php"); ?>
