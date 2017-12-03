<!-- 
<html>
    <p> oui oui oui </p>
    <TABLE BORDER>
        <tr>
            <td></td><td></td><td><img src="../../image/bille.png" width="40" name="bille" /></td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" /></td><td></td><td></td></tr>
<tr>
    <td></td><td></td><td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td><td></td><td></td></tr>
<tr>
    <td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td><td><img src="../../image/bille.png" width="40" name="bille" /></td><td><img src="../../image/bille.png" width="40" name="bille" /></td><td><img src="../../image/bille.png" width="40" name="bille" /></td><td><img src="../../image/bille.png" width="40" name="bille" /></td></tr>
<tr>
    <td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td><td><img src="../../image/bille.png" width="40" name="bille" /></td><td><img src="../../image/bille.png" width="40" name="bille" /></td><td><img src="../../image/bille.png" width="40" name="bille" /></td><td><img src="../../image/bille.png" width="40" name="bille" /></td></tr>
<tr>
    <td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td><td><img src="../../image/bille.png" width="40" name="bille" /></td><td><img src="../../image/bille.png" width="40" name="bille" /></td><td><img src="../../image/bille.png" width="40" name="bille" /></td><td><img src="../../image/bille.png" width="40" name="bille" /></td></tr>
<tr>
    <td></td><td></td><td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td><td></td><td></td></tr>
<tr>
    <td></td><td></td><td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td> <td><img src="../../image/bille.png" width="40" name="bille" /></td><td></td><td></td></tr>

</TABLE>
</html>
-->
<?php

function affichagePlateau() {
    $html = "<html> \n";
    $html .= " \t <table border> \n";
    for ($i = 0; $i < 7; $i++) { // lignes du plateau
        $html .= " \t \t <tr> \n";
        for ($j = 0; $j < 7; $j++) { // colonnes du plateau
            $html .= " \t \t \t <td>";
            if ($i > 1 && $i < 5) { // remplissage des lignes 2 à 4
                $html .= '<img src="../../image/bille.png" width="40" name="bille" />';
            } elseif ($i < 2 || $i > 4 && $i < 7) { // remplissage des lignes 0,1,5 et 6
                if ($j > 1 && $j < 5) { // seulement les cases 2 à 4 sont remplis sur ces lignes
                    $html .= '<img src="../../image/bille.png" width="40" name="bille" />';
                }
            }
            $html .= "</td> \n";
        }
        $html .= "\t \t </tr> \n";
    }
    $html .= "\t </table> \n";
    $html .= "</html>";
    echo $html; // affichage de tout l'html concaténé
}

echo affichagePlateau();
?>
