<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

if ($sess == true) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>

        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title>Editieren</title>
        <link href="../css/general.css" rel="stylesheet" type="text/css">
        <link href="../css/navigation.css" rel="stylesheet" type="text/css">
        <link href="../css/main.css" rel="stylesheet" type="text/css">
        <link href="../css/forms_css/anmeldeFormular.css" rel="stylesheet" type="text/css">

    </head>
    <body>
    <div id="website">

        <?php include("navigation.php"); ?>

        <div id="main">

            <div id="top-buttons">
                <a href="profil_ansicht.php"><button class="button">Zurück</button></a>
            </div>

            <div id="main-content">
                <form action="?edit=1" method="POST">

                    Vorname:<br>
                    <input type="text" size="40" maxlength="250" name="vorname"><br><br>

                    Nachname:<br>
                    <input type="text" size="40" maxlength="250" name="nachname"><br><br>

                    Nickname:<br>
                    <input type="text" size="40" maxlength="250" name="nickname"><br><br>

                    Profil-Bild:<br>
                    <input type="file" accept="image/*" name="pic"/><br><br>

                    <input type="submit" value="Bearbeitung">

                </form>
            </div>
        </div>
    </div>
    <?php

    if (isset($_GET['edit'])) {
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $nickname = $_POST['nickname'];
        $pic = $_POST['pic'];

        $sql = "UPDATE users SET vorname = '$vorname', nachname = '$nachname', nickname= '$nickname', pic= '$pic' WHERE  id = '$sess' ";
        $update = $pdo->prepare($sql);
        $update->execute();
    }

    ?>

    </body>
    </html>

    <?php
    ;
} else if($sess != true){
    echo '<div id="website">';

        echo'<div id="main">';
            echo'<div id="main-content">';
                    echo"Bitte einloggen!". " ". '<a href="login.php">zum Login</a>';
                    echo'<br>';
                    echo"Noch kein Mitglied?". " ". '<a href="registrieren.php">Mitglied werden!</a>';
            echo'</div>';
        echo'</div>';
    echo'</div>';
}
?>