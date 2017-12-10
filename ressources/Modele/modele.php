<?php

class Modele {

    private $connexion;

// Constructeur de la classe

    public function __construct() {
        try {


            $chaine = "mysql:host=" . HOST . ";dbname=" . BD;
            $this->connexion = new PDO($chaine, LOGIN, PASSWORD);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $exception = new ConnexionException("problÃƒÂ¨me de connexion ÃƒÂ  la base");
            throw $exception;
        }
    }

// A dÃƒÂ©velopper
// mÃƒÂ©thode qui permet de se deconnecter de la base
    public function deconnexion() {
        $this->connexion = null;
    }

//A dÃƒÂ©velopper
// utiliser une requÃƒÂªte classique
// mÃƒÂ©thode qui permet de rÃƒÂ©cupÃƒÂ©rer les pseudos dans la table pseudo
// post-condition:
//retourne un tableau ÃƒÂ  une dimension qui contient les pseudos.
// si un problÃƒÂ¨me est rencontrÃƒÂ©, une exception de type TableAccesException est levÃƒÂ©e

    public function getPseudos() {
        try {

            $statement = $this->connexion->query("SELECT pseudo from pseudonyme;");

            while ($ligne = $statement->fetch()) {
                $result[] = $ligne['pseudo'];
            }
            return($result);
        } catch (PDOException $e) {
            throw new TableAccesException("problÃƒÂ¨me avec la table pseudonyme");
        }
    }

//A dÃƒÂ©velopper
// utiliser une requÃƒÂªte prÃƒÂ©parÃƒÂ©e
//vÃƒÂ©rifie qu'un pseudo existe dans la table pseudonyme
// post-condition retourne vrai si le pseudo existe sinon faux
// si un problÃƒÂ¨me est rencontrÃƒÂ©, une exception de type TableAccesException est levÃƒÂ©e
    public function exists($username, $password) {
        $statement = $this->connexion->prepare("select pseudo,motDePasse from joueurs where pseudo=? and motDePasse=?"); // mot de passe Ã  ajouter en requÃªte
        $statement->bindParam(1, $pseudoParam);
        $statement->bindParam(2, $motDePasseParam);
        $pseudoParam = $username;
        $motDePasseParam = crypt($password, $password);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result['pseudo'] != NUll && $result['motDePasse']) {
            return true;
        } else {
            return false;
        }
    }

    //Fonction qui affiche le classement des joueurs qui ont remportÃ©s le plus de partie.
    public function classementJoueurs() {
        $statement = $this->connexion->query("select pseudo, partieGagnee from parties order by partieGagnee desc LIMIT 0,3;");
        $tabResult = $statement->fetchAll();
        echo "<div>";
        echo "top 3: ";
        foreach ($tabResult as $row) {
            echo "----- " . $row['pseudo'] . " a gagné " . $row['partieGagnee'] . "parties" . "\n";
        }
        echo "</div>";
    }

    /*
      // Fonction qui renvoie le joueur ayant fait le plus de parties.
      public function joueurRegulier () {
      $statement = $this->connexion->query("select pseudo, from parties where nbPartie=(select MAX(nbPartie) from parties)");
      while ($ligne = $statement->fetch()) {
      echo $ligne['pseudo'];
      }
      } */

    public function getPartieGagnee($username) {
        $requete = $this->connexion->prepare("select partieGagnee from parties where pseudo=?");
        $requete->bindParam(1, $pseudoParam);
        $pseudoParam = $username;
        $requete->execute();
        $result = $requete->fetchAll();
        foreach ($result as $row) {
            echo $_SESSION['username'] . " a gagné " . $row['partieGagnee'] . " parties ";
        }
    }

    public function getNbPartie($username) {
        $requete = $this->connexion->prepare("select nbPartie from parties where pseudo=?");
        $requete->bindParam(1, $pseudoParam);
        $pseudoParam = $username;
        $requete->execute();
        $result = $requete->fetchAll();
        foreach ($result as $row) {
            echo "sur " . $row['nbPartie'] . " parties.\n";
        }
    }

    /*
      //Fonction qui renvoie le nombre total des parties jouÃ©s par tous les joueurs.
      public function totalPartie() {
      $statement = $this->connexion->query("select SUM(nbPartie) from parties;");
      while ($ligne = $statement->fetch()) {
      $result[] = $ligne['nbPartie'];
      }
      return($result);
      }

      //Fonction qui renvoie le nombre total des parties gagnÃ©es par tous les joueurs.

      public function totalGagnee() {
      $statement = $this->connexion->query("select SUM(partieGagnee) from parties;");
      while ($ligne = $statement->fetch()) {
      $result[] = $ligne['partieGagnee'];
      }
      return($result);
      } */

    //Cette fonction incrÃ©mente le nombre de partie jouÃ© par le pseudo, si celui ci en Ã  dÃ©jÃ  fait une.
    //Dans le cas contraire, il initialise une nouvelle partie.
    public function incrementePartie($username) {
        $statement = $this->connexion->prepare("select id from parties where pseudo=?");
        $statement->bindParam(1, $pseudoParam);
        $pseudoParam = $username;
        $statement->execute();
        $result = $statement->fetch();
        if ($result == NUll) {
            $statement = $this->connexion->prepare("SET @temp=(select MAX(id)from parties); Insert into parties values (@temp+1,?,0,1)");
            $statement->bindParam(1, $pseudoParam);
            $pseudoParam = $username;
            $statement->execute();
        } else {
            $statement = $this->connexion->prepare("update parties set nbPartie=(nbPartie+1) where pseudo=?");
            $statement->bindParam(1, $pseudoParam);
            $pseudoParam = $username;
            $statement->execute();
        }
    }

    //Fonction qui rajoute Ã  un pseudo la partie Ã  son nombre total de partie gagnÃ©.
    public function incrementePG($username) {
        $statement = $this->connexion->prepare("update parties set partieGagnee=(partieGagnee+1) where pseudo=?");
        $statement->bindParam(1, $pseudoParam);
        $pseudoParam = $username;
        $statement->execute();
    }

}

?>
