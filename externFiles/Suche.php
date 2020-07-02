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

                if (isset($_GET["selection"])) {
                    $auswahl = $_GET["selection"];
                }

                if (isset($_GET["suchbegriff"])) {
                    $suchwort = $_GET["suchbegriff"];

                    if (isset($_GET['order'])) {
                        if($_GET['order']=="created_at" || $_GET['order']=="cdate" ){
                        $selected = 'selected';
                        $selected2 = '';
                    } elseif($_GET['order']=="bewertung") {
                        $selected = '';
                        $selected2 = 'selected';
                    }else{
                        $selected = '';
                        $selected2 = '';
                    }}

                    echo '<div id="head-title">';
                    echo '<h1>Suchergebnisse für "' . $suchwort . '"</h1>';
                    echo ' </div>';

                    echo '<div id="top-buttons">';
                    echo '<div>';
                    echo '<label for="filter">Sortieren nach:</label>';
                    echo '<select id="filter" name="filter" onchange="location = this.value">';
                    echo '<option value="Suche.php?selection=' . $auswahl . '&suchbegriff=' . $suchwort . '">Name</option>';
                    if ($auswahl == 'users') {
                        echo '<option value="Suche.php?selection=' . $auswahl . '&suchbegriff=' . $suchwort . '&order=created_at" ' . $selected . '>Erstellungsdatum</option>';
                    } elseif ($auswahl == 'rezepte') {
                        echo '<option value="Suche.php?selection=' . $auswahl . '&suchbegriff=' . $suchwort . '&order=cdate" ' . $selected . '>Neuste</option>';
                        echo '<option value="Suche.php?selection=' . $auswahl . '&suchbegriff=' . $suchwort . '&order=bewertung" ' . $selected2 . '>Bewertung</option>';
                    }
                    echo '</select>';
                    echo '</div>';

                    echo '</div>';

                    echo '<div class="result">';

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
                            if (is_object($ergebnis)) {
                                while ($zeile = $ergebnis->fetch_object()) {
                                    echo '<a href="ProfilAnsicht.php?id=' . $zeile->id . '">';
                                    echo '<div class="profil-preview">';
                                    echo '<div class="profil-preview-body">';
                                    echo '<div class="profil-preview-pic">';
                                    echo '<img alt="Profil-Bild" id="profil_bild" src=' . "$zeile->pic" . '>';
                                    echo '</div>';
                                    echo '<div class="profil-preview-info">';
                                    echo '<p>Name: ' . $zeile->vorname . " " . substr($zeile->nachname, 0, 1) . "." . '</p>';
                                    echo '<p>Nutzername: ' . $zeile->nickname . '</p>';
                                    echo '<br>';
                                    echo '<p>Mitglied seit: ' . substr($zeile->created_at,0,10) . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</a>';
                                }

                            }
                            echo '</div>';
                        } else if ($auswahl == "rezepte") {

                            echo '<div class="recipe-container">';

                            if (isset($_GET['order'])) {
                                if ($_GET['order']=="cdate") {
                                    $order = $_GET['order'] . " DESC";
                                }else{
                                    $order = "gesamtBewertung DESC";
                                }
                            } else {
                                $order = 'titel';
                            }

                            $sql = "SELECT * FROM `rezepte` WHERE titel Like '%$suchwort%' ORDER BY $order";
                            $ergebnis = $db->query($sql);
                            if (is_object($ergebnis)) {
                                while ($zeile = $ergebnis->fetch_object()) {
                                    $bewertung = $zeile->gesamtBewertung;
                                    if($bewertung==0){
                                        $bewertung = "Keine Bewertungen";
                                    }elseif($bewertung==1){
                                        $bewertung.=" Stern";
                                    }else{
                                        $bewertung.=" Sterne";
                                    }
                                    echo '<a href="RezeptAnsicht.php?id=' . $zeile->rid . '">';
                                    echo '<div class="recipe-preview-container">';
                                    echo '<div class="recipe-preview">';
                                    echo '<div class="recipe-preview-pic">';
                                    echo '<img alt="Rezept-Vorschau" class="recipe-pic" src="">';
                                    echo '</div>';
                                    echo '<div class="recipe-preview-info">';

                                    echo '<div class="kategorien">';
                                    $kategorie = explode(";", $zeile->kategorienListe);

                                    for ($i = 0; $i < count($kategorie); $i++) {
                                        if ($kategorie[$i] == "fleisch") {
                                            echo '<div>Fleisch</div>';
                                        } elseif ($kategorie[$i] == "vegetarisch") {
                                            echo '<div>Vegetarisch</div>';
                                        } elseif ($kategorie[$i] == "vegan") {
                                            echo '<div>Vegan</div>';
                                        }
                                    }
                                    echo '</div>';
                                    echo '<div class="titleTime">';
                                    echo '<h2 class="recipe-preview-title">' . $zeile->titel . '</h2>';
                                    echo '<p class="recipe-preview-timestamp">' . substr($zeile->cdate,0,10) . '</p>';
                                    echo '</div>';
                                    $uid = $zeile->uid;
                                    $statement = $pdo->query("SELECT * FROM users WHERE id = '$uid'");
                                    $autor = $statement->fetch();
                                    $ersteller = $autor['nickname'];
                                    echo 'von: ' . $ersteller . '<br/><br/>';
                                    echo 'Bewertung: '.$bewertung.'<br/>';
                                    echo 'Dauer: ' . $zeile->dauer . ' Minuten<br/>';
                                    echo 'Schwierigkeit: ' . $zeile->schwierigkeit . '<br/><br/>';
                                    echo nl2br($zeile->beschreibung);
                                    echo '<br/><br/>';
                                    echo '</div>';

                                    echo '</div>';
                                    echo '</div>';
                                    echo '</a>';
                                }

                            }
                            echo '</div>';
                        } else {
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


<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<?php

if ($auswahl == 'users') {
    echo '<script src="../jscript/profilPreview.js"></script>';
} elseif ($auswahl == "rezepte") {
    echo '<script src = "../jscript/recipePreview.js" ></script>';
}
?>

</body>
</html>
