<?php
session_start();
    session_destroy();
    die(include 'logoutAnzeige.php');

?>

<a href="index.php">Startseite</a>
