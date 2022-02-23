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
    <link rel="stylesheet" href="../Inc/CSS/formulairearticle.css">

</head>
<body>
<?php
require_once("../admin/config.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//

if(!internauteEstConnecteEtEstAdmin())
{
    header("location:connexion.php");
    exit();
}
//--- SUPPRESSION PRODUIT ---//
if(isset($_GET['action']) && $_GET['action'] == "supprimer")
{	//$contenu .= $_GET['id_article']
    $resultat = queryMysql("SELECT * FROM article WHERE id_article=$_GET[id_article]");
    $suppression_article = $resultat->fetch_assoc();
    $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $suppression_article ['photo'];
    if(!empty($suppression_article ['photo']) && file_exists($chemin_photo_a_supprimer))	unlink($chemin_photo_a_supprimer);
    $contenu ="";
    $contenu .= '<div class="validation">Suppression de l\'article : N° ' . $_GET['id_article'] . '</div>';
    queryMysql("DELETE FROM article WHERE id_article=$_GET[id_article]");
    $_GET['action'] = 'affichage';
}


//--- ENREGISTREMENT PRODUIT ---//
if(!empty($_POST))
{	// debug($_POST);
    $photo_bdd = "";
    if(isset($_GET['action']) && $_GET['action'] == 'modifier')
    {
        $photo_bdd = $_POST['photo_presente'];
    }
    if(!empty($_FILES['photo']['name']))
    {	// debug($_FILES);
        $nom_photo = $_POST['reference'] . '_' .$_FILES['photo']['name'];
        $photo_bdd = RACINE_SITE . "photo/$nom_photo";
        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . "photo/$nom_photo";
        copy($_FILES['photo']['tmp_name'],$photo_dossier);
    }
    foreach($_POST as $indice => $valeur)
    {
        $_POST[$indice] = htmlEntities(addSlashes($valeur));
    }
    queryMysql("REPLACE INTO article (id_article, reference, categories, titre, description, couleur, taille, photo, prix, stock) 
values (NULL, '$_POST[reference]', '$_POST[categories]', '$_POST[titre]', '$_POST[description]', '$_POST[couleur]', '$_POST[taille]',  '$photo_bdd',  '$_POST[prix]', '$_POST[stock]' )");

    $contenu .= '<div class="validation">L\'article a été ajouté ou 
modifié</div>';


}

//--- LIENS ARTICLES ---//

$contenu .= '<a href="?action=affichage">Affichage des articles</a><br/>';
$contenu .= '<a href="?action=ajout">Ajout d\'un article</a><br /><br /><hr /><br />';
//--- AFFICHAGE ARTICLES ---//
if(isset($_GET['action']) && $_GET['action'] == "affichage")
{
    $resultat = queryMysql("SELECT * FROM article");

    $contenu .= '<h2> Affichage des articles </h2>';
    $contenu .= 'Nombre d\'article(s) dans la boutique : ' . $resultat->num_rows;
    $contenu .= '<table><tr>';

    while($colonne = $resultat->fetch_field())
    {
        $contenu .= '<th>' . $colonne->name . '</th>';
    }
    $contenu .= '<th>Modifier</th>';
    $contenu .= '<th>Supprimer</th>';
    $contenu .= '</tr>';
    while ($ligne = $resultat->fetch_assoc())
    {
        $contenu .= '<tr>';
        foreach ($ligne as $indice => $information)
        {
            if($indice == "photo")
            {
                $contenu .= '<td><img src="' . $information . '" width="70" height="70" /></td>';
            }
            else
            {
                $contenu .= '<td>' . $information . '</td>';
            }
        }
        $contenu .= '<td><a href="?action=modifier&id_article=' . $ligne['id_article'] . '"><img src="../Inc/img/modifier.png" height="30px" width="30px"/></a></td>';
        $contenu .= '<td><a href="?action=supprimer&id_article=' . $ligne['id_article'] . '));"><img src="../Inc/img/supprimer.png" height="30px" width="30px"/></a></td>';
        $contenu .= '</tr>';
    }
    $contenu .= '</table><br /><hr /><br />';
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
echo $contenu;
if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modifier'))
{
    if(isset($_GET['id_article']))
    {
        $resultat = queryMysql("SELECT * FROM article WHERE id_article=$_GET[id_article]");
        $article_present = $resultat->fetch_assoc();
    }
    echo '

<div class="container">

  <div class="divider"></div>
  <div class="heading">
	<h1> Ajouter ou modifier un article </h1>
	</div>
	<form id="contact-form" method="post" enctype="multipart/form-data" action="">
	
		<input type="hidden" id="id_article" name="id_article" value="'; if(isset($article_present['id_article'])) echo $article_present['id_article']; echo '" />
		
			
			<label for="reference">La référence</label><br />
		<input type="text" id="reference" name="reference" placeholder="La référence de l\'article" value="'; if(isset(   $article_present['reference'])) echo $article_present['reference']; echo '" /><br /><br />
        
		

		<label for="categories">La catégorie</label><br />
		<input type="text" id="categories" name="categories" placeholder="La catégorie de l\'article" value="'; if(isset(   $article_present['categories'])) echo $article_present['categories']; echo '"  /><br /><br />

		<label for="titre">Le libellé</label><br />
		<input type="text" id="titre" name="titre" placeholder="Le libellé de l\'article" value="'; if(isset(   $article_present['titre'])) echo   $article_present['titre']; echo '"  /> <br /><br />

		<label for="description">La description</label><br />
		<textarea name="description" id="description" placeholder="la description de l\'article">'; if(isset(   $article_present['description'])) echo    $article_present['description']; echo '</textarea><br /><br />
		
		<label for="couleur">La couleur</label><br />
		<input type="text" id="couleur" name="couleur" placeholder="la couleur de l\'article"  value="'; if(isset(   $article_present['couleur'])) echo   $article_present['couleur']; echo '" /> <br /><br />

		<label for="taille">La taille</label><br />
		<input type="text" id="taille" name="taille" placeholder="la taille de l\'article" value="'; if(isset(   $article_present['taille'])) echo   $article_present['taille']; echo '"  /> <br /><br />


		<label for="photo">Les photos</label><br/>
		<input type="file" id="photo" name="photo" /><br /><br />';

    if(isset($article_present))
    {
        echo '<i>Vous pouvez uplaoder une nouvelle photo si vous souhaitez la changer</i><br />';
        echo '<img src="' . $article_present['photo'] . '"  width="90" height="90" /><br />';
        echo '<input type="hidden" name="photo_presente" value="' . $article_present['photo'] . '" /><br />';
    }

    echo '
		<label for="prix">prix</label><br />
		<input type="text" id="prix" name="prix" placeholder="le prix du produit"  value="'; if(isset($article_present['prix'])) echo $article_present['prix']; echo '" /><br /><br />
	
	<label for="stock">stock</label><br>
        <input type="text" id="stock" name="stock" placeholder="le stock "  value="'; if(isset($article_present['stock'])) echo $article_present['stock']; echo '"><br><br>
	 
		<input type="submit" class="button1" value="'; echo ucfirst($_GET['action']) . ' de l\'article"/>
</div>
	
	</form>';
}
require_once("../Inc/footer.php");
?>


