<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

if ($sess == true) {
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-RezeptErstellen</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/rezept_css/rezeptErstellen.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="website">

    <?php include("navigation.php");


    if(isset($_GET['erstellen'])) {
        $titel = $_POST['titel'];
        $pic = $_POST['pic'];
        $dauer = $_POST['dauer'];
        $schwierigkeit = $_POST['schwierigkeit'];
        $beschreibung = $_POST['beschreibung'];
        $personen = $_POST['personen'];
        $anleitung = $_POST['anleitung'];
        $cat1 = $_POST['cat1'];
        $cat2 = $_POST['cat2'];
        $cat3 = $_POST['cat3'];
        $kategorien = "";

        if($cat1!=""){
            $kategorien.=$cat1.";";
        }
        if($cat2!=""){
            $kategorien.=$cat2.";";
        }
        if($cat3!=""){
            $kategorien.=$cat3.";";
        }

        $counter = $_POST['tableLength'];
        $zutatenListe = "";

        for($i = 0; $i < (intval($counter)+1); $i+=1){
            $menge = $_POST['menge'.$i.''];
            $zutat = $_POST['zutaten'.$i.''];

            if($menge!="" || $zutat!=""){
                $zutatenListe .= $menge . ":" . $zutat . ";";
            }

        }

        $statement = $pdo->prepare("INSERT INTO rezepte (uid, titel, dauer, schwierigkeit, kategorien, beschreibung, personen, zutatenListe,  anleitung, pic) VALUES (:uid, :titel , :dauer, :schwierigkeit, :kategorien, :beschreibung, :personen, :zutatenListe, :anleitung, :pic)");
        $result = $statement->execute(array('uid' => $sess, 'titel' => $titel, 'dauer' => $dauer, 'schwierigkeit' => $schwierigkeit,'kategorien' => $kategorien, 'beschreibung' => $beschreibung, 'personen' => $personen, 'zutatenListe' => $zutatenListe, 'anleitung' => $anleitung, 'pic' => $pic));
    }
    ?>

    <div id="main">

        <div id="create-recipe">
            <h1>Rezept erstellen</h1>

            <form id="recipe-erstellen" action="?erstellen" method="post">

                <label for="titel">Titel:</label>
                <input type="text" name="titel" id="titel" size="40" placeholder="Titel eingeben..."><br/>
                <br/>

                Vorschaubild hochladen:<br>
                <input type="file" accept="image/*" name="pic"/><br><br>

                <label for="dauer">Dauer:</label>
                <select name="dauer" id="dauer">
                    <option value="15 Min">15 Min</option>
                    <option value="30 Min">30 Min</option>
                    <option value="45 Min">45 Min</option>
                    <option value="60 Min">60 Min</option>
                    <option value="90 Min">90 Min</option>
                    <option value="120 Min">120 Min</option>
                </select><br/>
                <br/>

                <label for="schwierigkeit">Schwierigkeit:</label>
                        <select name="schwierigkeit" id="schwierigkeit">
                            <option value="leicht">leicht</option>
                            <option value="mittel">mittel</option>
                            <option value="schwer">schwer</option>
                            <option value="sehr schwer">sehr schwer</option>
                        </select><br/>
                <br/>

                <div class="kategorie">
                    Kategorie:
                    <input type="checkbox" id="cat1" name="cat1" value="fleisch" checked="checked">
                    <label for="cat1"> Fleisch </label>
                    <input type="checkbox" id="cat2" name="cat2" value="vegetarisch">
                    <label for="cat2"> Vegetarisch </label><br>
                    <input type="checkbox" id="cat3" name="cat3" value="vegan">
                    <label for="cat3"> Vegan </label><br>
                </div><br/>


                <label for="beschreibung">Beschreibung:</label><br/>
                <textarea class="beschreibung" name="beschreibung" maxlength="500" placeholder="Beschreibung eingeben..."></textarea><br/><br/>

                Zutaten für <input class="personen" type="number" name="personen"> Personen:
                <table id="zutatenTable">
                    <tr>
                        <td><input type="text" name="menge0" id="menge" size="40" placeholder="Menge eingeben..."></td>
                        <td><input type="text" name="zutaten0" id="zutaten" size="40" placeholder="Zutaten eingeben..."></td>
                    </tr>
                </table>
                <button class="button" id="plus" type="button" onclick="addRow()">+</button>
                <br/><br/>

                <input type="hidden" id="tableLength" name="tableLength" value="">

                <label for="zubereitung">Zubereitung:</label><br/>
                <textarea class="zubereitung" name="anleitung" placeholder="Zubereitung eingeben..."></textarea><br/>
                </br>

                <div class="bottom-buttons">
                    <button type="submit" class="button" id="create" type="submit">Erstellen</button>
                    <a href="kochbuch.php"><button type="button" class="button" id="cancel">Abbrechen</button></a>
                </div>


            </form>
            </br>


        </div>



    </div>
</div>

<script>
    var counter = 1;
    function addRow() {
        var table = document.getElementById("zutatenTable");
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        cell1.innerHTML = '<input type="text" name="menge'+ counter +'" id="menge" size="40" placeholder="Menge eingeben...">';
        cell2.innerHTML = '<input type="text" name="zutaten'+ counter +'" id="zutaten" size="40" placeholder="Zutaten eingeben...">';
        cell3.innerHTML = "<button class=\"button\" type=\"button\" onclick=\"deleteRow(this)\">-</button>"

        document.getElementById("tableLength").value = counter;
        counter ++;
    }

    function deleteRow(row)
    {
        var i=row.parentNode.parentNode.rowIndex;
        document.getElementById('zutatenTable').deleteRow(i);
    }

</script>

</body>
</html>
    <?php
    ;
} else if($sess != true){

    echo"Bitte einloggen!". " ". '<a href="login.php">zum Login</a>';
    echo'<br>';
    echo"Noch kein Mitglied?". " ". '<a href="registrieren.php">Mitglied werden!</a>';

}
?>