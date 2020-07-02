<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

if ($sess == true) {

    $statement = $pdo->query("UPDATE users SET pic ='standard.png' WHERE id='$sess'");

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>NoSess</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/nosess.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="website">
    <?php include("navigation.php"); ?>

    <div id="main">
        <div id="main-content">
            <?php
            echo 'Profilbild zurückgesetzt';
            echo '<br><br>';
            echo '<a href="profil_Ansicht.php?id=' . $sess . '"><button class="button" id="back">Zurück zum Profil</button></a>';
            echo '<br><br>';
            }
            ?>
        </div>
    </div>

</div>
</body>

</html>