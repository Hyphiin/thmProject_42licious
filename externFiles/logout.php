<?php
session_start();
session_unset();
session_destroy();

echo "Logout erfolgreich";
?>

<a href="index.php">Startseite</a>
