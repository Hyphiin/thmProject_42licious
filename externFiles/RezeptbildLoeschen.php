<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];
$rid = $_GET['rid'];

if ($sess == true) {

$statement = $pdo->query("UPDATE rezepte SET pic ='standard.png' WHERE uid='$sess' AND rid='$rid'");

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>42licious - Rezept bearbeiten</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/nosess.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="website">
    <?php include("Navigation.php"); ?>

    <div id="main">
        <div id="main-content">
            <?php
            echo '<div id="notification">';
            echo '<br>';
            echo 'Rezeptbild zurückgesetzt';
            echo '<br><br>';
            echo '<a href="RezeptAnsicht.php?id=' . $rid . '"><button class="button" id="back">Zurück zum Rezept</button></a>';
            echo '<br>';
            echo '</div>';
            }
            ?>
        </div>
    </div>

</div>
</body>

</html>