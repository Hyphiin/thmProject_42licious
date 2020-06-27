<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title>42licious-Profil-Ansicht</title>
        <link href="../css/general.css" rel="stylesheet" type="text/css">
        <link href="../css/navigation.css" rel="stylesheet" type="text/css">
        <link href="../css/main.css" rel="stylesheet" type="text/css">
        <link href="../css/profil_css/profil_ansicht.css" rel="stylesheet" type="text/css">

    </head>
    <body>
    <div id="website">

        <?php include("navigation.php"); ?>



            <?php

            $statement = $pdo->query("SELECT * FROM users");


        echo '<div id="user">';
        while ($user = $statement->fetch())

        {

            $vorname = $user['vorname'];
            $nachname = $user['nachname'];
            $pic = $user['pic'];

            echo '<img alt="Profil-Bild" id="profil_bild" src='."$pic".'>';
            echo $vorname.'<br>';
            echo $nachname.'<br>';
            echo '<br>';
        }
        echo "</div>";

?>


    </body>
    </html>
