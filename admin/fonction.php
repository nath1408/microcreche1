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
function internauteEstConnecteEtEstAdmin()
{
    if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) return true;
    else return false;
}
