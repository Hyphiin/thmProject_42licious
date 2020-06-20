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

            <form id="recipe-erstellen" action="?hochladen" method="post">
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
                <input type="text" rows="20" maxlength="2000" name="beschreibung" form="beschreibung" id="beschreibung" placeholder="Inhalt eingeben..." ></br>
                <label for="zutaten">Zutaten:</label>
                <table id="zutatenTable">
                    <tr>
                        <td><input type="text" name="menge" id="menge" size="40" placeholder="Menge eingeben..."></td>
                        <td><input type="text" name="zutaten" id="zutaten" size="40" placeholder="Zutaten eingeben..."></td>
                    </tr>
                </table>
                <button class="button" id="plus" type="button" onclick="addRow()">+</button>
                <br/>
                <label for="zubereitung">Zubereitung:</label><br/>
                <input type="text" rows="20" maxlength="2000" name="zubereitung" form="zubereitung" id="zubereitung" placeholder="Inhalt eingeben..."></br>
                </br>
                +++ Bilder hochladen +++
                <button class="button" id="create" type="submit">Erstellen</button>
            </form>
            </br>


        </div>

        <div id="bottom-buttons">
            <button class="button" id="cancel">Abbrechen</button>
        </div>

    </div>
</div>

<script>
    function addRow() {
        var table = document.getElementById("zutatenTable");
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        cell1.innerHTML = "<input type=\"text\" name=\"menge\" id=\"menge\" size=\"40\" placeholder=\"Menge eingeben...\">";
        cell2.innerHTML = "<input type=\"text\" name=\"zutaten\" id=\"zutaten\" size=\"40\" placeholder=\"Zutaten eingeben...\">";
        cell3.innerHTML = "<button class=\"button\" type=\"button\" onclick=\"deleteRow(this)\">-</button>"
    }

    function deleteRow(row)
    {
        var i=row.parentNode.parentNode.rowIndex;
        document.getElementById('zutatenTable').deleteRow(i);
    }

</script>

</body>
</html>