<?php

class Vue {

    function demandePseudo() {
        echo '<form class="login-form" method="POST" action="." >
                <input type="text" placeholder="Nom d\'utilisateur" name="username"/>
                <input type="password" placeholder="Mot de passe" name="password" />
                <button type="submit">Connexion</button>
              </form>';
        echo '<div class="circle"></div>';
    }

    function affichagePlateau() {
        $html = "<html> \n";
        $html .= '<head><link rel="stylesheet" type="text/css" href="css.css"></head>';
        $html .= '<body bgcolor="#F5F5F5">';
        $html .= "\n \t <table> \n";
        for ($i = 0; $i < 7; $i++) { // lignes du plateau
            $html .= "\t \t <tr> \n";
            for ($j = 0; $j < 7; $j++) { // colonnes du plateau
                $status = 1;
                $html .= "\t \t \t <td>";
                if ($i == 3 && $j == 3) {
                    $status = 0;
                }
                $html .= '<form action="." method="post"><button class="classe" type="submit" name="bille" value="' . $i . ';' . $j . ';' . $status . '"></form>';
                if ($i > 1 && $i < 5) { // remplissage des lignes 2 à 4
                    if ($i == 3 && $j == 3) {
                        $html .= '<div class="circleblackborder"></div>';
                    } else {
                        $html .= '<div class="circleblack"></div>';
                    }
                } elseif ($i < 2 || $i > 4 && $i < 7) { // remplissage des lignes 0,1,5 et 6
                    if ($j > 1 && $j < 5) { // seulement les cases 2 à 4 sont remplis sur ces lignes
                        $html .= '<div class="circleblack"></div>';
                    }
                }
                $html .= "</button></td> \n";
            }
            $html .= "\t \t </tr> \n";
        }
        $html .= "\t </table> \n";
        $html .= '</body>';
        $html .= "</html>";
        echo $html; // affichage de tout l'html concaténé
    }

}

?>
