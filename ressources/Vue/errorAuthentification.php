<?php

class ErrorAuthentification {

    function mauvaiseAuthentification() {
        echo '<h1> Mauvaise Pseudo ou Mauvais Password </h1>';
        echo '<form action = "." method="post">';
        echo '<input class="ErrorAuthentification" type = "submit" value = "RETURN" name="mauvaiseAuthentification"></form>';
    }

}
