<?php

class Authentification {

    function demandePseudo() {
        echo '<form class="login-form" method="POST" action="." >
                <input type="text" placeholder="Nom d\'utilisateur" name="username"/>
                <input type="password" placeholder="Mot de passe" name="password" />
                <button type="submit">Connexion</button>
              </form>';
    }

}

