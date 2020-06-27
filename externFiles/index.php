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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>42licious</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/index.css" rel="stylesheet" type="text/css">
    <link href="../css/recipePreview.css" rel="stylesheet" type="text/css">


</head>
<body>


<div id="website">

    <?php include("navigation.php"); ?>

    <div class="main">

        <div class="container-index">
            <div class="index-title">
                <h1>Top der Woche</h1>
            </div>

            <?php
            include("rezeptPreview.php");
            include("rezeptPreview.php");
            include("rezeptPreview.php");
            ?>


        </div>

        <div class="container-index">
            <div class="index-title">
                <h1>Vorschläge für Dich</h1>
            </div>

            <?php
            include("rezeptPreview.php");
            include("rezeptPreview.php");
            include("rezeptPreview.php");
            ?>

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