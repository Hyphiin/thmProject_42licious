<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>42licious-Profil-Ansicht</title>
    <link href="../../css/general.css" rel="stylesheet" type="text/css">
    <link href="../../css/profil_css/profil_ansicht.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">
    <div id="main">
        <div id="top-buttons">

            <button class="button">Zurück</button>
            <button class="button">Bearbeiten</button>

        </div>

        <div id="main-content">
            <div id="profil-title">
                <h1>Profil von USER</h1>
            </div>
            <div id="profil_inhalt">
                <div id="profil_links">
                    <img alt="Profil-Bild" id="profil_bild" src="shindy.jpg">
                    <div id="details">
                        <p id="name">Name: Max Mustermann</p>
                        <p id="nickname">Nickname: USER</p>
                        <p id="birthday">Geburtsdatum: TT.MM.JJ</p>
                    </div>

                    <label for="beschreibung">Beschreibung</label>
                    <textarea id="beschreibung" cols="50" rows="4"></textarea>

                    <p>Mitglied seit: TT.MM.JJ</p>
                    <div id="linksbuttons">
                        <button id="user_rezept">Rezepte von USER</button>
                        <button id="user_blog">Blog von USER</button>
                    </div>
                </div>
                <div id="profil_rechts">
                    <div id="top_rezept">
                        <label>Top Rezept</label>
                        <p id="toprezept">Hier soll das Top Rezept stehen!</p>
                    </div>
                    <div id="last_blog">
                        <label>Letzter Blog</label>
                        <p id="lastblog">Hier soll der letzte Blog stehen!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>