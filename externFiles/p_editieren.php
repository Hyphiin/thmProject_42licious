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
        <link href="../css/profil_css/profil_edit.css" rel="stylesheet" type="text/css">


    </head>
    <body>
    <div id="website">

        <?php include("navigation.php"); ?>

        <div id="main">
            <div class="profil-edit-main">
            <div class="edit-profile">
                <h1>Profil bearbeiten</h1>
            <?php
            if (isset($_GET['edit'])) {
                $vorname = $_POST['vorname'];
                $nachname = $_POST['nachname'];
                $nickname = $_POST['nickname'];
                $pic = $_POST['pic'];

                $sql = "UPDATE users SET vorname = '$vorname', nachname = '$nachname', nickname= '$nickname', pic= '$pic' WHERE  id = '$sess' ";
                $update = $pdo->prepare($sql);
                $update->execute();
                echo 'Bearbeitung erfolgreich!';
                echo '<br><br>';
                echo '<a href="profil_Ansicht.php?id='.$sess.'"><button class="button" id="back">Zurück zum Profil</button></a>';
                echo '<br><br>';
            }else {

                if (isset($_GET['id'])) {
                    $userID = $_GET['id'];
                }
                $statement = $pdo->query("SELECT * FROM users WHERE id = '$userID' ");
                $user = $statement->fetch();
                $vorname = $user['vorname'];
                $nachname = $user['nachname'];
                $nickname = $user['nickname'];


                echo '<div id="main-content">';
                echo '<form action="?edit=1" method="POST">';

                echo 'Vorname:<br>';
                echo '<input type="text" size="40" maxlength="250" name="vorname" value="' . $vorname . '"><br><br>';

                echo 'Nachname:<br>';
                echo '<input type="text" size="40" maxlength="250" name="nachname" value="' . $nachname . '"><br><br>';

                echo 'Nickname:<br>';
                echo '<input type="text" size="40" maxlength="250" name="nickname" value="' . $nickname . '"><br><br>';

                echo 'Profil-Bild:<br>';
                echo '<input type="file" accept="image/*" name="pic"/><br><br>';

                echo '<input type="submit" value="Bearbeiten" class="button">';
                echo '<a href="profil_ansicht.php?id='.$sess.'"><button type="button" class="button">Abbrechen</button></a>';
                echo '<a href="AccLoeschen.php"><button type="button" class="button" id="accloeschenbutton">Account löschen</button></a>';

                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';


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