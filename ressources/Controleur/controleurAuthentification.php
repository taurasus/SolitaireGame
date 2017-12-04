<?php

require_once PATH_VUE . "/vue.php";
require_once PATH_MODELE . "/modele.php";

class ControleurAuthentification {

    private $vue;
    private $modele;

    function __construct() {
        $this->vue = new Vue();
        $this->modele = new Modele();
        $this->ctrlAuthentification = new Vue();
    }

    function accueil() {
        $this->vue->demandePseudo();
    }

    function verification($username, $password) {
        if ($this->modele->exists($username, $password)) {
            $this->vue->affichagePlateau();
        } else {
            $this->ctrlAuthentification->demandePseudo();
        }
    }

}

?>
