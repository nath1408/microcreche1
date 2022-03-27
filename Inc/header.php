<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Micro crèche</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- jQuery first, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    <!--  styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">

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

        <nav class="navbar">
            <ul class="nav-links">
                <input type="checkbox" id="checkbox_toggle" />
                <label for="checkbox_toggle" class="hamburger">&#9776;</label>
                <div class="navbar-boutique">
                <?php


                if(internauteEstConnecte())
                {

                    echo '<li><a class="p-2 text-white" href="' . RACINE_SITE . 'moncompte.php">Voir votre profil</a></li>';
                    echo '<li><a class="p-2 text-white" href="' . RACINE_SITE . 'panier.php">Voir votre panier</a></li>';
                    echo '<li><a class="p-2 text-white" href="' . RACINE_SITE . 'boutique.php?action=deconnexion">Se déconnecter</a></li>';
                }
                else
                {
                    echo '<li><a class="p-2 text-white" href="' . RACINE_SITE . 'boutique.php">Accueil</a></li>';

                    $resultat = queryMysql('SELECT DISTINCT name FROM categories');
                    while($donnees = mysqli_fetch_assoc($resultat))
                    {

                        echo '<li ><a  href="?categorie=' .$donnees['name']. '">' .$donnees['name']. '</a></li>'."\n";


                    }
                    echo '<li><a class="p-2 text-white" href="' . RACINE_SITE . 'inscription.php">Inscription</a></li>';
                    echo '<li><a class="p-2 text-white" href="' . RACINE_SITE . 'connexion.php">Connexion</a></li>';





                    echo '<li><a class="p-2 text-white" href="' . RACINE_SITE . 'testhome/test_home.php">Site de la micro crèche</a></li>';
                }



                ?>
                </div>
            </ul>

        </nav>
    </div>


</body>
</html>