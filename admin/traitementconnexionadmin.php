<?php require_once("../admin/config.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//

if($_POST)
{
    // $contenu .=  "pseudo : " . $_POST['pseudo'] . "<br>mdp : " .  $_POST['mdp'] . "";
    $resultat = queryMysql("SELECT * FROM admin WHERE nomAdmin='$_POST[nomAdmin]'");
    if($resultat->num_rows != 0)
    {
        // $contenu .=  '<div style="background:green">pseudo connu!</div>';
        $admin = $resultat->fetch_assoc();
        if($admin['mdpAdmin'] == $_POST['mdpAdmin'])
        {
            //$contenu .= '<div class="validation">mdp connu!</div>';
            foreach($admin as $indice => $element)
            {
                if($indice != 'mdpAdmin')
                {
                    $_SESSION['admin'][$indice] = $element;
                }
            }
            header("location:../admin/gestion_boutique.php");
        }
        else
        {
            $contenu .= '<div class="erreur">Erreur de MDP</div>';
        }
    }
    else
    {
        $contenu .= '<div class="erreur">Erreur de nom</div>';
    }
}

