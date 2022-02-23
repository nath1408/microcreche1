<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Title</title>
    <link href="<?php echo RACINE_SITE; ?>/boutique/Inc/CSS/style.css" rel="stylesheet">



</head>
<body>




    <div class="container">
        <header>
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <img src="<?php echo RACINE_SITE; ?>/boutique/photos/logo.png" alt="logo">
            </div>
            <div class="row ">
                <h1 class="titre">La boutique des lutins</h1>
            </div>
        </div>
            </header>

        <nav>
            <?php
            if(internauteEstConnecteEtEstAdmin())
            {
                echo '<a href="' . RACINE_SITE . 'admin/gestion_membre.php">Gestion des membres</a>';
                echo '<a href="' . RACINE_SITE . 'admin/gestion_commande.php">Gestion des commandes</a>';
                echo '<a href="' . RACINE_SITE . 'admin/gestion_boutique.php">Gestion de la boutique</a>';
            }

            if(internauteEstConnecte())
            {

                echo '<a href="' . RACINE_SITE . 'moncompte.php">Voir votre profil</a>';
                echo '<a href="' . RACINE_SITE . 'boutique.php">Accès à la boutique</a>';
                echo '<a href="' . RACINE_SITE . 'panier.php">Voir votre panier</a>';
                echo '<a href="' . RACINE_SITE . '../boutique/connexion.php">Se déconnecter</a>';
            }
            else
            {

                echo '<a href="' . RACINE_SITE . 'inscription.php">Inscription</a>';
                echo '<a href="' . RACINE_SITE . 'connexion.php">Connexion</a>';


            }
            ?>
        </nav>
    </div>


</body>
</html>