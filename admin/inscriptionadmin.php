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
    <link rel="stylesheet" href="../admin/registeradmin.css">
</head>
<body>
<div class="container">
    <div class="divider"></div>
    <div class="heading">
        <h2>Inscrivez-vous</h2>
    </div>
    <p class="col-4 pt-1  "><a href="" class="text-white">Retour à la page d'accueil</a></p>

    <form id="contact-form" method="post" action="traitementinscriptionadmin.php" role="form">
        <div class="row">

            <div class="col-md-6">
                <label for="nomAdmin">Veuillez saisir votre nom<span class="blue">*</span></label>
                <input type="text" id="nomAdmin" name="nomAdmin" maxlength="20" placeholder="votre nom" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required"><br>

            </div>
            <div class="col-md-12">
                <label for="mdpAdmin">Veuillez créer votre mot de passe<span class="blue">*</span></label>
                <input type="text" id="mdpAdmin" name="mdpAdmin"  class="form-control" placeholder=" Votre mot de passe" >

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

