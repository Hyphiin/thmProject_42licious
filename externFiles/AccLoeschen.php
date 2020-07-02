<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

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
    <link href="../css/forms_css/anmeldeFormular.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="website">
    <?php include("Navigation.php"); ?>

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

                    <div id="bottom-buttons">
                        <a href="index.php"><button class="button" id="zurück">Zurück</button></a>
                    </div>
                </div>
            </div>


    <?php

    if (isset($_GET['delete'])) {

        $statement1 = $pdo->query("DELETE FROM blog WHERE nutzer= '$sess'");
        $statement2 = $pdo->query("DELETE FROM blogcomments WHERE uid= '$sess'");
        $statement3 = $pdo->query("DELETE FROM rezepte WHERE uid= '$sess'");
        $statement4 = $pdo->query("DELETE FROM recipecomments WHERE uid= '$sess'");
        $statement5 = $pdo->query("DELETE FROM bewertung WHERE BNutzer= '$sess'");
        $statement6 = $pdo->query("DELETE FROM users WHERE id= '$sess'");
        session_destroy();
        echo "Löschen erfolgreich!\n";
        echo "<a href='index.php'><button class='button'>Startseite</button></a>";
    }
    }
    else {
        include("AccNoSess.php");
    }

    ?>
        </div>
    </div>
</div>
</body>
</html>