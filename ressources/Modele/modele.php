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
            $exception = new ConnexionException("problÃ¨me de connexion Ã  la base");
            throw $exception;
        }
    }

// A dÃ©velopper
// mÃ©thode qui permet de se deconnecter de la base
    public function deconnexion() {
        $this->connexion = null;
    }

//A dÃ©velopper
// utiliser une requÃªte classique
// mÃ©thode qui permet de rÃ©cupÃ©rer les pseudos dans la table pseudo
// post-condition:
//retourne un tableau Ã  une dimension qui contient les pseudos.
// si un problÃ¨me est rencontrÃ©, une exception de type TableAccesException est levÃ©e

    public function getPseudos() {
        try {

            $statement = $this->connexion->query("SELECT pseudo from pseudonyme;");

            while ($ligne = $statement->fetch()) {
                $result[] = $ligne['pseudo'];
            }
            return($result);
        } catch (PDOException $e) {
            throw new TableAccesException("problÃ¨me avec la table pseudonyme");
        }
    }

//A dÃ©velopper
// utiliser une requÃªte prÃ©parÃ©e
//vÃ©rifie qu'un pseudo existe dans la table pseudonyme
// post-condition retourne vrai si le pseudo existe sinon faux
// si un problÃ¨me est rencontrÃ©, une exception de type TableAccesException est levÃ©e
    public function exists($username, $password) {

        $statement = $this->connexion->prepare("select pseudo from joueurs where pseudo=?"); // mot de passe à ajouter en requête
        $statement->bindParam(1, $pseudoParam);
        //$statement->bindParam(2, $motDePasseParam);
        $pseudoParam = $username;
        //$motDePasseParam = crypt($password);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result['pseudo'] != NUll) {
            return true;
        } else {
            return false;
        }
    }

}

?>
