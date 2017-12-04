<?php

require_once 'controleurAuthentification.php';

class Routeur {

    private $ctrlAuthentification;
    private $vue;

    public function __construct() {
        $this->ctrlAuthentification = new ControleurAuthentification();
    }

    // Traite une requète entrante
    public function routerRequete() {
        if ((isset($_POST['username'])) && (isset($_POST['password']))) {
            $this->ctrlAuthentification->verification($_POST['username'], $_POST['password']);
        } else {
            $this->ctrlAuthentification->accueil();
        }
    }

}

?>
