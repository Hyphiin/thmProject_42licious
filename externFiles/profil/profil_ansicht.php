<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-Profil-Ansicht</title>
    <link href="../../css/general.css" rel="stylesheet" type="text/css">
    <link href="css/profil_css/profil_ansicht.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">
    <div id="main">
        <div id="top-buttons">

            <button class="button">Zurück</button>
            <button class="button">Bearbeiten</button>

        </div>

        <div id="main-content">
            <div id="profil_links">
            <div id="profil-title">
                <h1>Profil von USER</h1>
            </div>
            <div id="profil_inhalt">
                <button id="edit_profil">Profil bearbeiten</button>
                <img alt="Profil-Bild" src="images/profil/flo.png">
                <p id="name">Name: Max Mustermann</p>
                <p id="nickname">Nickname: USER</p>
                <p id="birthday">Geburtsdatum: TT.MM.JJ</p>

                <label for="beschreibung">Beschreibung</label>
                <textarea id="beschreibung" cols="50" rows="4"></textarea>

                <p>Mitglied seit: TT.MM.JJ</p>
            </div>
                <div id="linksbuttons">
                    <button id="user_rezept">Rezepte von USER</button>
                    <button id="user_blog">Blog von USER</button>
                </div>
            </div>
            <div id="profil_rechts">
                <div id="top_rezept">
                    <p>Hier soll das Top Rezept stehen!</p>
                </div>
                <div id="last_blog">
                    <p>Hier soll der letzte Blog stehen!</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>