<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

if (isset($_GET['nutzer'])) {
    $nutzer = $_GET['nutzer'];
}
if ($nutzer == 0){

    include("AccNoSess.php");

}else{
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>42licious-Kochbuch</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/suchergebnisse.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/rezept_css/rezeptPreview.css" rel="stylesheet" type="text/css">


</head>
<body>
<div id="website">

    <?php include("Navigation.php");

    if ($sess == $nutzer){
    ?>

    <div id="main">

        <div class="main-content">

            <?php
            if (isset($_GET['fav'])) {
                $header = "Favoriten";
            } else {
                $header = "Eigene Rezepte";
            }
            $entryCount = 0;

            echo '<div id="title">';
            echo '<h1>Kochbuch - ' . $header . '</h1>';
            echo '</div>';


            echo '<div id="kochbuchheader">';
            echo '<h3><a href="kochbuch.php?nutzer=' . $sess . '">Meine Rezepte</a> | <a href="kochbuch.php?fav&nutzer=' . $sess . '">Meine Favoriten ♥</a></h3>';
            echo '</div>';


            echo '<div id="top-buttons">';

            if (isset($_GET['order'])) {
                if ($_GET['order'] == "titel") {
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

            echo '<a href="RezeptErstellen.php"><button class="button">Rezept erstellen</button></a>';
            echo '<label id="sortieren">Sortieren nach:';
            echo '<select id="filter" name="filter" onchange="location = this.value">';
            if (isset($_GET['fav'])) {
                echo '<option value="Kochbuch.php?fav&nutzer=' . $nutzer . '">Neuste</option>';
                echo '<option value="Kochbuch.php?fav&nutzer=' . $nutzer . '&order=titel" ' . $selected . '>Name</option>';
                echo '<option value="Kochbuch.php?fav&nutzer=' . $nutzer . '&order=bewertung" ' . $selected2 . '>Bewertung</option>';
            } else {
                echo '<option value="Kochbuch.php?nutzer=' . $nutzer . '">Neuste</option>';
                echo '<option value="Kochbuch.php?nutzer=' . $nutzer . '&order=titel" ' . $selected . '>Name</option>';
                echo '<option value="Kochbuch.php?nutzer=' . $nutzer . '&order=bewertung" ' . $selected2 . '>Bewertung</option>';
            }
            echo '</select>';
            echo '</label>';
            echo '</div>';


            echo '<div class="recipies">';
            echo '<div class="recipe-container">';

            if (isset($_GET['order'])) {
                if ($_GET['order'] == "titel") {
                    $order = $_GET['order'];
                } else {
                    $order = "gesamtBewertung DESC";
                }
            } else {
                $order = 'cdate DESC';
            }

            if (isset($_GET['fav'])) {

                $statement1 = $pdo->query("SELECT favRezepte FROM users WHERE id = '$sess' ");
                $favorites = $statement1->fetch();
                if (!empty($favorites[0])) {
                    $statement2 = $pdo->query("SELECT * FROM rezepte WHERE rid IN ($favorites[0]) ORDER BY $order");
                    while ($rezept = $statement2->fetch()) {

                        include('RezeptPreview.php');
                        $entryCount++;
                    }
                } else {
                    echo '<div id="noFav">';
                    echo 'Keine Favoriten gespeichert.';
                    echo '</div>';
                }
            } else {

                $statement3 = $pdo->query("SELECT * FROM rezepte WHERE uid = '$nutzer' ORDER BY $order");
                while ($rezept = $statement3->fetch()) {

                    include('RezeptPreview.php');
                    $entryCount++;
                }
            }


            echo '</div>';
            echo '</div>';

            if ($entryCount>3) {
                echo '<div id="bottom-buttons">';
                echo '<button class="button" id="show-more">Mehr anzeigen</button>';
                echo '</div>';
            }

            echo '</div>';

            ?>


            <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
            <script src="../jscript/recipePreview.js"></script>
            <?php
            } else {
                echo '<div id="main">
            <p>Es ist ein Fehler aufgetreten</p>
            <a href="index.php"><button type="button" class="button">Zurück zur Starseite</button></a>
           </div>';

            }
            }
            ?>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
            <script>
                gsap.from("#main", {y: 10});
            </script>

</body>
</html>
