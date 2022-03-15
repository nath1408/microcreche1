<!DOCTYPE html>
<html lang="en">
<head>

    <title>Connectez vous</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
    <link href='https://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../admin/loginconnexion.css">
</head>
<body>
<div class="container">
    <div class="divider"></div>
    <div class="heading">
        <h2>Identifiez-vous</h2>
    </div>
    <p class="col-4 pt-1  "><a href="" class="text-white">Retour à la page d'accueil</a></p>

    <form id="contact-form" method="post" action="traitementconnexionadmin.php" role="form">
        <div class="row">
            <div class="col-md-6">
                <label for="nomAdmin">Votre nom d'administrateur<span class="blue">*</span></label>
                <input type="text" id="nomAdmin" name="nomAdmin"  class="form-control" placeholder="nomAdmin">

            </div>

            <div class="col-md-12">
                <label for="mdpAdmin">Mot de passe<span class="blue">*</span></label>
                <input type="text" id="mdpAdmin" name="mdpAdmin"  class="form-control" placeholder="mot de passe" >
                <div class="pass-link">
                    <a href="">Mot de passe oublié?</a>
                </div>


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

