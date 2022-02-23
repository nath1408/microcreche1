<!DOCTYPE html>
<html lang="en">
<head>

    <title>Contactez nous</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
    <link href='https://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="Inc/CSS/inscription.css">
</head>
<body>
<div class="container">
    <div class="divider"></div>
    <div class="heading">
        <h2>Inscrivez-vous</h2>
    </div>
    <p class="col-4 pt-1  "><a href="boutique.php" class="text-white">Retour à la page d'accueil</a></p>

    <form id="contact-form" method="post" action="traitementinscription.php" role="form">
        <div class="row">
            <div class="col-md-6">
                <label for="email">Veuillez entrez votre email<span class="blue">*</span></label>
                <input type="email" id="email" name="email"  class="form-control" placeholder="email">

            </div>
            <div class="col-md-6">
                <label for="pseudo">Veuillez saisir un pseudo<span class="blue">*</span></label>
                <input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="votre pseudo" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required"><br>

            </div>
            <div class="col-md-12">
                <label for="mdp">Veuillez créer votre mot de passe<span class="blue">*</span></label>
                <input type="text" id="mdp" name="mdp"  class="form-control" placeholder="mot de passe" >

            </div>
            <div class="col-md-8">
                <label for="nom">Nom</label><br>
                <input type="text" id="nom" name="nom" placeholder="votre nom"><br><br>
            </div>
            <div class="col-md-8">
                <label for="prenom">Prénom</label><br>
                <input type="text" id="prenom" name="prenom" placeholder="votre prénom"><br><br>
            </div>
            <div class="col-md-8">
                <label for="civilite">Civilité</label><br>
                <input name="civilite" id="civilite" value="m" checked="" type="radio">Homme
                <input name="civilite" id="civilite" value="f" type="radio">Femme<br><br>
            </div>
            <div class="col-md-8">
                <label for="ville">Ville</label><br>
                <input type="text" id="ville" name="ville" placeholder="votre ville" ><br><br>
            </div>
            <div class="col-md-8">
                <label for="cp">Code Postal</label><br>
                <input type="text" id="code_postal" name="code_postal" placeholder="code postal" pattern="[0-9]{5}" title="5 chiffres requis : 0-9"><br><br>

            </div>
            <div class="col-md-8">
                <label for="adresse">Adresse</label><br>
                <textarea id="adresse" name="adresse" placeholder="votre adresse" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés :  a-zA-Z0-9-_."></textarea><br><br>
            </div>

            <div class="col-md-12">

                <p class="blue">*Ces informations sont requises.</p>
            </div>
            <div class="col-md-12">
                <input type="submit" class="button1" value="Envoyez">
            </div>

        </div>

    </form>




</div>
</body>
