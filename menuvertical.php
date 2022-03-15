<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Vertical Navbar Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="boutique.css">
    <style>
        .bcontent {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container-fluid bcontent">

    <div class="row">
        <div class="col-3">


            <?php
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
$contenu .= '</div>';
$contenu .= '</div>';

?>

        </div>
    </div>
</div>
</body>
</html>
