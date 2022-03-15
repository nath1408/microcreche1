<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Title</title>
    <link href="<?php echo RACINE_SITE; ?>Inc/CSS/style.css" rel="stylesheet">



</head>
<body>




    <div class="container">
        <header>
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <img src="<?php echo RACINE_SITE; ?>Inc/img/logo.png" alt="logo">
            </div>
            <div class="row ">
                <h1 class="titre">La boutique des lutins</h1>
            </div>
        </div>
            </header>

        <nav>
            <?php

            if(internauteEstConnecte())
            {

                echo '<a href="' . RACINE_SITE . 'moncompte.php">Voir votre profil</a>';
                echo '<a href="' . RACINE_SITE . 'boutique.php">Accès à la boutique</a>';
                echo '<a href="' . RACINE_SITE . 'panier.php">Voir votre panier</a>';
                echo '<a href="' . RACINE_SITE . 'boutique.php?action=deconnexion">Se déconnecter</a>';
            }
            else
            {

                echo '<li><a href="' . RACINE_SITE . 'inscription.php">Inscription</a>';
                echo '<li><a href="' . RACINE_SITE . 'connexion.php">Connexion</a>';
                echo '<li><a href="' . RACINE_SITE . 'boutique.php">Acces à la boutique</a>';


                echo '<li><a href="' . RACINE_SITE . 'testhome/test_home.html">Retour à la page d\'accueil de la micro crèche</a>';
                }



            ?>
        </nav>
    </div>


</body>
</html>