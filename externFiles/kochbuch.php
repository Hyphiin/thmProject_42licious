<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

if(isset($_GET['nutzer'])){
    $nutzer= $_GET['nutzer'];
}
if($nutzer==0){

    include("nosess.php");

}else{
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-Kochbuch</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/suchergebnisse.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/rezept_css/rezeptPreview.css" rel="stylesheet" type="text/css">


</head>
<body>
<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">

        <div class="main-content">
        <div id="title">
            <h1>Kochbuch</h1>
        </div>

        <div id="kochbuchheader">
            <h3>Meine Rezepte | Meine Favoriten</h3>
        </div>

        <div id="top-buttons">

            <a href="rezeptErstellen.php"><button class="button">Rezept erstellen</button></a>
            <label id="sortieren">Sortieren nach:
                <select name="sortieren" size="1">
                    <option>Bewertung</option>
                    <option>Name</option>
                    <option>Einstelldatum</option>
                </select>
            </label>
        </div>


        <div class="recipies">
        <div class="recipe-container">

                    <?php
                    $statement = $pdo->query("SELECT * FROM rezepte WHERE uid = '$nutzer' ORDER BY rid DESC");
                    while($rezept = $statement->fetch()) {

                        $rezeptID= $rezept['rid'];
                        $title = $rezept['titel'];
                        $timestamp = $rezept['cdate'];
                        $kategorienListe = $rezept['kategorien'];
                        $dauer = $rezept['dauer'];
                        $schwierigkeit = $rezept['schwierigkeit'];
                        $beschreibung = $rezept['beschreibung'];

                        echo '<a href="rezeptAnsicht.php?id='.$rezeptID.'">';
                        echo '<div class="recipe-preview">';
                        echo '<div class="recipe-preview-pic">';
                        echo '<img alt="Rezept-Vorschau" class="recipe-pic" src="">';
                        echo '</div>';
                        echo '<div class="recipe-preview-info">';
                        echo '<div class="kategorien">';
                        $kategorie = explode(";", $kategorienListe);

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
                        echo '<h2 class="recipe-preview-title">' . $title . '</h2>';
                        echo '<p class="recipe-preview-timestamp">' . $timestamp . '</p>';
                        echo '</div>';
                        echo 'Dauer: '.$dauer.'<br/>';
                        echo 'Schwierigkeit: '.$schwierigkeit.'<br/><br/>';
                        echo    nl2br($beschreibung);
                        echo '</p>';
                        echo '</div>';

                        echo '</div>';
                        echo '</a>';
                    }
                    ?>

        </div>
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
<?php
}
    ?>