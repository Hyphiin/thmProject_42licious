<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-Kochbuch</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/rezept_css/rezeptAnsicht.css" rel="stylesheet" type="text/css">
    <link href="../css/suchergebnisse.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">

        <div id="title">
            <h1>Kochbuch</h1>
        </div>

        <div id="kochbuchheader">
            <h3>Meine Rezepte | Meine Favoriten</h3>
        </div>

        <div id="top-buttons">

            <button class="button">Rezept erstellen</button>
            <label id="sortieren">Sortieren nach:
                <select name="sortieren" size="1">
                    <option>Bewertung</option>
                    <option>Name</option>
                    <option>Einstelldatum</option>
                </select>
            </label>
        </div>

        <div id="main-content">


            <div id="main" class="main">

                <div class="container">

                    <div class="recipe-preview">
                        <diV class="recipe-preview-image-container">
                            <img src="../images/lasagne.jpg" alt="">
                        </diV>
                        <div class="recipe-preview-description">
                            <h4>Rezeptname</h4>
                            <h5>von Username</h5>
                            <hr>
                        </div>
                    </div>

                    <div class="recipe-preview">
                        <diV class="recipe-preview-image-container">
                            <img src="../images/lasagne.jpg" alt="">
                        </diV>
                        <div class="recipe-preview-description">
                            <h4>Rezeptname</h4>
                            <h5>von Username</h5>
                            <hr>
                        </div>
                    </div>

                    <div class="recipe-preview">
                        <diV class="recipe-preview-image-container">
                            <img src="../images/lasagne.jpg" alt="">
                        </diV>
                        <div class="recipe-preview-description">
                            <h4>Rezeptname</h4>
                            <h5>von Username</h5>
                            <hr>
                        </div>
                    </div>

                </div>

            </div>

            <div id="bottom-buttons">
                <button class="button" id="show-more">Mehr anzeigen</button>
            </div>

        </div>
    </div>
</div>


</body>
</html>