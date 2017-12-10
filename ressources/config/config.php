<?php

// les chemins vers les diffÃ©rents rÃ©pertoires liÃ©s au modÃ¨le MVC

// chemin complet sur le serveur de la racine du site, il est supposÃ© que config.php est dans un sous-repertoire de la racine du site
define("HOME_SITE",__DIR__."/..");

// dÃ©finition des chemins vers les divers rÃ©pertoires liÃ©s au modÃ¨le MVC
define("PATH_VUE",HOME_SITE."/Vue");
define("PATH_CONTROLEUR",HOME_SITE."/Controleur");
define("PATH_MODELE",HOME_SITE."/Modele");
define("PATH_METIER",HOME_SITE."/Metier");


// donnÃ©es pour la connexion au sgbd

// remplacer les X par vos identifiants de connexion Ã  mysql

define("HOST","localhost");
define("BD","solitaireGame");
define("LOGIN","root");
define("PASSWORD","");
?>
