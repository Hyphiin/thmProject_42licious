<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>42licious-Profil-Ansicht</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/profil_css/profil_ansicht.css" rel="stylesheet" type="text/css">
    <link href="../css/profil_css/profil_anzeigen.css" rel="stylesheet" type="text/css">
    <link href="../css/rezept_css/rezeptPreview.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">

        <div class="main-content">

            <div class="search-list">

                <?php

                if (isset($_GET["selection"])) {
                    $auswahl = $_GET["selection"];
                }

                if (isset($_GET["suchbegriff"])) {
                    $suchwort = $_GET["suchbegriff"];

                    echo '<div id="head-title">';
                    echo '<h1>Suchergebnisse für "' . $suchwort . '"</h1>';
                    echo ' </div>';

                    echo '<div id="top-buttons">';
                    echo '<div>';
                    echo '<label for="filter">Sortieren nach:</label>';
                    echo '<select id="filter" name="filter">';
                    echo '<option value="name">Name</option>';
                    echo '<option value="date">Datum</option>';
                    echo '</select>';
                    echo '</div>';

                    echo '</div>';

                    echo '<div class="result">';

                    if($auswahl=='users'){
                        $suchwort = explode(" ", $suchwort);
                        $abfrage = "";
                        $a = array('vorname', 'nachname', 'nickname');
                        for ($i = 0; $i < sizeof($suchwort); $i++) {
                            for ($ii = 0; $ii < sizeof($a); $ii++) {
                                if ($ii == 0) {
                                    $abfrage .= "(";
                                }
                                $abfrage .= "`" . $a[$ii] . "` LIKE '%" . $suchwort[$i] . "%'";
                                if ($ii < (sizeof($a) - 1)) {
                                    $abfrage .= " OR ";
                                } else {
                                    $abfrage .= ")";
                                }
                            }
                            if ($i < (sizeof($suchwort) - 1)) {
                                $abfrage .= " AND ";
                            }
                        }
                    }

                    $host_name = "localhost";
                    $database = "42licious";
                    $user_name = "root";
                    $password = "";

                    $db = mysqli_connect($host_name, $user_name, $password, $database);


                    if (mysqli_connect_errno() == 0) {
                        if ($auswahl == "users") {
                            $sql = "SELECT * FROM `users` WHERE " . $abfrage;
                            $ergebnis = $db->query($sql);
                            if (is_object($ergebnis)) {
                                while ($zeile = $ergebnis->fetch_object()) {
                                    echo '<a href="profil_ansicht.php?id=' . $zeile->id . '">';
                                    echo '<div class="profil-preview">';
                                    echo '<div class="profil-preview-body">';
                                    echo '<div class="profil-preview-pic">';
                                    echo '<img alt="Profil-Bild" id="profil_bild" src=' . "$zeile->pic" . '>';
                                    echo '</div>';
                                    echo '<div class="profil-preview-info">';
                                    echo '<p>Name: ' . $zeile->vorname . " " . substr($zeile->nachname, 0, 1) . "." . '</p>';
                                    echo '<p>Nutzername: ' . $zeile->nickname . '</p>';
                                    echo '<br>';
                                    echo '<p>Mitglied seit: ' . $zeile->created_at . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</a>';
                                }

                            }
                        } else if($auswahl == "rezepte"){
                            $sql = "SELECT * FROM `rezepte` WHERE titel Like '%$suchwort%'";
                            $ergebnis = $db->query($sql);
                            if (is_object($ergebnis)) {
                                while ($zeile = $ergebnis->fetch_object()) {
                                    echo '<a href="rezeptAnsicht.php?id='.$zeile -> rid.'">';
                                    echo '<div class="recipe-preview-container">';
                                    echo '<div class="recipe-preview">';
                                    echo '<div class="recipe-preview-pic">';
                                    echo '<img alt="Rezept-Vorschau" class="recipe-pic" src="">';
                                    echo '</div>';
                                    echo '<div class="recipe-preview-info">';

                                    echo '<div class="kategorien">';
                                    $kategorie = explode(";", $zeile -> kategorienListe);

                                    for($i=0;$i<count($kategorie);$i++){
                                        if($kategorie[$i]=="fleisch"){
                                            echo '<div>Fleisch</div>';
                                        }elseif($kategorie[$i]=="vegetarisch"){
                                            echo '<div>Vegetarisch</div>';
                                        }elseif($kategorie[$i]=="vegan"){
                                            echo '<div>Vegan</div>';
                                        }}
                                    echo '</div>';
                                    echo '<div class="titleTime">';
                                    echo '<h2 class="recipe-preview-title">' . $zeile -> titel . '</h2>';
                                    echo '<p class="recipe-preview-timestamp">' . $zeile -> timestamp . '</p>';
                                    echo '</div>';
                                    echo 'Dauer: '.$zeile -> dauer.'<br/>';
                                    echo 'Schwierigkeit: '.$zeile -> schwierigkeit.'<br/><br/>';
                                    echo    nl2br($zeile -> beschreibung);
                                    echo '</p>';
                                    echo '</div>';

                                    echo '</div>';
                                    echo '</div>';
                                    echo '</a>';
                                }

                            }

                        }
                        else{
                            echo 'Bitte eine gültige Auswahl treffen!';
                        }
                    }
                    $db->close();
                }
                ?>
            </div>
            <div id="bottom-buttons">
                <button class="button" id="show-more">Mehr anzeigen</button>
            </div>

        </div>
    </div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="../jscript/profilPreview.js"></script>

</body>
</html>
