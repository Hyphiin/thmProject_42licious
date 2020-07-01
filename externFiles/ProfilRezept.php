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
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>42licious-Profil-Rezeptansicht</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/profil_css/profil_rezept.css" rel="stylesheet" type="text/css">
    <link href="../css/rezept_css/rezeptPreview.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("Navigation.php"); ?>

    <div id="main">

        <div id="top-buttons">

            <a href="javascript:history.back()"><button class="button">Zurück</button></a>

        </div>

        <div class="main-content">

            <?php
            $statement = $pdo->query("SELECT * FROM users WHERE id = '$nutzer' ");
            $rezeptAuthor = $statement->fetch();

            $authorName = $rezeptAuthor['nickname'];

            echo '<div id="profil_rezept-title">';
            echo    '<h1>Rezepte von '.$authorName.'</h1>';
            echo '</div>';

            if (isset($_GET['order'])){
                $selected = 'selected';
            }else{
                $selected = '';
            }

            echo '<div class="sortierung">';
            echo '<label for="sortieren">Sortieren nach </label>';
            echo          '<select id="filter" name="filter" onchange="location = this.value">';
            echo              '<option value="ProfilRezept.php?nutzer='.$nutzer.'">Name</option>';
            echo              '<option value="ProfilRezept.php?nutzer='.$nutzer.'&order=cdate" '.$selected.'>Neuste</option>';
            echo          '</select>';
            echo '</div>';

            echo '<div class="recipies">';
            echo '<div class="recipe-container">';

            if(isset($_GET['order'])){
                $order = $_GET['order']." DESC";
            }else{
                $order = 'titel';
            }

                $statement2 = $pdo->query("SELECT * FROM rezepte WHERE uid = '$nutzer' ORDER BY $order");
                while($rezept = $statement2->fetch()) {

                    $rezeptID= $rezept['rid'];
                    $title = $rezept['titel'];
                    $timestamp = $rezept['cdate'];
                    $kategorienListe = $rezept['kategorien'];
                    $dauer = $rezept['dauer'];
                    $schwierigkeit = $rezept['schwierigkeit'];
                    $beschreibung = $rezept['beschreibung'];

                    echo '<a href="RezeptAnsicht.php?id='.$rezeptID.'">';
                    echo '<div class="recipe-preview-container">';
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
                    echo '</div>';
                    echo '</a>';
                }
                }
                ?>
            </div>
            </div>
            <div id="bottom-buttons">
                <button class="button" id="show-more">Mehr anzeigen</button>
            </div>        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="../jscript/recipePreview.js"></script>
</body>
</html>
