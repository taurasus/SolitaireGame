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
        $html .= '<body bgcolor="#FFFFFF">';
        $html .= "\n \t <table> \n";
       for ($i = 0; $i < 7; $i++) { // lignes du plateau
            $html .= "\t \t <tr> \n";
            for ($j = 0; $j < 7; $j++) { // colonnes du plateau
                $status = 1;
                $html .= "\t \t \t <td>";
                if (($i < 2 && $j < 2) || ($i < 2 && $j > 4) || ($i > 4 && $j < 2) || ($i > 4 && $j > 4)){
                } else {
                    $html .= '<form action="." method="post"><button class="classe" type="submit" name="bille" value="' . $i . ';' . $j . ';' . $status . '"></form>';
                    $html .= '<div class="circleblack"></div>';
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
    
    function affichageJeu($x, $y, $changeStatus) {
        
        $html = "<html> \n";
        $html .= '<head><link rel="stylesheet" type="text/css" href="css.css"></head>';
        $html .= '<body bgcolor="#FFFFFF">';
        $html .= "\n \t <table> \n";        
        for ($i = 0; $i < 7; $i++) { // lignes du plateau
            $html .= "\t \t <tr> \n";
            for ($j = 0; $j < 7; $j++) { // colonnes du plateau
                $status = 1;
                $html .= "\t \t \t <td>";
                if (($i < 2 && $j < 2) || ($i < 2 && $j > 4) || ($i > 4 && $j < 2) || ($i > 4 && $j > 4)){
                } else {
                    $html .= '<form action="." method="post"><button class="classe" type="submit" name="bille" value="' . $i . ';' . $j . ';' . $status . '"></form>';
                    if ($i === $x && $j === $y && $changeStatus === 1) {
                            $html .= '<div class="circleblackborder"></div>';
                            $status = 0;
                        } else if ($i === $x && $j === $y && $changeStatus === 0) {
                             $html .= '<div class="circleblack"></div>';
                        } else {
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
