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

    <title>42licious - Account löschen</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/forms_css/anmeldeFormular.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="website">
    <?php include("Navigation.php"); ?>

    <div id="main">
        <div id="main-content">

            <?php
            if (isset($_GET['delete'])) {

                $statement1 = $pdo->query("DELETE FROM blog WHERE nutzer= '$sess'");
                $statement2 = $pdo->query("DELETE FROM blogcomments WHERE uid= '$sess'");
                $statement3 = $pdo->query("DELETE FROM rezepte WHERE uid= '$sess'");
                $statement4 = $pdo->query("DELETE FROM recipecomments WHERE uid= '$sess'");
                $statement5 = $pdo->query("DELETE FROM bewertung WHERE BNutzer= '$sess'");
                $statement6 = $pdo->query("DELETE FROM users WHERE id= '$sess'");
                session_destroy();
                echo '<div id="notification">';
                echo "Löschen erfolgreich!\n";
                echo "<a href='index.php'><button class='button'>Startseite</button></a>";
                echo '<div>';
            }else{
            ?>

            <div class=anmeldefo>

                <div class="form" id="form">
                        <p>Account unwiederruflich löschen?</p>

                    <div>
                        <a href="AccLoeschen.php?delete"><button class="button" type="button" name="delete">LÖSCHEN!</button></a>
                        <?php echo  '<a href="ProfilAnsicht.php?id='.$sess.'"><button class="button" id="zurück">Abbrechen</button></a>';  ?>
                    </div>
                </div>
            </div>


    <?php

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
<script>
    gsap.from("#main",{y:15});
</script>

</html>