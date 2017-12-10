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
        $tan = array();
        $tab[0] = array('/', '/', '/', '/', '/', '/', '/', '/', '/');
        $tab[1] = array('/', '/', '/', 'X', 'X', 'X', '/', '/', '/');
        $tab[2] = array('/', '/', '/', 'X', 'X', 'X', '/', '/', '/');
        $tab[3] = array('/', 'X', 'X', 'X', 'X', 'X', 'X', 'X', '/');
        $tab[4] = array('/', 'X', 'X', 'X', 'O', 'X', 'X', 'X', '/');
        $tab[5] = array('/', 'X', 'X', 'X', 'X', 'X', 'X', 'X', '/');
        $tab[6] = array('/', '/', '/', 'X', 'X', 'X', '/', '/', '/');
        $tab[7] = array('/', '/', '/', 'X', 'X', 'X', '/', '/', '/');
        $tab[8] = array('/', '/', '/', '/', '/', '/', '/', '/', '/');
        $_SESSION['plateau'] = $tab;
    }

    function clickBille($bille) {
        $coordonnees = explode(';', $bille);
        $x = intval($coordonnees[0]);
        $y = intval($coordonnees[1]);
        $error = false;
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
            $status = $this->status();
            if ($status == 'win') {
                $this->vue->affichageVictoire();
                $this->modele->incrementePG($_SESSION['username']);
               // $this->modele->joueurRegulier();
                $this->modele->classementJoueurs();
                $this->modele->getPartieGagnee($_SESSION['username']);
                $this->modele->getNbPartie($_SESSION['username']);
                // $this->modele->totalPartie();
                // $this->modele->totalGagnee();
            } elseif ($status == 'loose') {
                $this->vue->affichageDefaite();
              //  $this->modele->joueurRegulier();
                $this->modele->classementJoueurs();
                $this->modele->getPartieGagnee($_SESSION['username']);
                $this->modele->getNbPartie($_SESSION['username']);
                //  $this->modele->totalPartie();
                //  $this->modele->totalGagnee();
            } else {
                $this->vue->affichageJeu();
                $this->instruction();
            }
        } else {
            $this->vue->affichageJeu();
            $this->instruction();
        }
    }

    function instruction() {

        if ($_SESSION['selection'] == false) {
            $html = '<div class="instruction"> Selectionner une bille noire à déplacer </div>';
        } elseif ($_SESSION['selection'] == true) {
            $html = '<div class="instruction"> Choisir un emplacement libre </div>';
        } else {
            $html = '<div class="instruction"> Erreur de déplacement </div>';
        }

        echo $html;
    }

    function status() {
        $nbBlack = 0;
        $possibilite = 0;
        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 9; $j++) {
                if ($_SESSION['plateau'][$i][$j] == 'X' || $_SESSION['plateau'][$i][$j] == '+') {
                    $nbBlack++;

                    if ($_SESSION['plateau'][$i + 1][$j] == 'X') {
                        if ($_SESSION['plateau'][$i + 2][$j] == 'O') {
                            $possibilite++;
                        }
                    } elseif ($_SESSION['plateau'][$i - 1][$j] == 'X') {
                        if ($_SESSION['plateau'][$i - 2][$j] == 'O') {
                            $possibilite++;
                        }
                    } elseif ($_SESSION['plateau'][$i][$j + 1] == 'X') {
                        if ($_SESSION['plateau'][$i][$j + 2] == 'O') {
                            $possibilite++;
                        }
                    } elseif ($_SESSION['plateau'][$i][$j - 1] == 'X') {
                        if ($_SESSION['plateau'][$i][$j - 2] == 'O') {
                            $possibilite++;
                        }
                    }
                }
            }
        }

        if ($possibilite == 0 && $nbBlack != 1) {
            return $victoire = 'loose';
        } elseif ($nbBlack == 1) {
            return $victoire = 'win';
        }
    }

}
