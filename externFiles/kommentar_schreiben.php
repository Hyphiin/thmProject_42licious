<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-Kommentare-Ansicht</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/kommentare_css/kommentar_schreiben.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">
    <div id="main">
        <div id="top-buttons">

            <a href="kommentare_ansicht.php"><button class="button">Zurück</button></a>

        </div>
        <div id="main-content">

            <header id="kommentare-head">
                <h1>Kommentare</h1>
            </header>

            <div id="kommentar_schreiben">
                <textarea id="kommentieren" cols="50" rows="4" placeholder="Kommentar schreiben..."></textarea>

                <span id="commentbuttons">
                <a href="kommentar_schreiben.php"><button id="abbrechen"> Abbrechen </button></a>

                <button id="abschicken" type="submit"> Kommentieren </button>
                </span>

            </div>

            <div id="kommentar_sektion">
                <ul>
                    <li>
                        <textarea placeholder="Kommentar"></textarea>
                    </li>
                    <li>
                        <textarea placeholder="Kommentar"></textarea>
                    </li>
                    <li>
                        <textarea placeholder="Kommentar"></textarea>
                    </li>
                </ul>
            </div>

            <button id="mehr_Anzeigen">mehr Anzeigen</button>


        </div>
    </div>
</div>
</body>
</html>
