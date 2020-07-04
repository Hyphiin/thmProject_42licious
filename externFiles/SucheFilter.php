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

                if (isset($_POST["fleisch"]) or isset($_POST["vegetarisch"]) or isset($_POST["vegan"])) {
                    $special = true;
                    $kategorien = true;
                }

                if ($_POST["zeit"] == "") {
                    $zeit = 9999;
                } else {
                    $zeit = $_POST["zeit"];
                    $special = true;
                }

                if ($_POST["schwierigkeit"] == "Auswahl") {
                    $schwierigkeit = "";
                } else {
                    $schwierigkeit = $_POST["schwierigkeit"];
                    $special = true;
                }

                if (isset($_POST['suchbegriff'])) {
                    $suchwort = $_POST['suchbegriff'];
                } else {
                    $suchwort = "";
                }

                if ($_POST['zutat'] == "Auswahl") {
                    $zutat = "%%";
                } else {
                    $zutat = $_POST['zutat'];
                    $special = true;
                }

                if ($_POST['zutat2'] == "Auswahl") {
                    $zutat2 = "%%";
                } else {
                    $zutat2 = $_POST['zutat2'];
                    $special = true;
                }

                if (isset($_POST['order'])) {
                    if ($_POST['order'] == "cdate") {
                        $selected = 'selected';
                        $selected2 = '';
                    } elseif ($_POST['order'] == "bewertung") {
                        $selected = '';
                        $selected2 = 'selected';
                    } else {
                        $selected = '';
                        $selected2 = '';
                    }
                }

                if (isset($_POST['order'])) {
                    if ($_POST['order'] == "cdate") {
                        $order = $_POST['order'] . " DESC";
                    } elseif ($_POST['order'] == "bewertung") {
                        $order = "gesamtBewertung DESC";
                    } else {
                        $order = 'titel';
                    }
                } else {
                    $order = 'titel';
                }

                if ($special) {
                    if ($kategorien) {
                        if (isset($_POST['fleisch'])) {
                            if (isset($_POST['vegetarisch'])) {
                                if (isset($_POST['vegan'])) {
                                    $suchkategorie = "'%%'";
                                } else {
                                    $suchkategorie = "'fleisch;' OR kategorien LIKE 'vegetarisch;'";
                                }
                            } elseif (isset($_POST['vegan'])) {
                                $suchkategorie = "'%%'";
                            } else {
                                $suchkategorie = "'fleisch;'";
                            }
                        } elseif (isset($_POST['vegetarisch'])) {
                            if (isset($_POST['vegan'])) {
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

                echo '<div id="head-title">';
                echo '<h1>' . $suchergebnisse[0] . ' Suchergebnisse für "' . $suchwort . '"</h1>';
                echo '</div>';

                echo '<div id="top-buttons">';
                echo '<div>';
                echo '<label for="filter">Sortieren nach:</label>';
                echo '<form id="reOrder" action="SucheFilter.php?order" method="post">';
                if (isset($_POST['fleisch'])) {
                    echo '<input type="hidden" name="fleisch" value="' . $_POST['fleisch'] . '">';
                };
                if (isset($_POST['vegetarisch'])) {
                    echo '<input type="hidden" name="vegetarisch" value="' . $_POST['vegetarisch'] . '">';
                };
                if (isset($_POST['vegan'])) {
                    echo '<input type="hidden" name="vegan" value="' . $_POST['vegan'] . '">';
                };
                if (isset($_POST['zeit'])) {
                    echo '<input type="hidden" name="zeit" value="' . $_POST['zeit'] . '">';
                };
                if (isset($_POST['schwierigkeit'])) {
                    echo '<input type="hidden" name="schwierigkeit" value="' . $_POST['schwierigkeit'] . '">';
                };
                if (isset($_POST['suchbegriff'])) {
                    echo '<input type="hidden" name="suchbegriff" value="' . $_POST['suchbegriff'] . '">';
                };
                if (isset($_POST['zutat'])) {
                    echo '<input type="hidden" name="zutat" value="' . $_POST['zutat'] . '">';
                };
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

                while ($rezept = $statement1->fetch()) {
                    include('RezeptPreview.php');
                }

                ?>


            </div>
            <div id="bottom-buttons">
                <button class="button" id="show-more">Mehr anzeigen</button>
            </div>

        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="../jscript/recipePreview.js"></script>


</body>
</html>