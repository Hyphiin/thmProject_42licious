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

    </head>
    <body>

    <div id="website">

        <?php include("Navigation.php"); ?>

        <div id="main">

            <?php
            if (isset($_GET['edit'])) {
                $rid = $_POST['rid'];
                $titel = $_POST['titel'];
                $dauer = $_POST['dauer'];
                $schwierigkeit = $_POST['schwierigkeit'];
                $beschreibung = $_POST['beschreibung'];
                $personen = $_POST['personen'];
                $anleitung = $_POST['anleitung'];
                $kategorien = $_POST['cat'];
                
                $counter = $_POST['tableLength'];
                $zutatenListe = "";

                for($i = 0; $i < (intval($counter)+1); $i+=1){
                    $menge = $_POST['menge'.$i.''];
                    $zutat = $_POST['zutaten'.$i.''];

                    if($menge!="" || $zutat!=""){
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

                    if(empty($errors)==true) {
                        move_uploaded_file($file_tmp, "../images/rezepte/" . $file_name);
                    }
                }
                else{
                    $edit = $pdo->query("SELECT pic FROM rezepte WHERE rid='$rid'");
                    $noedit = $edit->fetch();
                    $file_name = $noedit['pic'];
                }

                $sql = "UPDATE rezepte SET titel = '$titel', pic = '$file_name', dauer = '$dauer', schwierigkeit = '$schwierigkeit', kategorien = '$kategorien', beschreibung = '$beschreibung', personen = '$personen', zutatenListe = '$zutatenListe', anleitung = '$anleitung'  WHERE  rid = '$rid' ";
                $update = $pdo->prepare($sql);
                $update->execute();
                echo '<br>';
                echo 'Bearbeitung erfolgreich!';
                echo '<br><br>';
                echo '<a href="RezeptAnsicht.php?id='.$rid.'"><button class="button" id="back">Zurück zum Rezept</button></a>';
                echo '<br><br>';
            }elseif(isset($_GET['delete'])) {
                $rezeptID = $_POST['rezeptID'];

                $statement1 = $pdo->query("DELETE FROM recipecomments WHERE rid= '$rezeptID'");
                $statement2 = $pdo->query("DELETE FROM bewertung WHERE rezeptID= '$rezeptID'");
                $statement3 = $pdo->query("DELETE FROM rezepte WHERE rid= '$rezeptID'");
                echo '<br>';
                echo 'Löschen erfolgreich!';
                echo '<br><br>';
                echo '<a href="Kochbuch.php?nutzer='.$sess.'"><button class="button" id="back">Zurück zum Kochbuch</button></a>';
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

            if ($kategorienListe=="fleisch;"){
                $fleisch = "checked";
            }elseif ($kategorienListe=="vegetarisch;"){
                $vegetarisch = "checked";
            }elseif ($kategorienListe=="vegetarisch;vegan;"){
                $vegan = "checked";
            }

            $zutatenTable = explode(";", $zutatenListe);
            ?>


            <div id="change-recipe">
                <h1>Rezept bearbeiten</h1>

                <?php

                echo '<form id="recipe-bearbeiten" action="?edit" method="post" enctype="multipart/form-data">

                <label for="titel">Titel:</label>
                <input type="text" name="titel" id="titel" size="40" placeholder="Titel eingeben..." value="' . $titel . '"><br/>
                <br/>

                Vorschaubild hochladen:<br>
                <input type="file" accept="image/*" name="pic"/><br><br>';


                echo '<label for="dauer">Dauer:</label>
                <input name="dauer" class="personen" type="number" min="5" max="600" size="4" value="'.$dauer.'" > Minuten<br/>
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

                echo '<div class="kategorie">
                    Kategorie:
                    <input type="radio" id="cat1" name="cat" value="fleisch;" '.$fleisch.'>
                    <label for="cat1"> Fleisch </label>
                    <input type="radio" id="cat2" name="cat" value="vegetarisch;" '.$vegetarisch.'>
                    <label for="cat2"> Vegetarisch </label><br>
                    <input type="radio" id="cat3" name="cat" value="vegetarisch;vegan;" '.$vegan.'>
                    <label for="cat3"> Vegan </label><br>
                </div>
                <br/>


                <label for="beschreibung">Beschreibung:</label><br/>
                <textarea class="beschreibung" name="beschreibung" maxlength="500">' . $beschreibung . '</textarea><br/><br/>

                Zutaten für <input class="personen" type="number" min="1" max="30" maxlength="3" name="personen" value="' . $personen . '"> Personen:
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
                </br>
                <input type="hidden" name="rid" value="' . $rezeptID . '">
                </form>';

                echo '<div id="bottom-buttons">
                        <div class="bottom-buttons-left">
                            <button type="submit" form="recipe-bearbeiten" class="button" id="create" type="submit">Bearbeiten</button>
                            <a href="RezeptAnsicht.php?id='.$rezeptID.'"><button type="button" class="button" id="cancel">Abbrechen</button></a>
                            <a href="RezeptbildLoeschen.php?rid='.$rezeptID.'"><button type="button" class="button" id="cancel">Rezeptbild löschen</button></a>
                        </div>   
                        <div id="bottom-buttons-right">
                            <form action="?delete" method="post">
                                <input type="hidden" name="rezeptID" value="'.$rezeptID.'">   
                                <button class="button" id="delete">Rezept löschen</button>
                            </form>
                        </div> 
                      </div>';



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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
    <script>
        gsap.from("#main",{y:20});
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