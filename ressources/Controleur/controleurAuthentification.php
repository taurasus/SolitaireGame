<?php

require_once PATH_VUE . "/vue.php";
require_once PATH_MODELE . "/modele.php";
require_once 'Vue/authentification.php';
require_once 'Vue/errorAuthentification.php';

class ControleurAuthentification {

    private $vue;
    private $modele;
    private $authentification;

    function __construct() {
        $this->vue = new Vue();
        $this->ctrlAuthentification = new Vue();
        $this->modele = new Modele();
        $this->authentification = new Authentification();        
        $this->errorAuthentification = new ErrorAuthentification();
    }

    function accueil() {
        $this->authentification->demandePseudo();
    }

    function verification($username, $password) {
        if ($this->modele->exists($username, $password)) {
            
            $this->vue->affichagePlateau();
        } else {
                $this->errorAuthentification->mauvaiseAuthentification();
        }
    }

}

