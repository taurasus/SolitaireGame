<?php
if ((isset($_POST['username']) AND $_POST['username'] == "tanguy") && (isset($_POST['password']) AND $_POST['password'] == "oui"))  {
  header("location: Plateau.php");
} else {
  echo ("Essaie encore");
}
?>
