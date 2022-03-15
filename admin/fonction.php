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


//------------------------------------
function internauteEstConnecteEtEstAdmin()
{
    if(!isset($_SESSION['admin'])) return false;
    else return true;
}
