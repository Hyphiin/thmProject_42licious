<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>42licious-Profil-Ansicht</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/rezept_css/rezeptAnsicht.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">

        <div class="main-content">

            <?php

            if (isset($_GET['order'])){
                $selected = 'selected';
            }else{
                $selected = '';
            }
            echo '<div class="rezept-list">';

            echo   '<div id="head-title">';
            echo       '<h1>Suchergebnisse</h1>';
            echo   '</div>';

            echo   '<div id="top-buttons">';
            echo      '<div>';
            echo          '<label for="filter">Sortieren nach:</label>';
            echo          '<select id="filter" name="filter" onchange="location = this.value">';
            echo              '<option value="profile_anzeigen.php">Name</option>';
            echo              '<option value="profile_anzeigen.php?order=created_at" '.$selected.'>Datum</option>';
            echo          '</select>';
            echo      '</div>';

            echo  '</div>';

            echo '<div class="recipies">';

            if(isset($_GET['order'])){
                $order = $_GET['order'];
            }else{
                $order = 'name';
            }

            $statement = $pdo->query("SELECT * FROM rezept ORDER BY $order");
            while ($recipe = $statement->fetch()) {

                $rezeptID = $recipe['id'];
                $name = $recipe['name'];
                $kat = $recipe['kat'];
                $diff = $recipe['diff'];
                $time = $recipe['time'];
                $bewertung = $recipe['bewertung'];
                $userid = $recipe['user'];
                $zutaten = $recipe['zutaten'];
                $zubereitung = $recipe['zubereitung'];
                $pic = $recipe['pic'];

                echo    '<a href="rezept_ansicht.php?id='.$userid.'">';
                echo        '<div class="rezept-preview">';
                echo        '<div class="rezept-preview-body">';
                echo            '<div class="rezept-preview-pic">';
                echo               '<img alt="Rezept-Bild" id="rezept_bild" src='."$pic".'>';
                echo            '</div>';
                echo            '<div class="rezept-preview-info">';
                echo                '<p>Name: '.$name.'</p>';
                echo                '<p>Schwierigkeit: '.$diff.'</p>';
                echo                   '<br>';
                echo                '<p>Kochzeit: '.$time.'</p>';
                echo            '</div>';
                echo            '</div>';
                echo        '</div>';
                echo    '</a>';
            }
            ?>
        </div>
        <div id="bottom-buttons">
            <button class="button" id="show-more">Mehr anzeigen</button>
        </div>

    </div>
</div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="../jscript/recipePreview.js"></script>

</body>
</html>
