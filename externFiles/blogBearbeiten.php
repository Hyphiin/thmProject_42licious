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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-BlogBearbeiten</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/blog_css/blogBearbeiten.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="website">

    <div id="main">

        <div id="edit-blog">
            <h1>Blogeintrag bearbeiten</h1>

            <form action="?bearbeiten=1" method="post">
                Titel:<br>
                <input type="text" name="titel" size="40" maxlength="255">
                <br><br>
                Inhalt:<br>
                <input type="text" name="inhalt" size="40" maxlength="255">
                <br><br>
                <input type="submit" value="Bloggen" class="button">
            </form>


        </div>

        <div id="bottom-buttons">
            <div>
            <button class="button" id="delete">Eintrag löschen</button>
            </div>
            <div>
            <button class="button" id="cancel">Abbrechen</button>
            </div>

        </div>

    </div>
</div>

</body>
</html>

    <?php
    ;
} else if($sess != true){

    echo"Bitte einloggen!". " ". '<a href="login.php">zum Login</a>';
    echo'<br>';
    echo"Noch kein Mitglied?". " ". '<a href="registrieren.php">Mitglied werden!</a>';

}
?>