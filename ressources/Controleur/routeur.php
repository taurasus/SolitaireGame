<?php

require_once 'controleurAuthentification.php';
require_once 'jeu.php';

class Routeur {

    private $ctrlAuthentification;
    private $jeu;
    private $vue;
    private $modele;

    public function __construct() {
        $this->ctrlAuthentification = new ControleurAuthentification();
        $this->jeu = new Jeu();
        $this->vue = new Vue();
        $this->modele = new Modele();
    }

    // Traite une requète entrante
    public function routerRequete() {
        if ((isset($_POST['username'])) && (isset($_POST['password']))) {
            $this->ctrlAuthentification->verification($_POST['username'], $_POST['password']);
            $this->jeu->constructTab();
            $this->modele->incrementePartie($_POST['username']);
            $_SESSION['username'] = $_POST['username'];
        } elseif (isset($_POST['bille'])) {
            $this->jeu->clickBille($_POST['bille']);
        } elseif (isset($_POST['reset'])) {
            $this->jeu->constructTab();
            $this->vue->affichagePlateau();
        } elseif (isset($_POST['deconnexion'])) {
            $this->ctrlAuthentification->accueil();
        } else {
            $this->ctrlAuthentification->accueil();
        }
    }

}
