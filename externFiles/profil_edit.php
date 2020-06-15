<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-Profil-Bearbeitung</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/profil_css/profil_edit.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">
    <div id="main">
        <div id="top-buttons">
            <a href="profil_ansicht.php"><button class="button">Zurück</button></a>
        </div>
        <div id="main-content">
            <div id="profil-title">
                <h1>Profil bearbeiten</h1>
            </div>
            <div id="profil_inhalt">
                <div id="Picture">
                    <img id="profilpic" alt="Profil-Bild" src="shindy.jpg">

                    <form action="#" method="post">
                        <input type="file" value="Datei auswählen" id="profil_pic">
                        <input type="submit" value="Hochladen" />
                    </form>
                </div>

                <label for="vorname">Vorname</label>
                <input type="text" maxlength="25" id="vorname" placeholder="Vorname">

                <label for="nachname">Nachname</label>
                <input type="text" maxlength="25" id="nachname" placeholder="Nachname">

                <label for="namensanzeige">Namensanzeige</label>
                <select id="namensanzeige" size="1">
                    <option>Voller Name</option>
                    <option>Nur Vorname</option>
                    <option>Vorname + Initiale</option>
                </select>



                <label for="beschreibung">Beschreibung</label>
                <textarea id="beschreibung" cols="50" rows="4"></textarea>

                <div id="bottom-buttons">
                    <a href="profil_edit.php"><button>Abbrechen</button></a>
                    <button>Änderungen Speichern</button>
                </div>

            </div>
    </div>
    </div>
</div>
</body>
</html>