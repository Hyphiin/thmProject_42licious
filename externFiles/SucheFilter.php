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

    <?php include("Navigation.php"); ?>

    <div id="main">

        <div class="main-content">

            <div class="search-list">
                <?php

                if (isset($_GET["fleisch"]) or isset($_GET["vegetarisch"]) or isset($_GET["vegan"])) {
                    $special = true;
                    $kategorien = true;
                }

                if ($_GET["zeit"] == "") {
                    $zeit = 9999;
                } else {
                    $zeit = $_GET["zeit"];
                    $special = true;
                }

                if ($_GET["schwierigkeit"] == "Auswahl") {
                    $schwierigkeit = "";
                } else {
                    $schwierigkeit = $_GET["schwierigkeit"];
                    $special = true;
                    if ($schwierigkeit=="leicht"){
                        $schwierigkeit="leicht";
                    }elseif ($schwierigkeit=="mittel"){
                        $schwierigkeit="leicht%' OR schwierigkeit LIKE '%mittel";
                    }elseif ($schwierigkeit=="schwer"){
                        $schwierigkeit="leicht%' OR schwierigkeit LIKE '%mittel%' OR schwierigkeit LIKE '%schwer%' AND schwierigkeit NOT LIKE '%sehr schwer";
                    }else{
                        $schwierigkeit="";
                    }
                }

                if (isset($_GET['suchbegriff'])) {
                    $suchwort = $_GET['suchbegriff'];
                } else {
                    $suchwort = "";
                }

                if ($_GET['zutat'] == "Auswahl") {
                    $zutat = "%%";
                } else {
                    $zutat = $_GET['zutat'];
                    $special = true;
                }

                if ($_GET['zutat2'] == "Auswahl") {
                    $zutat2 = "%%";
                } else {
                    $zutat2 = $_GET['zutat2'];
                    $special = true;
                }

                if (isset($_GET['order'])) {
                    if ($_GET['order'] == "cdate") {
                        $selected = 'selected';
                        $selected2 = '';
                    } elseif ($_GET['order'] == "bewertung") {
                        $selected = '';
                        $selected2 = 'selected';
                    } else {
                        $selected = '';
                        $selected2 = '';
                    }
                }

                if (isset($_GET['order'])) {
                    if ($_GET['order'] == "cdate") {
                        $order = $_GET['order'] . " DESC";
                    } elseif ($_GET['order'] == "bewertung") {
                        $order = "gesamtBewertung DESC";
                    } else {
                        $order = 'titel';
                    }
                } else {
                    $order = 'titel';
                }

                if ($special) {
                    if ($kategorien) {
                        if (isset($_GET['fleisch'])) {
                            if (isset($_GET['vegetarisch'])) {
                                if (isset($_GET['vegan'])) {
                                    $suchkategorie = "'%%'";
                                } else {
                                    $suchkategorie = "'fleisch;' OR kategorien LIKE 'vegetarisch;'";
                                }
                            } elseif (isset($_GET['vegan'])) {
                                $suchkategorie = "'%%'";
                            } else {
                                $suchkategorie = "'fleisch;'";
                            }
                        } elseif (isset($_GET['vegetarisch'])) {
                            if (isset($_GET['vegan'])) {
                                $suchkategorie = "'vegetarisch;' OR kategorien LIKE 'vegetarisch;vegan%'";
                            } else {
                                $suchkategorie = "'vegetarisch;'";
                            }
                        } else {
                            $suchkategorie = "'vegetarisch;vegan;'";
                        }
                        $statement1 = $pdo->query("SELECT * FROM `rezepte` WHERE titel Like '%$suchwort%' AND dauer <= $zeit AND (schwierigkeit LIKE '%$schwierigkeit%') AND (kategorien LIKE $suchkategorie) AND (zutatenListe LIKE '%$zutat%') AND (zutatenListe LIKE '%$zutat2%') ORDER BY $order");
                        $anzahlErgebnisse = $pdo->query("SELECT COUNT(*) FROM `rezepte` WHERE titel Like '%$suchwort%' AND dauer <= $zeit AND (schwierigkeit LIKE '%$schwierigkeit%') AND (kategorien LIKE $suchkategorie) AND (zutatenListe LIKE '%$zutat%') AND (zutatenListe LIKE '%$zutat2%') ORDER BY $order");
                    } else {
                        $statement1 = $pdo->query("SELECT * FROM `rezepte` WHERE titel Like '%$suchwort%' AND dauer <= $zeit AND (schwierigkeit LIKE '%$schwierigkeit%') AND (zutatenListe LIKE '%$zutat%') AND (zutatenListe LIKE '%$zutat2%') ORDER BY $order");
                        $anzahlErgebnisse = $pdo->query("SELECT COUNT(*) FROM `rezepte` WHERE titel Like '%$suchwort%' AND dauer <= $zeit AND (schwierigkeit LIKE '%$schwierigkeit%') AND (zutatenListe LIKE '%$zutat%') AND (zutatenListe LIKE '%$zutat2%') ORDER BY $order");
                    }
                } else {
                    $statement1 = $pdo->query("SELECT * FROM `rezepte` WHERE titel Like '%$suchwort%' ORDER BY $order");
                    $anzahlErgebnisse = $pdo->query("SELECT COUNT(*) FROM `rezepte` WHERE titel Like '%$suchwort%' ORDER BY $order");
                }
                $suchergebnisse = $anzahlErgebnisse->fetch();
                if ($suchergebnisse[0]==1){
                    $suchergebnisseTitel = "1 Suchergebnis";
                }else{
                    $suchergebnisseTitel = "$suchergebnisse[0] Suchergebnisse";
                }

                echo '<div id="head-title">';
                echo '<h1>' . $suchergebnisseTitel . ' für "' . $suchwort . '"</h1>';
                echo '</div>';

                echo '<div id="top-buttons">';
                echo '<div>';
                echo '<label for="filter">Sortieren nach:</label>';
                echo '<form id="reOrder" action="SucheFilter.php?order" method="get">';
                if (isset($_GET['fleisch'])) {
                    echo '<input type="hidden" name="fleisch" value="' . $_GET['fleisch'] . '">';
                }
                if (isset($_GET['vegetarisch'])) {
                    echo '<input type="hidden" name="vegetarisch" value="' . $_GET['vegetarisch'] . '">';
                }
                if (isset($_GET['vegan'])) {
                    echo '<input type="hidden" name="vegan" value="' . $_GET['vegan'] . '">';
                }
                if (isset($_GET['zeit'])) {
                    echo '<input type="hidden" name="zeit" value="' . $_GET['zeit'] . '">';
                }
                if (isset($_GET['schwierigkeit'])) {
                    echo '<input type="hidden" name="schwierigkeit" value="' . $_GET['schwierigkeit'] . '">';
                }
                if (isset($_GET['suchbegriff'])) {
                    echo '<input type="hidden" name="suchbegriff" value="' . $_GET['suchbegriff'] . '">';
                }
                if (isset($_GET['zutat'])) {
                    echo '<input type="hidden" name="zutat" value="' . $_GET['zutat'] . '">';
                }
                echo '<input type="hidden" name="order" value="">';
                echo '<select id="filter" name="order" onchange="this.form.submit()">';
                echo '<option value="">Name</option>';
                echo '<option value="cdate" ' . $selected . '>Neueste</option>';
                echo '<option value="bewertung" ' . $selected2 . '>Bewertung</option>';
                echo '</select>';
                echo '</form>';
                echo '</div>';

                echo '</div>';

                echo '<div class="result">';
                echo '<div class="recipe-container">';

                $entryCounter = 0;
                while ($rezept = $statement1->fetch()) {
                    include('RezeptPreview.php');
                    $entryCounter++;
                }

                if ($entryCounter==0){
                    echo '<p id="noEntries">Keine passenden Rezepte gefunden</p>';
                }




            echo '</div>';

                if ($entryCounter>3) {
                    echo '<div id="bottom-buttons">';
                    echo '<button class="button" id="show-more">Mehr anzeigen</button>';
                    echo '</div>';
                }
?>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="../jscript/recipePreview.js"></script>


</body>
</html>