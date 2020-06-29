<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

$sess = $_SESSION['userid'];

if ($sess == true){
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/forms_css/anmeldeFormular.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="website">
    <?php include("navigation.php"); ?>

    <div id="main">
        <div id="main-content">

            <div class=anmeldefo>

                <div class="form">
                    <form action="?delete=1" method="post">

                        <div class="text">
                            Account unwiederruflich löschen?
                        </div>

                        <button class="button" type="submit" name="delete">LÖSCHEN!</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_GET['delete'])) {
        $statement = $pdo->query("DELETE FROM users WHERE id= '$sess'");
        session_destroy();
        echo "Löschen erfolgreich!";
        echo '<a href=' . 'index.php' . '>Startseite</a>';
    }
    }
    else {
        echo "Bitte einloggen!" . " " . '<a href="login.php">zum Login</a>';
        echo '<br>';
        echo "Noch kein Mitglied?" . " " . '<a href="registrieren.php">Mitglied werden!</a>';
    }

    ?>

</div>
</body>
</html>