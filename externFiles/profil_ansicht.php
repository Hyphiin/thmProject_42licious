<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

if ($sess == true) {
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

    <div id="main">
        <div id="top-buttons">

            <a href="index.php"><button class="button">Zurück</button></a>
            <a href="p_editieren.php"><button class="button">Bearbeiten</button></a>

        </div>

            <?php

            $statement = $pdo->query("SELECT * FROM users WHERE id = '$sess' ");
            $user = $statement->fetch();

            $vorname= $user['vorname'];
            $nachname= $user['nachname'];
            $nickname= $user['nickname'];
            $date= $user['created_at'];


            echo '<div id="main-content">';
            echo '<div id="profil-title">';
               echo' <h1>Profil von' .' '.$vorname.' '.'</h1>';
            echo '</div>';

            echo '<div id="profil_inhalt">';
                echo '<div id="profil_links">';
                    echo '<div id="BildUndButtons">';
                        echo '<img alt="Profil-Bild" id="profil_bild" src="shindy.jpg">';
                        echo '<div id="linksbuttons">';
                            echo '<a href="profil_rezept.php"><button id="user_rezept">Rezepte</button></a>';
                            echo '<a href="blogUSER.php"><button id="user_blog">Blog</button></a>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div id="details">';
                        echo '<p id="name">Name:</p>'.' '. $vorname. ' '. $nachname;
                        echo '<p id="nickname">Nickname:</p>' .' '. $nickname;
                    echo '</div>';

                    echo '<p>Mitglied seit:</p>'.' '. $date;
                echo '</div>';
                ?>
                <div id="profil_rechts">
                    <div id="top_rezept">
                        <label>Top Rezept</label>
                        <p id="toprezept">Hier soll das Top-Rezept stehen!</p>
                    </div>
                    <div id="last_blog">
                        <label>Letzter Blog</label>
                        <p id="lastblog">Hier soll der letzte Blog stehen!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php
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