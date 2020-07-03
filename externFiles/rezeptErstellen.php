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
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title>42licious-RezeptErstellen</title>
        <link href="../css/general.css" rel="stylesheet" type="text/css">
        <link href="../css/rezept_css/rezeptErstellen.css" rel="stylesheet" type="text/css">
        <link href="../css/navigation.css" rel="stylesheet" type="text/css">

    </head>
<body>

<div id="website">

    <?php include("Navigation.php");

    echo '<div id="main">';

    if (isset($_GET['erstellen'])) {
        $titel = $_POST['titel'];
        $pic = $_POST['pic'];
        $dauer = $_POST['dauer'];
        $schwierigkeit = $_POST['schwierigkeit'];
        $beschreibung = $_POST['beschreibung'];
        $personen = $_POST['personen'];
        $anleitung = $_POST['anleitung'];
        $kategorien = $_POST['cat'];

        $counter = $_POST['tableLength'];
        $zutatenListe = "";

        for ($i = 0; $i < (intval($counter) + 1); $i += 1) {
            $menge = $_POST['menge' . $i . ''];
            $zutat = $_POST['zutaten' . $i . ''];

            if ($menge != "" || $zutat != "") {
                $zutatenListe .= $menge . ":" . $zutat . ";";
            }

        }

        if($_FILES['pic']['error']!=4){
            $errors= array();
            $file_name = $_FILES['pic']['name'];
            $file_size = $_FILES['pic']['size'];
            $file_tmp =$_FILES['pic']['tmp_name'];
            $file_type=$_FILES['pic']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['pic']['name'])));

            $extensions= array("jpeg","jpg","png");

            if($file_name=="standard.png"){
                $errors[]="Bitte Dateinamen ändern.";
            }

            if(in_array($file_ext,$extensions)=== false){
                $errors[]="Dateiendung nicht erlaubt, bitte wähle eine JPEG oder PNG Datei.";
            }

            if($file_size > 2097152){
                $errors[]='Dateigröße darf 2MB nicht überschreiten!';
            }

            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"../images/rezepte/".$file_name);
            }else{
                print_r($errors);
            }
        }
        else{
            $file_name="standard.png";
        }

        if(empty($errors)) {
            $statement = $pdo->query("INSERT INTO rezepte (uid, titel, dauer, schwierigkeit, kategorien, beschreibung, personen, zutatenListe,  anleitung, pic) VALUES ('$sess', '$titel', '$dauer', '$schwierigkeit', '$kategorien', '$beschreibung', '$personen', '$zutatenListe', '$anleitung', '$file_name')");
        }

        echo '<br>';
        echo 'Rezept erstellt!';
        echo '<br><br>';
        echo '<a href="Kochbuch.php?nutzer=' . $sess . '"><button class="button" id="back">Zurück zum Kochbuch</button></a>';
        echo '<br><br>';
    } else {
        ?>


        <div id="change-recipe">
            <h1>Rezept erstellen</h1>

            <form id="recipe-erstellen" action="?erstellen" method="post" enctype="multipart/form-data">

                <label for="titel">Titel:</label>
                <input type="text" name="titel" id="titel" size="40" placeholder="Titel eingeben..."><br/>
                <br/>

                Vorschaubild hochladen:<br>
                <input type="file" accept="image/*" name="pic"/><br><br>

                <label for="dauer">Dauer:</label>
                <input name="dauer" class="personen" type="number" min="5" maxlength="3" max="600" size="4"> Minuten<br/>
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
                    <input type="radio" id="cat1" name="cat" value="fleisch;" checked="checked">
                    <label for="cat1"> Fleisch </label>
                    <input type="radio" id="cat2" name="cat" value="vegetarisch;">
                    <label for="cat2"> Vegetarisch </label><br>
                    <input type="radio" id="cat3" name="cat" value="vegetarisch;vegan;">
                    <label for="cat3"> Vegan </label><br>
                </div>
                <br/>


                <label for="beschreibung">Beschreibung:</label><br/>
                <textarea class="beschreibung" name="beschreibung" maxlength="500"
                          placeholder="Beschreibung eingeben..."></textarea><br/><br/>

                Zutaten für <input class="personen" type="number" min="1" max="30" name="personen"> Personen:
                <table id="zutatenTable">
                    <tr>
                        <td><input type="text" name="menge0" id="menge" size="40" placeholder="Menge eingeben..."></td>
                        <td><input type="text" name="zutaten0" id="zutaten" size="40" placeholder="Zutaten eingeben...">
                        </td>
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
                    <a href="javascript:history.back()"><button type="button" class="button" id="cancel">Abbrechen</button></a>
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
                cell1.innerHTML = '<input type="text" name="menge' + counter + '" id="menge" size="40" placeholder="Menge eingeben...">';
                cell2.innerHTML = '<input type="text" name="zutaten' + counter + '" id="zutaten" size="40" placeholder="Zutaten eingeben...">';
                cell3.innerHTML = "<button class=\"button\" type=\"button\" onclick=\"deleteRow(this)\">-</button>"

                document.getElementById("tableLength").value = counter;
                counter++;
            }

            function deleteRow(row) {
                var i = row.parentNode.parentNode.rowIndex;
                document.getElementById('zutatenTable').deleteRow(i);
            }

        </script>

        </body>
        </html>
        <?php
    }
} else if ($sess != true) {

    echo"Bitte einloggen!". " ". '<a href="AccLogin.php">zum Login</a>';
    echo'<br>';
    echo"Noch kein Mitglied?". " ". '<a href="AccRegistrieren.php">Mitglied werden!</a>';

}
?>