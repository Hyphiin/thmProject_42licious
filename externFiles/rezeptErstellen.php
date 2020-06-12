<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-RezeptErstellen</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/rezept_css/rezeptErstellen.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">

        <div id="create-recipe">
            <h1>Rezept erstellen</h1>

            <form id="recipe-erstellen">
                <label for="titel">Titel:</label>
                <input type="text" name="titel" id="titel" size="40" placeholder="Titel eingeben..."><br/>
                <br/>
                <label for="dauer">Dauer:</label>
                <input type="text" name="dauer" id="dauer" size="40" placeholder="Minuten eingeben..."><br/>
                <br/>
                <label for="schwierigkeit">Schwierigkeit:</label>
                        <select name="schwierigkeit" id="schwierigkeit">
                            <option value="leicht">leicht</option>
                            <option value="mittel">mittel</option>
                            <option value="schwer">schwer</option>
                            <option value="sehr schwer">sehr schwer</option>
                        </select></br>
                <br/>
                <label for="beschreibung">Beschreibung:</label><br/>
                <textarea rows="20" maxlength="2000" name="beschreibung" form="beschreibung" id="beschreibung" placeholder="Inhalt eingeben..."></textarea></br>
                <label for="zutaten">Zutaten:</label>
                <table>
                    <tr>
                        <td><input type="text" name="menge" id="menge" size="40" placeholder="Menge eingeben..."></td>
                        <td><input type="text" name="zutaten" id="zutaten" size="40" placeholder="Zutaten eingeben..."></td>
                    </tr>
                </table>
                <button class="button" id="plus">+</button>
                <br/>
                <label for="zubereitung">Zubereitung:</label><br/>
                <textarea rows="20" maxlength="2000" name="zubereitung" form="zubereitung" id="zubereitung" placeholder="Inhalt eingeben..."></textarea></br>
                </br>
                +++ Bilder hochladen +++
            </form>
            </br>

        </div>

        <div id="bottom-buttons">
            <button class="button" id="cancel">Abbrechen</button>
            <button class="button" id="create">Erstellen</button>

        </div>

    </div>
</div>

</body>
</html>