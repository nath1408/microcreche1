<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
    <link href='https://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../admin/formulairearticle.css">

</head>
<body>
<?php
require_once("../admin/config.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
    session_destroy();
}
//--- VERIFICATION ADMIN ---//

if(!internauteEstConnecteEtEstAdmin())
{
    header("location:../admin/connexionadmin.php");
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
{   // debug($_POST);
    $photo_bdd = "";
    if(isset($_GET['action']) && $_GET['action'] == 'modification')
    {
        $photo_bdd = $_POST['photo_actuelle'];
    }
    if(!empty($_FILES['photo']['name']))
    {   // debug($_FILES);
        $nom_photo = $_POST['reference'] . '_' .$_FILES['photo']['name'];
        $photo_bdd = RACINE_SITE . "photo/$nom_photo";
        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . "/photo/$nom_photo";
        move_uploaded_file($_FILES['photo']['tmp_name'],$photo_dossier);
    }


    foreach($_POST as $indice => $valeur)
    {
        $_POST[$indice] = htmlEntities(addSlashes($valeur));
    }
    queryMysql("INSERT INTO article (id_article, reference, categorie, titre, description, couleur, taille, photo, prix, stock) 
values (NULL, '$_POST[reference]', '$_POST[categorie]', '$_POST[titre]', '$_POST[description]', '$_POST[couleur]', '$_POST[taille]',   '$photo_bdd',  '$_POST[prix]',  '$_POST[stock]')");
    $contenu .= '<div class="validation">Le produit a été ajouté</div>';


}




//--- LIENS ARTICLES ---//
require_once ("../admin/headertableaudebord.php");
require_once ("../admin/menu.php");
//--- AFFICHAGE ARTICLES ---//
if(isset($_GET['action']) && $_GET['action'] == "affichage")
{
    $resultat = queryMysql("SELECT * FROM article");
    $contenu .= '<h2 class="enonce"> Liste des articles - </strong><a href="?action=ajout" class="btn btn-success btn-lg"><span class="bi-plus"></span> Ajouter</a> </h2>';
    $contenu .= '<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">';
    $contenu .= '<div class="table-responsive">';
    $contenu .= 'Nombre d\'article(s) dans la boutique : ' . $resultat->num_rows;
    $contenu .= '<table class="table table-striped table-bordered"><tr>';

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
        $contenu .= '<td><a href="?action=supprimer&id_article=' . $ligne['id_article'] . '"><img src="../Inc/img/supprimer.png" height="30px" width="30px"/></a></td>';
        $contenu .= '</tr>';
    }

    $contenu .= '</table><br /><hr/><br />';
    $contenu .='</div>';
    $contenu .= '</main>';

}
if(isset($_GET['action']) && $_GET['action'] == "suppression")
{
    queryMysql("delete from membre where id_membre=$_GET[id_membre]");
    $_GET['action'] = 'membre';

}
//-------------------------------------------------- Affichage ---------------------------------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "membre") {


    $resultat = queryMysql("SELECT * FROM membre");
    $contenu .= '<h1 class="enonce"> Voici les membres inscrits au site </h1>';
    $contenu .= '<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">';
    $contenu .= '<div class="table-responsive">';
    $contenu .= "Nombre de membre(s) : " . $resultat->num_rows;
    $contenu .= '<table class="table table-striped table-bordered"><tr>';


    while ($colonne = $resultat->fetch_field()) {
        $contenu .= '<th>' . $colonne->name . '</th>';
    }
    $contenu .= '<th> Supprimer </th>';
    $contenu .= "</tr>";
    while ($membre = $resultat->fetch_assoc()) {
        $contenu .= '<tr>';
        foreach ($membre as $information) {
            $contenu .= '<td>' . $information . '</td>';
        }
        $contenu .= '<td><a href="?action=suppression&id_membre=' . $membre['id_membre'] . '"><img src="../Inc/img/supprimer.png" height="30px" width="30px"/></a></td>';
        $contenu .= '</tr>';
    }
    $contenu .= '</table>';
    $contenu .= '</div>';
    $contenu .= '</main>';
}

if(isset($_GET['action']) && $_GET['action'] == "achats") {

    $contenu .='<h1 class="enonce"> Voici les achats passés sur le site </h1>';
    $contenu .= '<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">';
    $contenu .= '<div class="table-responsive">';

    $information_sur_les_achats = queryMysql("select c.*, m.pseudo, m.adresse, m.ville, m.code_postal from achats c left join membre m on  m.id_membre = c.id_membre");
    $contenu .= "Nombre d'achats(s) : " . $information_sur_les_achats->num_rows;
    $contenu .= '<table class="table table-striped table-bordered"><tr>';
    while ($colonne = $information_sur_les_achats->fetch_field()) {
        $contenu .= '<th>' . $colonne->name . '</th>';
    }
    $contenu .= "</tr>";
    $chiffre_affaire = 0;
    while ($achat = $information_sur_les_achats->fetch_assoc()) {
        $chiffre_affaire += $achat['montant'];
        $contenu .= '<div>';
        $contenu .= '<tr>';
        $contenu .= '<td><a href="gestion_boutique.php?suivi=' . $achat['id_achat'] . '">Voir les achats ' . $achat['id_achat'] . '</a></td>';
        $contenu .= '<td>' . $achat['id_membre'] . '</td>';
        $contenu .= '<td>' . $achat['montant'] . '</td>';
        $contenu .= '<td>' . $achat['date_achat'] . '</td>';
        $contenu .= '<td>' . $achat['pseudo'] . '</td>';
        $contenu .='<td>' . $achat['adresse'] . '</td>';
        $contenu .= '<td>' . $achat['ville'] . '</td>';
        $contenu .= '<td>' . $achat['code_postal'] . '</td>';
        $contenu .= '</tr>	';
        $contenu .= '</div>';
    }
    $contenu .= '</table><br />';
    $contenu .= '</div>';
    $contenu .= '</main>';
    $contenu .= 'Calcul du montant total des revenus:  <br />';
    $contenu .= "le chiffre d'affaires de la societe est de : $chiffre_affaire �";

    $contenu .= '<br />';
}
if(isset($_GET['suivi']))
{
    $contenu .= '<h1 class="enonce"> Voici les détails pour un achat</h1>';
    $contenu .= '<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">';
    $contenu .= '<div class="table-responsive">';


$information_sur_un_achat = queryMysql("select * from achats_details where id_achats_details=$_GET[suivi]");

$nbcol = $information_sur_un_achat->field_count;
    $contenu .= '<table class="table table-striped table-bordered"><tr>';

for ($i=0; $i < $nbcol; $i++)
{

    $colonne = $information_sur_un_achat->fetch_field();
    $contenu .= '<th>' . $colonne->name . '</th>';
}
    $contenu .= "</tr>";


while ($achats_details = $information_sur_un_achat->fetch_assoc())
{
    $contenu .= '<tr>';
    $contenu .= '<td>' . $achats_details['id_achats_details'] . '</td>';
    $contenu .= '<td>' . $achats_details['id_achat'] . '</td>';
    $contenu .= '<td>' . $achats_details['id_article'] . '</td>';
    $contenu .= '<td>' . $achats_details['prix'] . '</td>';
    $contenu .= '<td>' . $achats_details['quantite'] . '</td>';
    $contenu .= '</tr>';
}
    $contenu .= '</table>';
$contenu .='</div>';
$contenu .='</main>';
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
        

		<label for="categorie">categorie</label><br>
       <select name="categorie">
        <option value="bebe">Bébé</option>
        <option value="enfant">Enfant</option>
        <option value="femme">Femme</option>
      
    </select><br><br>


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
        <input type="text" id="stock" name="stock" placeholder="le stock "  value="'; if(isset($article_present['stock'])) echo $article_present['stock']; echo '"><br>
	 
		<input type="submit" class="button1" value="'; echo ucfirst($_GET['action']) . ' de l\'article"/>
</div>
	
	</form>';
}


?>


