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

    <title>42licious-BlogErstellen</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/blog_css/blogErstellen.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">
        <div class="blog-main">
        <div id="create-blog">
            <h1>Blogeintrag erstellen</h1>

            <form action="?erstellen=1" method="post">
                Titel:<br>
                <input type="text" name="titel" size="40" maxlength="255">
                <br><br>
                Inhalt:<br>
                <textarea name="inhalt"></textarea>
                <br><br>
                <input type="submit" value="Bloggen" class="button">
            </form>

        </div>

        <div id="bottom-buttons">
            <a href="blogUSER.php"><button class="button" id="cancel">Abbrechen</button></a>

        </div>
        </div>
    </div>
</div>

<?php
if(isset($_GET['erstellen'])){
    $titel = $_POST['titel'];
    $inhalt = $_POST['inhalt'];

    $statement = $pdo->prepare("INSERT INTO blog (Nutzer, titel, inhalt) VALUES (:Nutzer ,:titel, :inhalt)");
    $result = $statement->execute(array('Nutzer' => $sess, 'titel' => $titel, 'inhalt' => $inhalt));
}
?>

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