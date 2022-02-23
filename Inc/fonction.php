<?php
/**
 * @param $query
 * @return bool|mysqli_result
 */
//Lancer la requete sql
function queryMysql($query)
{
    global $connexion;
    $resultat = $connexion->query($query);
    if(!$resultat) //
    {
        die("Erreur sur la requete sql.<br>Message : " . $connexion->error . "<br>Code: " . $query);
    }
    return $resultat; //
}
//Supprimer la session

function internauteEstConnecte()
{
    if(!isset($_SESSION['membre'])) return false;
    else return true;
}
//------------------------------------

function creationDuPanier()
{
    if(!isset($_SESSION['panier']))
    {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['titre'] = array();
        $_SESSION['panier']['id_article'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();
    }
}
//------------------------------------
function ajouterArticle($titre, $id_article, $quantite, $prix)
{
    creationDuPanier();
    $position_article = array_search($id_article,  $_SESSION['panier']['id_article']);
    if($position_article !== false)
    {
        $_SESSION['panier']['quantite'][$position_article] += $quantite ;
    }
    else
    {
        $_SESSION['panier']['titre'][] = $titre;
        $_SESSION['panier']['id_article'][] = $id_article;
        $_SESSION['panier']['quantite'][] = $quantite;
        $_SESSION['panier']['prix'][] = $prix;
    }
    return true;
}
//------------------------------------
function montantGlobal()
{
    $total=0;
    for($i = 0; $i < count($_SESSION['panier']['id_article']); $i++)
    {
        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
    }
    return round($total,2);
}
//------------------------------------
function supprimerArticle($id_article_a_supprimer)
{
    $position_article = array_search($id_article_a_supprimer,  $_SESSION['panier']['id_article']);
    if ($position_article !== false)
    {
        array_splice($_SESSION['panier']['titre'], $position_article, 1);
        array_splice($_SESSION['panier']['id_article'], $position_article, 1);
        array_splice($_SESSION['panier']['quantite'], $position_article, 1);
        array_splice($_SESSION['panier']['prix'], $position_article, 1);
    }
}

