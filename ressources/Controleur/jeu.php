<?php

require_once PATH_VUE . "/vue.php";
require_once PATH_MODELE . "/modele.php";

class Jeu {

    private $vue;
    private $modele;
    private $jeu;

    function __construct() {
        $this->vue = new Vue();
        $this->modele = new Modele();
        $this->jeu = new Vue();
    }

    function constructTab() {
        $_SESSION['plateau'] = array();
        $tab[0] = array('/', '/', 'X', 'X', 'X', '/', '/');
        $tab[1] = array('/', '/', 'X', 'X', 'X', '/', '/');
        $tab[2] = array('X', 'X', 'X', 'X', 'X', 'X', 'X');
        $tab[3] = array('X', 'X', 'X', 'O', 'X', 'X', 'X');
        $tab[4] = array('X', 'X', 'X', 'X', 'X', 'X', 'X');
        $tab[5] = array('/', '/', 'X', 'X', 'X', '/', '/');
        $tab[6] = array('/', '/', 'X', 'X', 'X', '/', '/');
        $_SESSION['plateau'] = $tab;
    }

    function clickBille($bille) {
        $coordonnees = explode(';', $bille);
        $x = intval($coordonnees[0]);
        $y = intval($coordonnees[1]);
        $error = false;
        //    $_SESSION['plateauPrecedent'] = $_SESSION['plateau'];
        if ($_SESSION['plateau'][$x][$y] == 'X' && $_SESSION['selection'] == false) {
            $_SESSION['plateau'][$x][$y] = '+';
            $_SESSION['selection'] = true;
        } elseif ($_SESSION['plateau'][$x][$y] == 'O' && $_SESSION['selection'] == true) {
            if ($_SESSION['plateau'][$x + 1][$y] == 'X' && $_SESSION['plateau'][$x + 2][$y] == '+') {
                $_SESSION['plateau'][$x][$y] = 'X';
                $_SESSION['plateau'][$x + 1][$y] = 'O';
                $_SESSION['plateau'][$x + 2][$y] = 'O';
                $_SESSION['selection'] = false;
            } elseif ($_SESSION['plateau'][$x - 1][$y] == 'X' && $_SESSION['plateau'][$x - 2][$y] == '+') {
                $_SESSION['plateau'][$x][$y] = 'X';
                $_SESSION['plateau'][$x - 1][$y] = 'O';
                $_SESSION['plateau'][$x - 2][$y] = 'O';
                $_SESSION['selection'] = false;
            } elseif ($_SESSION['plateau'][$x][$y + 1] == 'X' && $_SESSION['plateau'][$x][$y + 2] == '+') {
                $_SESSION['plateau'][$x][$y] = 'X';
                $_SESSION['plateau'][$x][$y + 1] = 'O';
                $_SESSION['plateau'][$x][$y + 2] = 'O';
                $_SESSION['selection'] = false;
            } elseif ($_SESSION['plateau'][$x][$y - 1] == 'X' && $_SESSION['plateau'][$x][$y - 2] == '+') {
                $_SESSION['plateau'][$x][$y] = 'X';
                $_SESSION['plateau'][$x][$y - 1] = 'O';
                $_SESSION['plateau'][$x][$y - 2] = 'O';
                $_SESSION['selection'] = false;
            } else {
                $error = true;
            }
        } elseif ($_SESSION['plateau'][$x][$y] == '+' && $_SESSION['selection'] == true) {
            $_SESSION['plateau'][$x][$y] = 'X';
            $_SESSION['selection'] = false;
        } else {
            $error = true;
        }

        if ($error == false) {
            //  $_SESSION['ax'] = $x;
            //  $_SESSION['ay'] = $y;
            $this->vue->affichageJeu();
            $victoire = $this->victoire();
            $this->instruction($victoire);
        } else {
            //  $_SESSION['plateauPrecedent'][$_SESSION['ax']][$_SESSION['ay']] == 'X';
            $this->vue->affichageJeu();
            $victoire = $this->victoire();
            $this->instruction($victoire);
            echo '<br> <br> Erreur de déplacement';
            //    $_SESSION['plateau'] = $_SESSION['plateauPrecedent'];
        }
    }

    function instruction($victoire) {
        if ($victoire == 'true') {
            echo 'Victoire !';
        } else {
            if ($_SESSION['selection'] == false) {
                echo 'Selectionner une bille noire à déplacer';
            } elseif ($_SESSION['selection'] == true) {
                echo 'Choisir un emplacement libre';
            } else {
                echo 'Error';
            }
        }
    }

    function victoire() {
        $nbBlack = 0;
        for ($i = 0; $i < 7; $i++) {
            for ($j = 0; $j < 7; $j++) {
                if ($_SESSION['plateau'][$i][$j] == 'X') {
                    $nbBlack++;
                }
            }
        }

        if ($nbBlack == 1) {
            return $victoire = 'true';
        } else {
            return $victoire = 'false';
        }
    }

}
