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
    <link rel="stylesheet" href="moncompte.css">

</head>
<body>
<?php
require_once("Inc/config.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(!internauteEstConnecte()) header("location:connexion.php");
// debug($_SESSION);
$contenu .= '<div class="card">';
$contenu .= '<p class="centre">Bonjour <strong>' . $_SESSION['membre']['pseudo'] . '</strong></p>';
$contenu .= '<div class="cadre"><h2> Voici vos informations </h2>';
$contenu .= '<p class="info"> Votre email est: ' . $_SESSION['membre']['email'];
$contenu .= '<p class="info">Votre adresse est: ' . $_SESSION['membre']['adresse'];
$contenu .= '<p class="info">Votre code postal est: ' . $_SESSION['membre']['code_postal'];
$contenu .= '<p class="info">Votre ville est: ' . $_SESSION['membre']['ville'] . '</p>';
$contenu .= '</div>';
$contenu .= '</div>';

//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once ("Inc/header.php");
echo $contenu;
require_once("Inc/footer.php");
