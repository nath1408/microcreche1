<?php
$firstname=$name=$email=$phone=$message="";
$firstnameError=$nameError=$emailError=$phoneError=$messageError="";
$isSuccess = false;
$emailTo ="05microcreche@gmail.com";
if ($_SERVER['REQUEST_METHOD']=="POST")
{
    $firstname = verifyInput($_POST["firstname"]);
    $name = verifyInput($_POST["name"]);
    $email = verifyInput($_POST["email"]);
    $phone= verifyInput($_POST["phone"]);
    $message = verifyInput($_POST["message"]);
    $isSuccess = true;
    $emailText = "";

    if(empty($firstname))
    {
        $firstnameError="Il me faut connaitre votre prénom pour continuer.";
        $isSuccess =false;
    }
    else
    {
        $emailText .="firstname:$firstname\n";
    }

    if(empty($name))
    {
        $nameError="et oui, je veux tout savoir, même votre nom";
        $isSuccess =false;
    }
    else
    {
        $emailText .="name:$name\n";
    }


    if(empty($message))
    {
        $messageError="Il est nécessaire d'écrire un message";
        $isSuccess =false;
    }
    else
    {
        $emailText .="message:$message\n";
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

    if (!isPhone($phone))
    {
        $phoneError="Mettez que des chiffres et des espaces, retentez.";
        $isSuccess =false;
    }
    else
    {
        $emailText .="phone:$phone\n";
    }

    if ($isSuccess)
    {
        $headers ="From: $firstname $name <$email>\r\nReply-To: $email";
        mail($emailTo, "Un message de votre site", $emailText, $headers);
        $firstname=$name=$email=$phone=$message="";
    }
}
function isPhone($var)
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
<html lang="en">
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

  <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" role="form">
    <div class="row">
      <div class="col-md-6">
        <label for="firstname">Votre prénom<span class="blue">*</span></label>
        <input type="text" id="firstname" name="firstname"  class="form-control" placeholder="Votre prénom" value="<?php echo $firstname;?>">
        <p class="comments"><?php echo $firstnameError;?></p>
      </div>
      <div class="col-md-6">
        <label for="name">Votre nom<span class="blue">*</span></label>
        <input type="text" id="name" name="name"  class="form-control" placeholder="Votre nom"  value="<?php echo $name;?>">
        <p class="comments"><?php echo $nameError;?></p>
      </div>
      <div class="col-md-6">
        <label for="email">Votre email<span class="blue">*</span></label>
        <input type="email" id="email" name="email"  class="form-control" placeholder="Votre email"  value="<?php echo $email;?>">
        <p class="comments"><?php echo $emailError;?></p>
      </div>
        <div class="col-md-6">
            <label for="phone">Votre téléphone<span class="blue">*</span></label>
            <input type="tel" id="phone" name="phone"  class="form-control" placeholder="Votre téléphone"  value="<?php echo $phone;?>">
            <p class="comments"><?php echo $phoneError;?></p>
        </div>
      <div class="col-md-12">
        <label for="message">Votre message<span class="blue">*</span></label>
        <textarea id="message" name="message" class="form-control" placeholder="Votre message" rows="4"  <?php echo $message;?>></textarea>
          <p class="comments"><?php echo $messageError;?></p>
      </div>
      <div class="col-md-12">

        <p class="blue">*Ces informations sont requises.</p>
      </div>
      <div class="col-md-12">
        <input type="submit" class="button1" value="Envoyez">
      </div>
    </div>
    <p class="thank you" style="display:<?php if($isSuccess) echo'block'; else echo'none'?>Votre message a bien été envoyé.</p>
  </form>




</div>
</body>
</html>