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

        <title>42licious-RezeptBearbeiten</title>
        <link href="../css/general.css" rel="stylesheet" type="text/css">
        <link href="../css/rezept_css/rezeptBearbeiten.css" rel="stylesheet" type="text/css">
        <link href="../css/navigation.css" rel="stylesheet" type="text/css">
        <link href="../css/navigation.css" rel="stylesheet" type="text/css">

    </head>
    <body>

    <div id="website">

        <?php include("Navigation.php"); ?>

        <div id="main">

            <?php
            if (isset($_GET['edit'])) {
                $rid = $_POST['rid'];
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

                $sql = "UPDATE rezepte SET titel = '$titel', pic = '$pic', dauer = '$dauer', schwierigkeit = '$schwierigkeit', kategorien = '$kategorien', beschreibung = '$beschreibung', personen = '$personen', zutatenListe = '$zutatenListe', anleitung = '$anleitung'  WHERE  rid = '$rid' ";
                $update = $pdo->prepare($sql);
                $update->execute();
                echo '<br>';
                echo 'Bearbeitung erfolgreich!';
                echo '<br><br>';
                echo '<a href="rezeptAnsicht.php?id='.$rid.'"><button class="button" id="back">Zurück zum Rezept</button></a>';
                echo '<br><br>';
            }else{
            if (isset($_GET['bearbeiten'])) {
                $rezeptID = $_POST['id'];
            }

            $statement = $pdo->query("SELECT * FROM rezepte WHERE rid = '$rezeptID' ");
            $rezept = $statement->fetch();

            $titel = $rezept['titel'];
            $uid = $rezept['uid'];
            $dauer = $rezept['dauer'];
            $schwierigkeit = $rezept['schwierigkeit'];
            $kategorienListe = $rezept['kategorien'];
            $beschreibung = $rezept['beschreibung'];
            $personen = $rezept['personen'];
            $zutatenListe = $rezept['zutatenListe'];
            $anleitung = $rezept['anleitung'];

            $zutatenTable = explode(";", $zutatenListe);
            ?>


            <div id="change-recipe">
                <h1>Rezept bearbeiten</h1>

                <?php

                echo '<form id="recipe-bearbeiten" action="?edit" method="post">

                <label for="titel">Titel:</label>
                <input type="text" name="titel" id="titel" size="40" placeholder="Titel eingeben..." value="' . $titel . '"><br/>
                <br/>

                Vorschaubild hochladen:<br>
                <input type="file" accept="image/*" name="pic"/><br><br>';


                echo '<label for="dauer">Dauer:</label>
                <input name="dauer" class="personen" type="number" size="4" value="'.$dauer.'" > Minuten<br/>
                <br/>';


                if($schwierigkeit=="leicht"){
                    $leicht = "selected";
                }elseif ($schwierigkeit=="mittel"){
                    $mittel = "selected";
                }elseif ($schwierigkeit=="schwer"){
                    $schwer = "selected";
                }elseif ($schwierigkeit=="sehr schwer"){
                    $sehrschwer = "selected";
                }
                echo '<label for="schwierigkeit">Schwierigkeit:</label>
                <select name="schwierigkeit" id="schwierigkeit">
                    <option value="leicht" '.$leicht.'>leicht</option>
                    <option value="mittel" '.$mittel.'>mittel</option>
                    <option value="schwer" '.$schwer.'>schwer</option>
                    <option value="sehr schwer" '.$sehrschwer.'>sehr schwer</option>
                </select><br/>
                <br/>';

                $kategorie = explode(";", $kategorienListe);
    for ($i = 0; $i < count($kategorie); $i++) {
        if ($kategorie[$i] == "fleisch") {
            $fleisch = "checked";
        } elseif ($kategorie[$i] == "vegetarisch") {
            $vegetarisch = "checked";
        } elseif ($kategorie[$i] == "vegan") {
            $vegan = "checked";
        }
    }
                echo '<div class="kategorie">
                    Kategorie:
                    <input type="checkbox" id="cat1" name="cat1" value="fleisch" '.$fleisch.'>
                    <label for="cat1"> Fleisch </label>
                    <input type="checkbox" id="cat2" name="cat2" value="vegetarisch" '.$vegetarisch.'>
                    <label for="cat2"> Vegetarisch </label><br>
                    <input type="checkbox" id="cat3" name="cat3" value="vegan" '.$vegan.'>
                    <label for="cat3"> Vegan </label><br>
                </div>
                <br/>


                <label for="beschreibung">Beschreibung:</label><br/>
                <textarea class="beschreibung" name="beschreibung" maxlength="500">' . $beschreibung . '</textarea><br/><br/>

                Zutaten für <input class="personen" type="number" name="personen" value="' . $personen . '"> Personen:
                <table id="zutatenTable">';
                for ($i = 0; $i < (count($zutatenTable)-1); $i++) {
                    $zutatenSpalte = explode(":", $zutatenTable[$i]);
                    echo '<tr>';
                    echo '<td><input type="text" name="menge'.$i.'" id="menge" size="40" value="'.$zutatenSpalte[0].'"></td>';
                    echo '<td><input type="text" name="zutaten'.$i.'" id="zutaten" size="40" value="'.$zutatenSpalte[1].'"></td>';
                    if($i!=0) {
                        echo '<td><button class="button" type="button" onclick="deleteRow(this)">-</button></td>';
                    }
                    echo '</tr>';
                }
                echo '</table>
                <button class="button" id="plus" type="button" onclick="addRow()">+</button>
                <br/><br/>

                <input type="hidden" id="tableLength" name="tableLength" value="'.count($zutatenTable).'">          

                <label for="zubereitung">Zubereitung:</label><br/>
                <textarea class="zubereitung" name="anleitung" >' . $anleitung . '</textarea><br/>
                </br>';
                echo '<input type="hidden" name="rid" value="' . $rezeptID . '">';

                echo '<div class="bottom-buttons">
                    <button type="submit" class="button" id="create" type="submit">Bearbeiten</button>
                    <a href="rezeptAnsicht.php?id='.$rezeptID.'">
                        <button type="button" class="button" id="cancel">Abbrechen</button>
                    </a>
                </div>


            </form>';
                }
                ?>
                <br/>


            </div>


        </div>
    </div>

    <script>
        let counter = (document.getElementById("zutatenTable").rows.length) + 1;

        function addRow() {
            let table = document.getElementById("zutatenTable");
            let row = table.insertRow(-1);
            let cell1 = row.insertCell(0);
            let cell2 = row.insertCell(1);
            let cell3 = row.insertCell(2);
            cell1.innerHTML = '<input type="text" name="menge' + counter + '" id="menge" size="40" placeholder="Menge eingeben...">';
            cell2.innerHTML = '<input type="text" name="zutaten' + counter + '" id="zutaten" size="40" placeholder="Zutaten eingeben...">';
            cell3.innerHTML = "<button class=\"button\" type=\"button\" onclick=\"deleteRow(this)\">-</button>"

            document.getElementById("tableLength").value = counter;
            counter++;
        }

        function deleteRow(row) {
            let i = row.parentNode.parentNode.rowIndex;
            document.getElementById('zutatenTable').deleteRow(i);
        }


    </script>

    </body>
    </html>
    <?php
} else if ($sess != true) {

    echo "Bitte einloggen!" . " " . '<a href="AccLogin.php">zum Login</a>';
    echo '<br>';
    echo "Noch kein Mitglied?" . " " . '<a href="AccRegistrieren.php">Mitglied werden!</a>';

}
?>