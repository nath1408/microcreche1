<?php
$prenom=$nom=$email=$tel=$message="";
$prenomError=$nomError=$emailError=$telError=$messageError="";
$isSuccess = false;
$emailTo ="05microcreche@gmail.com";
if ($_SERVER['REQUEST_METHOD']=="POST")
{
    $prenom = verifyInput($_POST["prenom"]);
    $nom = verifyInput($_POST["nom"]);
    $email = verifyInput($_POST["email"]);
    $tel= verifyInput($_POST["tel"]);
    $message = verifyInput($_POST["message"]);
    $isSuccess = true;
    $emailText = "";
    if(empty($prenom))
    {
        $prenomError="Il me faut connaitre votre prénom pour continuer.";
        $isSuccess =false;
    }
    else
    {
        $emailText .="Le prénom:$prenom\n";
    }
    if(empty($nom))
    {
        $nomError="et oui, je veux tout savoir, même votre nom";
        $isSuccess =false;
    }
    else
    {
        $emailText .="Le nom:$nom\n";
    }
    if(empty($message))
    {
        $messageError="Il est nécessaire d'écrire un message";
        $isSuccess =false;
    }
    else
    {
        $emailText .="Le message:$message\n";
    }

    if (!isEmail($email))
    {
        $emailError="Ce n'est pas un email, retentez.";
        $isSuccess =false;
    }
    else
    {
        $emailText .="email:$email\n";
    }

    if (!isTel($tel))
    {
        $telError="Mettez que des chiffres et des espaces, retentez.";
        $isSuccess =false;
    }
    else
    {
        $emailText .="Le téléphone:$tel\n";
    }

    if ($isSuccess)
    {
        $headers ="De: $prenom $nom <$email>\r\nReply-To: $email";
mail($emailTo, "Un message de votre site", $emailText, $headers);
$prenom=$nom=$email=$tel=$message="";
}
}
function isTel($var)
{
return preg_match("/^[0-9 ]*$/", $var);
}

function isEmail($var)
{
return filter_var($var, FILTER_VALIDATE_EMAIL );
}
function verifyInput($var)
{
$var = trim($var);
return $var;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Contactez nous</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
    <link href='https://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="test.css">
</head>
<body>
<div class="container">
    <div class="divider"></div>
    <div class="heading">
        <h2>Contactez-nous</h2>
    </div>
    <p class="col-4 pt-1  "><a href="../testhome/test_home.html" class="text-white">Retour à la page d'accueil</a></p>

    <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" role="form">
        <div class="row">
            <div class="col-md-6">
                <label for="prenom">Votre prénom<span class="blue">*</span></label>
                <input type="text" id="prenom" name="prenom"  class="form-control" placeholder="Votre prénom" value="<?php echo $prenom;?>">
                <p class="comments"><?php echo $prenomError;?></p>
            </div>
            <div class="col-md-6">
                <label for="nom">Votre nom<span class="blue">*</span></label>
                <input type="text" id="nom" name="nom"   class="form-control" placeholder="Votre nom"  value="<?php echo $nom;?>">
                <p class="comments"><?php echo $nomError;?></p>
            </div>
            <div class="col-md-6">
                <label for="email">Votre email<span class="blue">*</span></label>
                <input type="email" id="email" name="email"   class="form-control" placeholder="Votre email"  value="<?php echo $email;?>">
                <p class="comments"><?php echo $emailError;?></p>
            </div>
            <div class="col-md-6">
                <label for="tel">Votre téléphone<span class="blue">*</span></label>
                <input type="tel" id="tel" name="tel"   class="form-control" placeholder="Votre téléphone"  value="<?php echo $tel;?>">
                <p class="comments"><?php echo $telError;?></p>
            </div>
            <div class="col-md-12">
                <label for="message">Votre message<span class="blue">*</span></label>
                <textarea id="message" name="message"  class="form-control" placeholder="Votre message" rows="4"   <?php echo $message;?>></textarea>
                <p class="comments"> <?php echo $messageError;?></p>
            </div>
            <div class="col-md-12">
                <p class="blue">*Ces informations sont requises.</p>
            </div>
            <div class="col-md-12">
                <input type="submit" class="button1" value="Envoyez">
            </div>
        </div>
        <p class="thank you" style="display:<?php if($isSuccess) echo'block'; else echo'none'?>>Votre message a bien été envoyé.</p>

  </form>
</div>
</body>
</html>