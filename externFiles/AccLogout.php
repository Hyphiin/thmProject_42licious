<?php
session_start();
    session_destroy();
    die(include 'AccLogoutAnzeige.php');

?>

<a href="index.php">Startseite</a>
