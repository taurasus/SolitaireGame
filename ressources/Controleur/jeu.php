<?php

require_once PATH_VUE . "/vue.php";
require_once PATH_MODELE . "/modele.php";

class Jeu {

    private $vue;
    private $model;

    function __construct() {
        $this->vue = new Vue();
        $this->modele = new Modele();
        $this->jeu = new Vue();
    }

    function clickBille($bille) {
        $coordonnees = explode(';', $bille);
        $x = intval($coordonnees[0]);
        $y = intval($coordonnees[1]);
        $status = intval($coordonnees[2]);
        if ($status == 0) {
            $border = 'circleblackborder';
        } else {
            $border = 'circleblack';
        }
        $this->vue->affichagePlateau($border, $x, $y);
        echo $bille;
    }

}
