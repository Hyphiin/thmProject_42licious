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

    <title>42licious - Rezeptliste</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/profil_css/profil_rezept.css" rel="stylesheet" type="text/css">
    <link href="../css/rezept_css/rezeptPreview.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("Navigation.php"); ?>

    <div id="main">

        <div class="main-content">

            <div id="top-buttons">

            <a href="javascript:history.back()">
                <button class="button">Zurück</button>
            </a>

            </div>

            <?php
            $entryCounter = 0;
            $statement = $pdo->query("SELECT * FROM users WHERE id = '$nutzer' ");
            $rezeptAuthor = $statement->fetch();

            $authorName = $rezeptAuthor['nickname'];

            echo '<div id="profil_rezept-title">';
            echo '<h1>Rezepte von <a href="ProfilAnsicht.php?id=' . $nutzer . '">' . $authorName . '</a></h1>';
            echo '</div>';

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

                echo '<div class="sortierung">';
                echo '<label for="sortieren">Sortieren nach </label>';
                echo '<select id="filter" name="filter" onchange="location = this.value">';
                echo '<option value="ProfilRezept.php?nutzer=' . $nutzer . '">Name</option>';
                echo '<option value="ProfilRezept.php?nutzer=' . $nutzer . '&order=cdate" ' . $selected . '>Neuste</option>';
                echo '<option value="ProfilRezept.php?nutzer=' . $nutzer . '&order=bewertung" ' . $selected2 . '>Bewertung</option>';
                echo '</select>';
                echo '</div>';

                echo '<div class="recipies">';
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

                $statement2 = $pdo->query("SELECT * FROM rezepte WHERE uid = '$nutzer' ORDER BY $order");
                while ($rezept = $statement2->fetch()) {

                    include('RezeptPreview.php');
                    $entryCounter++;
                }
                if($entryCounter==0){
                    echo '<br/><br/>';
                    echo '<p id="noEntries">Keine Rezepte vorhanden</p>';
                }
            }
            ?>
        </div>
    </div>
    <?php
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
<script>
    gsap.from("#main",{y:20});
</script>

</body>
</html>
