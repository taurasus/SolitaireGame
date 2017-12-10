<?php

class Vue {

    function affichagePlateau() {
        $_SESSION['selection'] = false;
        $html = "<html> \n";
        $html .= '<head><link rel="stylesheet" type="text/css" href="css.css">';
        $html .= '<meta charset="utf-8" />';
        $html .= '<h1>JEU DU SOLITAIRE</h1></head>';
        $html .= '<body bgcolor="#FFFFFF">';
        $html .= "<section> \n \t <table> \n";
        for ($i = 1; $i < 8; $i++) { // lignes du plateau
            $html .= "\t \t <tr> \n";
            for ($j = 1; $j < 8; $j++) { // colonnes du plateau
                $status = 1;
                $html .= "\t \t \t <td>";
                if (($i < 3 && $j < 3) || ($i < 3 && $j > 5) || ($i > 5 && $j < 3) || ($i > 5 && $j > 5) || ($i < 1) || ($i > 7) || ($j < 1) || ($j > 7)) {
                    
                } else {
                    $html .= '<form action="." method="post"><button class="classe" type="submit" name="bille" value="' . $i . ';' . $j . '"></form>';
                    if ($i == 4 && $j == 4) {
                        $html .= '<div class="circleblackborder"></div>';
                    } else {
                        $html .= '<div class="circleblack"></div>';
                    }
                }
                $html .= "</button></td> \n";
            }
            $html .= "\t \t </tr> \n";
        }
        $html .= "\t </table> \n";
        $html .= '<form action = "." method="post">';
        $html .= '<input class="reset" type = "submit" value = "RESET" name="reset"></form ></section>';
        $html .= '<form action = "." method="post">';
        $html .= '<input class="deconnexion" type = "submit" value = "DECONNEXION" name="deconnexion"></form >';
        $html .= '</br> </br> </br> </br> </br> </br>';
        $html .= '<div class="instruction"> Selectionner une bille noire à déplacer </div>';
        $html .= '</body>';
        $html .= "</html>";
        echo $html; // affichage de tout l'html concaténé
    }

    function affichageJeu() {
        $html = "<html> \n";
        $html .= '<head><link rel="stylesheet" type="text/css" href="css.css">';
        $html .= '<meta charset="utf-8" />';
        $html .= '<h1>JEU DU SOLITAIRE</h1></head>';
        $html .= '<body bgcolor="#FFFFFF">';
        $html .= "<section> \n \t <table> \n";
        for ($i = 1; $i < 8; $i++) { // lignes du plateau
            $html .= "\t \t <tr> \n";
            for ($j = 1; $j < 8; $j++) { // colonnes du plateau
                $html .= "\t \t \t <td>";
                $html .= '<form action="." method="post"><button class="classe" type="submit" name="bille" value="' . $i . ';' . $j . '"></form>';
                if ($_SESSION['plateau'][$i][$j] == 'O') {
                    $html .= '<div class="circleblackborder"></div>';
                } elseif ($_SESSION['plateau'][$i][$j] == 'X') {
                    $html .= '<div class="circleblack"></div>';
                } elseif ($_SESSION['plateau'][$i][$j] == '+') {
                    $html .= '<div class="circleblackborderred"></div>';
                }
                $html .= "</button></td> \n";
            }
            $html .= "\t \t </tr> \n";
        }
        $html .= "\t </table> \n";
        $html .= '<form action = "." method="post">';
        $html .= '<input class="reset" type = "submit" value = "RESET" name="reset"></form ></section>';
        $html .= '<form action = "." method="post">';
        $html .= '<input class="deconnexion" type = "submit" value = "DECONNEXION" name="deconnexion"></form >';
        $html .= '</body>';
        $html .= "</html>";
        echo $html; // affichage de tout l'html concaténé
    }

    function affichageVictoire() {
        $html = "<html> \n";
        $html .= '<head><link rel="stylesheet" type="text/css" href="css.css">';
        $html .= '<meta charset="utf-8" />';
        $html .= '</br> </br> </br> </br> </br> </br> </br> </br> </br> </br>';
        $html .= '<h2>Victoire !</h2></head>';
        $html .= '<body bgcolor="#FFFFFF">';
        $html .= '<form action = "." method="post">';
        $html .= '<input class="buttonfinish" type = "submit" value = "RESTART" name="reset"></form >';
        $html .= '<form action = "." method="post">';
        $html .= '<input class="buttonfinish" type = "submit" value = "DECONNEXION" name="deconnexion"></form >';
        $html .= '</body>';
        $html .= "</html>";
        echo $html; // affichage de tout l'html concaténé
    }

    function affichageDefaite() {
        $html = "<html> \n";
        $html .= '<head><link rel="stylesheet" type="text/css" href="css.css">';
        $html .= '<meta charset="utf-8" />';
        $html .= '</br> </br> </br> </br> </br> </br> </br> </br> </br> </br>';
        $html .= '<h2>Défaite !</h2></head>';
        $html .= '<body bgcolor="#FFFFFF">';
        $html .= '<form action = "." method="post">';
        $html .= '<input class="buttonfinish" type = "submit" value = "RESTART" name="reset"></form >';
        $html .= '<form action = "." method="post">';
        $html .= '<input class="buttonfinish" type = "submit" value = "DECONNEXION" name="deconnexion"></form >';
        $html .= '</body>';
        $html .= "</html>";
        echo $html; // affichage de tout l'html concaténé
    }

}
