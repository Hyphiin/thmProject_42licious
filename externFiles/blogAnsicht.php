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

    <title>42licious-BlogAnsicht</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/blog_css/blogAnsicht.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("navigation.php"); ?>

<div id="main">

    <div id="top-buttons">

        <a href="blogUSER.php"><button class="button">Zurück zum Blog</button></a>

        <?php
        if(isset($_GET['id'])){
            $blogID= $_GET['id'];
        }

        $statement = $pdo->query("SELECT * FROM blog WHERE id = '$blogID' ");
        $blog = $statement->fetch();

        $author= $blog['nutzer'];
        $title = $blog['titel'];
        $timestamp = $blog['rdate'];
        $entry = $blog['inhalt'];

        if ($sess==$author) {
            echo '<a href="blogBearbeiten.php?id='.$blogID.'"><button class="button">Bearbeiten</button></a>';
        }
        ?>

    </div>

    <div id="main-content">
        <?php


        echo '<div id="blog-info">';

        echo  '<div id="blog-title">';
        echo    '<h1>' .$title. '</h1>';
        echo  '</div>';

        echo  '<div id="timestamp">';
        echo    '<p>' .$timestamp. '</p>';
        echo  '</div>';

        echo '</div>';

        echo '<div id="blog-content">';
        echo    '<p>';
        echo       nl2br($entry);
        echo    '</p>';
        echo  '</div>';
?>
    </div>

    <div id="comments">
        <h3>Kommentare</h3>
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