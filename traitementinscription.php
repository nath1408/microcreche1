<?php require_once("Inc/config.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//

if($_POST) {

    // debug($_POST);
    $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']);
    if (!$verif_caractere && (strlen($_POST['pseudo']) < 1 || strlen($_POST['pseudo']) > 20)) //
    {
        $contenu ='';
        $contenu = "<div class='erreur'>Le pseudo doit contenir entre 1 et 20 caractères. <br> Caractère accepté : Lettre de A à Z et chiffre de 0 à
9</div>";
    } else {
        $membre = queryMysql("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
        if ($membre->num_rows > 0) {
            echo "<div class='erreur'>Pseudo indisponible. Veuillez en choisir un autre svp.</div>";
            echo "<div class='validation'>Redirigez vous vers la page d'inscription en <a href=\"inscription.php\"><u>Cliquant ici 
</u></a></div>";

        } else {
// $_POST['mdp'] = md5($_POST['mdp']);
            foreach ($_POST as $indice => $valeur) {
                $_POST[$indice] = htmlEntities(addSlashes($valeur));
            }
            queryMysql("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse) VALUES ('$_POST[pseudo]',
'$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[civilite]', '$_POST[ville]', '$_POST[code_postal]', '$_POST[adresse]')");

            $contenu ='';
            $contenu = "<div class='validation'>Vous êtes inscrit à notre site web. <a href=\"connexion.php\"><u>Cliquez ici pour vous connecter</u></a></div>";
        }

    }
}
echo $contenu;

