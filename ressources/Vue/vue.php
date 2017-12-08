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
      $_SESSION['selection'] = false;
      $html = "<html> \n";
      $html .= '<head><link rel="stylesheet" type="text/css" href="css.css">';
      $html .= '<meta charset="utf-8" />';
      $html .= '<h1>JEU DU SOLITAIRE</h1></head>';
      $html .= '<body bgcolor="#FFFFFF">';
      $html .= "\n \t <table> \n";
      for ($i = 0; $i < 7; $i++) { // lignes du plateau
            $html .= "\t \t <tr> \n";
            for ($j = 0; $j < 7; $j++) { // colonnes du plateau
                $status = 1;
                $html .= "\t \t \t <td>";
                if (($i < 2 && $j < 2) || ($i < 2 && $j > 4) || ($i > 4 && $j < 2) || ($i > 4 && $j > 4)){
                } else {
                    $html .= '<form action="." method="post"><button class="classe" type="submit" name="bille" value="' . $i . ';' . $j . '"></form>';
                    if ($i == 3 && $j == 3){
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
        $html .= '<p> Selectionner une bille noire à déplacer </p>';
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
        $html .= "\n \t <table> \n";
        for ($i = 0; $i < 7; $i++) { // lignes du plateau
            $html .= "\t \t <tr> \n";
            for ($j = 0; $j < 7; $j++) { // colonnes du plateau
                $html .= "\t \t \t <td>";
                $html .= '<form action="." method="post"><button class="classe" type="submit" name="bille" value="' . $i . ';' . $j . '"></form>';
                if ($_SESSION['plateau'][$i][$j] == 'O'){
                  $html .= '<div class="circleblackborder"></div>';
                } elseif ($_SESSION['plateau'][$i][$j] == 'X'){
                  $html .= '<div class="circleblack"></div>';
                } elseif ($_SESSION['plateau'][$i][$j] == '+'){
                  $html .= '<div class="circleblackborderred"></div>';
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

    function affichageJeuPrecedent() {

        $html = "<html> \n";
        $html .= '<head><link rel="stylesheet" type="text/css" href="css.css">';
        $html .= '<meta charset="utf-8" />';
        $html .= '<h1>JEU DU SOLITAIRE</h1></head>';
        $html .= '<body bgcolor="#FFFFFF">';
        $html .= "\n \t <table> \n";
        for ($i = 0; $i < 7; $i++) { // lignes du plateau
            $html .= "\t \t <tr> \n";
            for ($j = 0; $j < 7; $j++) { // colonnes du plateau
                $html .= "\t \t \t <td>";
                $html .= '<form action="." method="post"><button class="classe" type="submit" name="bille" value="' . $i . ';' . $j . '"></form>';
                if ($_SESSION['plateauPrecedent'][$i][$j] == 'O'){
                  $html .= '<div class="circleblackborder"></div>';
                } elseif ($_SESSION['plateau'][$i][$j] == 'X'){
                  $html .= '<div class="circleblack"></div>';
                } elseif ($_SESSION['plateau'][$i][$j] == '+'){
                  $html .= '<div class="circleblackborderred"></div>';
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
/*

if ($i === $x && $j === $y && $changeStatus === 1) {
        $html .= '<div class="circleblackborder"></div>';
        $status = 0;
    } else if ($i === $x && $j === $y && $changeStatus === 0) {
         $html .= '<div class="circleblack"></div>';
    } else {
        $html .= '<div class="circleblack"></div>';
    }*/
?>
