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
    <link rel="stylesheet" href="panier.css">

</head>
<body>
<?php
require_once("Inc/config.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AJOUT PANIER ---//
if(isset($_POST['ajout_panier']))
{   //debug($_POST);
    $resultat = queryMysql("SELECT * FROM article WHERE id_article='$_POST[id_article]'");
    $article = $resultat->fetch_assoc();
    ajouterArticle($article['titre'],$_POST['id_article'],$_POST['quantite'],$article['prix']);
}
//--- VIDER PANIER ---//
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
}
//--- PAIEMENT ---//
if(isset($_POST['payer']))
{
    for($i=0 ;$i < count($_SESSION['panier']['id_article']) ; $i++)
    {
        $resultat = queryMysql("SELECT * FROM article WHERE id_article=" . $_SESSION['panier']['id_article'][$i]);
        $article = $resultat->fetch_assoc();
        if($article['stock'] < $_SESSION['panier']['quantite'][$i])
        {
            $contenu .= '<hr><div class="erreur">Stock Restant: ' . $article['stock'] . '</div>';
            $contenu .= '<div class="erreur">Quantité demandée: ' . $_SESSION['panier']['quantite'][$i] . '</div>';
            if($article['stock'] > 0)
            {
                $contenu .= '<div class="erreur">la quantité de l\'article ' . $_SESSION['panier']['id_artcile'][$i] . ' à été réduite car notre stock était insuffisant, veuillez vérifier vos achats.</div>';
                $_SESSION['panier']['quantite'][$i] = $article['stock'];
            }
            else
            {
                $contenu .= '<div class="erreur">l\'article ' . $_SESSION['panier']['id_article'][$i] . ' a été retiré de votre panier car nous sommes en rupture de stock, veuillez vérifier vos achats.</div>';
                supprimerArticle($_SESSION['panier']['id_article'][$i]);
                $i--;
            }
            $erreur = true;
        }
    }
    if(!isset($erreur))
    {
        queryMysql("INSERT INTO achats (id_membre, montant, date_achat) VALUES (" . $_SESSION['membre']['id_membre'] . "," . montantGlobal() . ", NOW())");
        $id_achat = $connexion->insert_id;
        for($i = 0; $i < count($_SESSION['panier']['id_article']); $i++)
        {
            queryMysql("INSERT INTO achats_details (id_achat, id_article, quantite, prix) VALUES ($id_achat, " . $_SESSION['panier']['id_article'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
        }
        unset($_SESSION['panier']);
        mail($_SESSION['membre']['email'], "confirmation de la commande", "Merci votre n° de suivi est le $id_achat", "From:05microcreche@gmail.com");
        $contenu .= "<div class='validation'>Merci pour votre commande. votre n° de suivi est le $id_achat</div>";
    }
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once ("Inc/header.php");

echo $contenu;
echo "<div class=container>";
echo "<h2 class='titre1'>Votre panier</h2>";
echo "<table>";
echo "<thead>";
echo "<tr><th>Titre</th><thArticler</th><th>Quantité</th><th>Prix Unitaire</th><th>Total</th></tr>";
echo "<thead>";
if(empty($_SESSION['panier']['id_article'])) // panier vide
{
    echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
}
else
{
    for($i = 0; $i < count($_SESSION['panier']['id_article']); $i++)
    {
        echo "<tbody>";
        echo "<tr>";
        echo "<td>" . $_SESSION['panier']['titre'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['quantite'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['prix'][$i] . "</td>";
        echo "</tr>";
        echo "</tbody>";
    }
    echo "<tbody>";
    echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . montantGlobal() . " euros</td></tr>";
    echo "</body>";
}
echo "</table><br>";
 if(internauteEstConnecte())
    {
        echo '<form method="post" action="checkout.html">';
        echo '<tr><td colspan="5"><input type="submit" name="payer" value="Valider le panier" class="button"></td></tr>';
        echo '</form>';
    }
    else
    {
        echo '<tr><td colspan="3">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>';
    }
    echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>";

echo "</div>";
require_once ("Inc/footer.php");
?>
