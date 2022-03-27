<?php
//--------- BDD
$connexion = new mysqli("localhost", "root", "", "microcreche");
if ($connexion->connect_error) die('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $connexion->connect_error);

// $mysqli->set_charset("utf8");
//--------- SESSION
session_start();
//--------- CHEMIN
define("RACINE_SITE","/site de la micro creche/");
//--------- VARIABLES
$contenu = '';
//--------- AUTRES INCLUSIONS
require_once("../admin/fonction.php");


