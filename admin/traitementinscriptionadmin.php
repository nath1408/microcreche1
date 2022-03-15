<?php require_once("../admin/config.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//

if($_POST) {

    // debug($_POST);
    $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['nomAdmin']);
    if (!$verif_caractere && (strlen($_POST['nomAdmin']) < 1 || strlen($_POST['nomAdmin']) > 20)) //
    {
        $contenu ='';
        $contenu = "<div class='erreur'>Le nom doit contenir entre 1 et 20 caractères. <br> Caractère accepté : Lettre de A à Z et chiffre de 0 à
9</div>";
    } else {
        $admin = queryMysql("SELECT * FROM admin WHERE nomAdmin='$_POST[nomAdmin]'");
        if ($admin->num_rows > 0) {
            echo "<div class='erreur'>Nom indisponible. Veuillez en choisir un autre svp.</div>";

        } else {
// $_POST['mdp'] = md5($_POST['mdp']);
            foreach ($_POST as $indice => $valeur) {
                $_POST[$indice] = htmlEntities(addSlashes($valeur));
            }
            queryMysql("INSERT INTO admin (nomAdmin, mdpAdmin) VALUES ('$_POST[nomAdmin]',
'$_POST[mdpAdmin]')");

            $contenu ='';
            $contenu = "<div class='validation'>Vous êtes inscrit à notre site web. <a href=\"../admin/connexionadmin.php\"><u>Cliquez ici pour vous connecter</u></a></div>";
        }

    }
}
echo $contenu;


