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
    <link rel="stylesheet" href="Inc/CSS/style.css">

</head>
<body>
<?php
require_once("Inc/config.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//

if(isset($_GET['id_article']))  {
    $resultat = queryMysql("SELECT * FROM article WHERE id_article = '$_GET[id_article]'");
}
if($resultat->num_rows <= 0) {
    header("location:boutique.php");
    exit();
}

$article = $resultat->fetch_assoc();

$contenu ='';
$contenu .= "<h1 class='info'>Catégorie: $article[categorie]</h1><br>";
$contenu .= '<div class="fiche-article">';
$contenu .= "<h2 class='info'>Titre : $article[titre]</h2><br>";
$contenu .= "<p class='info'>Couleur: $article[couleur]</p>";
$contenu .= "<p class='info'>Taille: $article[taille]</p>";
$contenu .= "<img src='$article[photo]' width='150' height='150' alt='photo'>";
$contenu .= "<p class='info'><i>Description: $article[description]</i></p><br>";
$contenu .= "<p class='info'>Prix : $article[prix] €</p><br>";



if($article['stock'] > 0)
{
    $contenu .= '<div class="stock">';
    $contenu .= "<i>Nombre d'article(s) disponible : $article[stock] </i><br><br>";
    $contenu .= '<form method="post" action="panier.php">';
    $contenu .= "<input type='hidden' name='id_article' value='$article[id_article]'>";
    $contenu .= '<label for="quantite">Quantité : </label>';
    $contenu .= '<select id="quantite" name="quantite">';
    $contenu .= '</div>';
    for($i = 1; $i <= $article['stock'] && $i <= 5; $i++)
    {
        $contenu .= "<option>$i</option>";
    }

    $contenu .= '</select><br><br><br>';

    $contenu .= '<input type="submit" name="ajout_panier" value="ajout au panier">';
    $contenu .= '</form>';
}
else {
    $contenu .= 'Rupture de stock !';
}
$contenu .='</div><br><br>';

$contenu .= "<br><a href='boutique.php?categorie=" .$article['categorie'] . "'>Retour vers la séléction de " . $article['categorie'] ."</a>";
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once ("Inc/header.php");
echo $contenu;
require_once("Inc/footer.php"); 
?>

