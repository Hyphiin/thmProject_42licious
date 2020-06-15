<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>42licious-Profil-Ansicht</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/profil_css/profil_ansicht.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("navigation.php"); ?>

    <div class="main">
    <div id="main-content">

        <div id="top-buttons">

            <a href="index.php"><button class="button">Zurück</button></a>
            <a href="profil_edit.php"><button class="button">Bearbeiten</button></a>
            <link href="../css/recipePreview.css" rel="stylesheet" type="text/css">

        </div>

        <div id="main-profile">
            <div id="profil-title">
                <h1>Profil von USER</h1>
            </div>
            <div id="profil_inhalt">
                <div id="profil_links">
                    <div id="BildUndButtons">
                        <img alt="Profil-Bild" id="profil_bild" src="shindy.jpg">
                        <div id="linksbuttons">
                            <a href="profil_rezept.php"><button id="user_rezept">Rezepte</button></a>
                            <a href="blogUSER.php"><button id="user_blog">Blog</button></a>
                        </div>
                    </div>
                    <div id="details">
                        <p id="name">Name: Max Mustermann</p>
                        <p id="nickname">Nickname: USER</p>
                        <p id="birthday">Geburtsdatum: TT.MM.JJ</p>
                    </div>

                    <label for="beschreibung">Beschreibung</label>
                    <textarea id="beschreibung" cols="50" rows="4"></textarea>

                    <p>Mitglied seit: TT.MM.JJ</p>
                </div>
                <div id="profil_rechts">

                    <div class="recipe-highlight">
                        <h4>Top Rezept</h4>
                        <?php include("rezeptPreview.php"); ?>
                    </div>

                    <div class="recipe-highlight">
                        <h4>Letzter Blog</h4>
                        <?php include("rezeptPreview.php"); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</body>
</html>