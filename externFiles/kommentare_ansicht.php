<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-Kommentare-Ansicht</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/kommentare_css/kommentare_ansicht.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">

        <div id="top-buttons">

            <a href="kommentar_schreiben.php"><button class="button">Zurück</button></a>

        </div>
        <div id="main-content">

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

        </div>
    </div>
</div>
</body>
</html>