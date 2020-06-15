<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-BlogAnsicht</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/suchergebnisse.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/recipePreview.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">

        <div id="top-buttons">

            <a href="index.php"><button class="button">Zurück</button></a>

        </div>

        <div class="main-content">
            <div id="rezeptsuche-title">
                <h1>Suchergebnisse</h1>
            </div>

            <div class="sortierung">
                <label for="sortieren">Sortieren nach</label>
                <select id="sortieren" size="1">
                    <option>Bewertung</option>
                    <option>Name</option>
                    <option>Erstellungsdatum</option>
                </select>
            </div>

            <div class="recipies">
            <div class="recipe-container">

                <?php
                include("rezeptPreview.php");
                include("rezeptPreview.php");
                include("rezeptPreview.php");
                include("rezeptPreview.php");
                include("rezeptPreview.php");
                include("rezeptPreview.php");
                include("rezeptPreview.php");
                include("rezeptPreview.php");
                include("rezeptPreview.php");
                include("rezeptPreview.php");
                include("rezeptPreview.php");
                include("rezeptPreview.php");
                ?>

            </div>
            </div>
            <div id="bottom-buttons">
                <button class="button" id="show-more">Mehr anzeigen</button>
            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="../jscript/recipePreview.js"></script>

</body>
</html>
