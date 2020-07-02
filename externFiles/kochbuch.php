<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

if(isset($_GET['nutzer'])){
    $nutzer= $_GET['nutzer'];
}
if($nutzer==0){

    include("AccNoSess.php");

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

    <?php include("Navigation.php"); ?>

    <div id="main">

        <div class="main-content">
        <div id="title">
            <h1>Kochbuch</h1>
        </div>

        <div id="kochbuchheader">
            <h3>Meine Rezepte | Meine Favoriten</h3>
        </div>
            <?php

        echo '<div id="top-buttons">';

            if (isset($_GET['order'])) {
                if($_GET['order']=="cdate" ){
                    $selected = 'selected';
                    $selected2 = '';
                } elseif($_GET['order']=="bewertung") {
                    $selected = '';
                    $selected2 = 'selected';
                }else{
                    $selected = '';
                    $selected2 = '';
                }}

            echo '<a href="RezeptErstellen.php"><button class="button">Rezept erstellen</button></a>';
            echo     '<label id="sortieren">Sortieren nach:';
            echo          '<select id="filter" name="filter" onchange="location = this.value">';
            echo              '<option value="Kochbuch.php?nutzer='.$nutzer.'">Neuste</option>';
            echo              '<option value="Kochbuch.php?nutzer='.$nutzer.'&order=titel" '.$selected.'>Name</option>';
            echo              '<option value="Kochbuch.php?nutzer='.$nutzer.'&order=bewertung" '.$selected2.'>Bewertung</option>';
            echo          '</select>';
            echo '</label>';
            echo '</div>';


            echo '<div class="recipies">';
            echo '<div class="recipe-container">';

            if (isset($_GET['order'])) {
                if ($_GET['order']=="titel") {
                    $order = $_GET['order'];
                }else{
                    $order = "gesamtBewertung DESC";
                }
            } else {
                $order = 'cdate DESC';
            }


                    $statement = $pdo->query("SELECT * FROM rezepte WHERE uid = '$nutzer' ORDER BY $order");
                    while($rezept = $statement->fetch()) {

                        $rezeptID= $rezept['rid'];
                        $title = $rezept['titel'];
                        $timestamp = $rezept['cdate'];
                        $pic = $rezept['pic'];
                        $kategorienListe = $rezept['kategorien'];
                        $dauer = $rezept['dauer'];
                        $schwierigkeit = $rezept['schwierigkeit'];
                        $beschreibung = $rezept['beschreibung'];
                        $bewertung = $rezept['gesamtBewertung'];
                        if($bewertung==0){
                            $bewertung = "Keine Bewertungen";
                        }elseif($bewertung==1){
                            $bewertung.=" Stern";
                        }else{
                            $bewertung.=" Sterne";
                        }

                        echo '<a href="RezeptAnsicht.php?id='.$rezeptID.'">';
                        echo '<div class="recipe-preview-container">';
                        echo '<div class="recipe-preview">';
                        echo '<div class="recipe-preview-pic">';
                        echo '<img alt="Rezept-Vorschau" class="recipe-pic" src="../images/rezepte/'.$pic.'">';
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
                        echo '<p class="recipe-preview-timestamp">' . substr($timestamp,0,10) . '</p>';
                        echo '</div>';
                        echo 'Bewertung: '.$bewertung.'<br/>';
                        echo 'Dauer: '.$dauer.' Minuten<br/>';
                        echo 'Schwierigkeit: '.$schwierigkeit.'<br/><br/>';
                        echo    nl2br($beschreibung);
                        echo '<br/><br/>';
                        echo '</div>';

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