<?php

require_once PATH_VUE . "/vue.php";
require_once PATH_MODELE . "/modele.php";

// Classe generale de definition d'exception
class MonException extends Exception{
  private $chaine;
  public function __construct($chaine){
    $this->chaine=$chaine;
  }

  public function afficher(){
    return $this->chaine;
  }

}

// Exception relative à un probleme de connexion
class ErrorChoice extends MonException{
}

class Jeu {

    private $vue;
    private $modele;
    private $jeu;

    function __construct() {
        $this->vue = new Vue();
        $this->modele = new Modele();
        $this->jeu = new Vue();
    }

    function constructTab(){
      $_SESSION['plateau'] = array();
      $tab[0] = array('/','/','X','X','X','/','/');
      $tab[1] = array('/','/','X','X','X','/','/');
      $tab[2] = array('X','X','X','X','X','X','X');
      $tab[3] = array('X','X','X','O','X','X','X');
      $tab[4] = array('X','X','X','X','X','X','X');
      $tab[5] = array('/','/','X','X','X','/','/');
      $tab[6] = array('/','/','X','X','X','/','/');
      $_SESSION['plateau'] = $tab;

    }

    function clickBille($bille) {
      $coordonnees = explode(';', $bille);
      $x = intval($coordonnees[0]);
      $y = intval($coordonnees[1]);
      $error = false;

      if ($_SESSION['plateau'][$x][$y] == 'X') {
        $_SESSION['plateau'][$x][$y] = '+';
      } elseif ($_SESSION['plateau'][$x][$y] == 'O') {
        if ($_SESSION['plateau'][$x+1][$y] == 'X' && $_SESSION['plateau'][$x+2][$y] == '+'){
          $_SESSION['plateau'][$x][$y] = 'X';
          $_SESSION['plateau'][$x+1][$y] = 'O';
          $_SESSION['plateau'][$x+2][$y] = 'O';
        } elseif ($_SESSION['plateau'][$x-1][$y] == 'X' && $_SESSION['plateau'][$x-2][$y] == '+'){
          $_SESSION['plateau'][$x][$y] = 'X';
          $_SESSION['plateau'][$x-1][$y] = 'O';
          $_SESSION['plateau'][$x-2][$y] = 'O';
        } elseif ($_SESSION['plateau'][$x][$y+1] == 'X' && $_SESSION['plateau'][$x][$y+2] == '+'){
          $_SESSION['plateau'][$x][$y] = 'X';
          $_SESSION['plateau'][$x][$y+1] = 'O';
          $_SESSION['plateau'][$x][$y+2] = 'O';
        } elseif ($_SESSION['plateau'][$x][$y-1] == 'X' && $_SESSION['plateau'][$x][$y-2] == '+'){
          $_SESSION['plateau'][$x][$y] = 'X';
          $_SESSION['plateau'][$x][$y-1] = 'O';
          $_SESSION['plateau'][$x][$y-2] = 'O';
        } else {
          $error = true;
        }
      } else {
        $error = true;
      }
      if($error == true){
        $this->vue->affichageJeu();
        echo $bille;
      } else {
        echo 'Erreur de deplacement';
      }
    }
}
