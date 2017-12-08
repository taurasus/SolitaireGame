<?php

require_once 'controleurAuthentification.php';
require_once 'jeu.php';

class Routeur {

    private $ctrlAuthentification;
    private $jeu;
    private $vue;

    public function __construct() {
        $this->ctrlAuthentification = new ControleurAuthentification();
        $this->jeu = new Jeu();
    }

    // Traite une requète entrante
    public function routerRequete() {
        if ((isset($_POST['username'])) && (isset($_POST['password']))) {
            $this->ctrlAuthentification->verification($_POST['username'], $_POST['password']);
            $this->jeu->constructTab();
        } elseif (isset($_POST['bille'])) {
            $this->jeu->clickBille($_POST['bille']);
        } else {
            $this->ctrlAuthentification->accueil();
        }
    }

}

?>
