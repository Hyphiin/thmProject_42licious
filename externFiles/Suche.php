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

    <title>42licious - Suchergebnisse</title>
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

                // Suchkategorie, Suchwort und Sortierung auslesen

                if (isset($_GET["selection"])) {
                    $auswahl = $_GET["selection"];
                }

                if (isset($_GET["suchbegriff"])) {
                    $suchwort = $_GET["suchbegriff"];
                    $suchwortTitel = $suchwort;
                }


                if (isset($_GET['order'])) {
                    if ($_GET['order'] == "created_at" || $_GET['order'] == "cdate") {
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

                // Nutzersuche

                if ($auswahl == 'users') {
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

                $entryCounter = 0;

                if (mysqli_connect_errno() == 0) {
                    if ($auswahl == "users") {

                        echo '<div class="users">';

                        if (isset($_GET['order'])) {
                            $order = $_GET['order'];
                        } else {
                            $order = 'nickname';
                        }

                        $sql = "SELECT * FROM `users` WHERE $abfrage ORDER BY $order";
                        $ergebnis = $db->query($sql);

                        $statement1 = $pdo->query("SELECT * FROM `users` WHERE $abfrage ORDER BY $order");
                        $anzahlErgebnisse = $pdo->query("SELECT COUNT(*) FROM `users` WHERE $abfrage ORDER BY $order");

                        $suchergebnisse = $anzahlErgebnisse->fetch();
                        if ($suchergebnisse[0] == 1) {
                            $suchergebnisseTitel = "1 Suchergebnis";
                        } else {
                            $suchergebnisseTitel = "$suchergebnisse[0] Suchergebnisse";
                        }

                        echo '<div id="head-title">';
                        echo '<h1>' . $suchergebnisseTitel . ' für "' . $suchwortTitel . '"</h1>';
                        echo '</div>';

                        echo '<div id="top-buttons">';
                        echo '<div>';
                        echo '<label for="filter">Sortieren nach:</label>';
                        echo '<select id="filter" name="filter" onchange="location = this.value">';
                        echo '<option value="Suche.php?selection=' . $auswahl . '&suchbegriff=' . $suchwortTitel . '">Name</option>';
                        echo '<option value="Suche.php?selection=' . $auswahl . '&suchbegriff=' . $suchwortTitel . '&order=created_at" ' . $selected . '>Erstellungsdatum</option>';
                        echo '</select>';
                        echo '</div>';

                        echo '</div>';

                        echo '<div class="result">';


                        while ($nutzer = $statement1->fetch()) {

                            $id = $nutzer['id'];
                            $pic = $nutzer['pic'];
                            $vorname = $nutzer['vorname'];
                            $nachname = $nutzer['nachname'];
                            $nickname = $nutzer['nickname'];
                            $created = $nutzer['created_at'];

                            echo '<a href="ProfilAnsicht.php?id=' . $id . '">';
                            echo '<div class="profil-preview">';
                            echo '<div class="profil-preview-body">';
                            echo '<div class="profil-preview-pic">';
                            echo "<img alt='Profil-Bild' id='profil_bild' src='../images/profile/$pic'>";
                            echo '</div>';
                            echo '<div class="profil-preview-info">';
                            echo '<p>Name: ' . $vorname . " " . substr($nachname, 0, 1) . "." . '</p>';
                            echo '<p>Nutzername: ' . $nickname . '</p>';
                            echo '<br>';
                            echo '<p>Mitglied seit: ' . substr($created, 0, 10) . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';

                            $entryCounter++;
                        }
                        if ($entryCounter == 0) {
                            echo '<p id="noEntries">Keine passenden Nutzer gefunden</p>';
                        }

                        echo '</div>';
                    } else if ($auswahl == "rezepte") {

                        // Rezeptsuche

                        echo '<div class="recipe-container">';

                        if (isset($_GET['order'])) {
                            if ($_GET['order'] == "cdate") {
                                $order = $_GET['order'] . " DESC";
                            } else {
                                $order = "gesamtBewertung DESC";
                            }
                        } else {
                            $order = 'titel';
                        }

                        $statement1 = $pdo->query("SELECT * FROM `rezepte` WHERE titel Like '%$suchwort%' ORDER BY $order");
                        $anzahlErgebnisse = $pdo->query("SELECT COUNT(*) FROM `rezepte` WHERE titel Like '%$suchwort%' ORDER BY $order");

                        $suchergebnisse = $anzahlErgebnisse->fetch();

                        echo '<div id="head-title">';
                        echo '<h1>' . $suchergebnisse[0] . ' Suchergebnisse für "' . $suchwortTitel . '"</h1>';
                        echo '</div>';

                        echo '<div id="top-buttons">';
                        echo '<div>';
                        echo '<label for="filter">Sortieren nach:</label>';
                        echo '<select id="filter" name="filter" onchange="location = this.value">';
                        echo '<option value="Suche.php?selection=' . $auswahl . '&suchbegriff=' . $suchwort . '">Name</option>';
                        echo '<option value="Suche.php?selection=' . $auswahl . '&suchbegriff=' . $suchwort . '&order=cdate" ' . $selected . '>Neuste</option>';
                        echo '<option value="Suche.php?selection=' . $auswahl . '&suchbegriff=' . $suchwort . '&order=bewertung" ' . $selected2 . '>Bewertung</option>';
                        echo '</select>';
                        echo '</div>';

                        echo '</div>';

                        echo '<div class="result">';

                        while ($rezept = $statement1->fetch()) {
                            include('RezeptPreview.php');
                            $entryCounter++;
                        }
                        if ($entryCounter == 0) {
                            echo '<p id="noEntries">Keine passenden Rezepte gefunden</p>';
                        }


                    } else {
                        echo 'Bitte eine gültige Auswahl treffen!';
                    }
                }
                $db->close();


                echo '</div>';

                if ($entryCounter > 3) {
                    echo '<div id="bottom-buttons">';
                    echo '<button class="button" id="show-more">Mehr anzeigen</button>';
                    echo '</div>';
                }

                ?>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <?php

    if ($auswahl == 'users') {
        echo '<script src="../jscript/profilPreview.js"></script>';
    } elseif ($auswahl == "rezepte") {
        echo '<script src = "../jscript/recipePreview.js" ></script>';
    }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
    <script>
        gsap.from(".main-content", {y: 20});
    </script>

</body>
</html>
