<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];


?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>42licious-RezeptAnsicht</title>

    <link href="../css/rezept_css/rezeptAnsicht.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/general.css" rel="stylesheet" type="text/css">



</head>
<body>
<div id="website">

    <?php include("navigation.php");

    if(isset($_GET['id'])){
        $rezeptID= $_GET['id'];
    }

    $statement = $pdo->query("SELECT * FROM rezepte WHERE rid = '1' ");
    $rezept = $statement->fetch();

    $titel = $rezept['titel'];
    $timestamp = $rezept['cdate'];
    $uid = $rezept['uid'];
    $pic = $rezept['pic'];
    $dauer = $rezept['dauer'];
    $schwierigkeit = $rezept['schwierigkeit'];
    $kategorienListe = $rezept['kategorien'];
    $beschreibung = $rezept['beschreibung'];
    $personen = $rezept['personen'];
    $zutatenListe = $rezept['zutatenListe'];
    $anleitung = $rezept['anleitung'];

    $statement2 = $pdo->query("SELECT * FROM users WHERE id = '$uid' ");
    $autor = $statement2->fetch();
    $ersteller = $autor['nickname'];

    $zutatenTable = explode(";", $zutatenListe);

    echo '<div id="main">

        <div id="top-buttons">

            <a href="rezepteSuchen.php"><button class="button">Zurück zur Suche</button></a>
            <a href="rezeptBearbeiten.php"><button class="button">Bearbeiten</button></a>

        </div>

        <div id="main-content">

            <div id="recipe-info">
                <div class="recipe-title">
                    <h1>'.$titel.'</h1>
                    <a href="profil_ansicht.php?id='.$uid.'"><h5>von: '.$ersteller.'</h5></a>
                </div>
                
                <div class="kategorien">';
                    $kategorie = explode(";", $kategorienListe);

    for($i=0;$i<count($kategorie);$i++){
        if($kategorie[$i]=="fleisch"){
            echo '<div>Fleisch</div>';
        }elseif($kategorie[$i]=="vegetarisch"){
            echo '<div>Vegetarisch</div>';
        }elseif($kategorie[$i]=="vegan"){
            echo '<div>Vegan</div>';
        }};


                echo '</div>
                
                <div id="timestamp">
                    <p>erstellt : '.$timestamp.'</p>
                </div>
            </div>

            <div class="recipe-preview">
                <diV class="recipe-preview-image-container">
                    <img alt="Rezept-Vorschaubild" id="rezept-vorschaubild" src='."".'> 
                </diV>
                <div class="recipe-preview-description"></div>
            </div>

            <div id="recipe-rating">

                <div id="stars">
                    <p class="sternebewertung">
                        <input type="radio" id="stern5" name="bewertung" value="5"><label for="stern5" title="5 Sterne">5 Sterne</label>
                        <input type="radio" id="stern4" name="bewertung" value="4"><label for="stern4" title="4 Sterne">4 Sterne</label>
                        <input type="radio" id="stern3" name="bewertung" value="3"><label for="stern3" title="3 Sterne">3 Sterne</label>
                        <input type="radio" id="stern2" name="bewertung" value="2"><label for="stern2" title="2 Sterne">2 Sterne</label>
                        <input type="radio" id="stern1" name="bewertung" value="1"><label for="stern1" title="1 Stern">1 Stern</label>
                        <span id="Bewertung" title="Keine Bewertung">
                        Bewertung:
                        </span>
                    </p>

                </div>

                <div id="like">
                    <p class="merken">
                        <input type="radio" id="like" name="like" value="like"><label for="like" title="Rezept merken"></label>
                        <span id="Merken">
                        Merken:
                        </span>
                    </p>
                </div>

            </div>

            <div id="dauer">Dauer: '.$dauer.'</div>
            <div id="schwierigkeit">Schwierigkeit: '.$schwierigkeit.'</div><br/>

        <div id="beschreibung">
        <h3>Beschreibung:</h3>
                '.nl2br($beschreibung).'
            </div><br/>


        <div id="zutaten">
            <h3>Zutaten für '.$personen.' Personen</h3>';




    echo '<div id="table">';
        echo  '<table style="width:100%">';

            for($i=0;$i<count($zutatenTable);$i++){
            $zutatenSpalte = explode(":", $zutatenTable[$i]);
            echo '<tr>';
                echo     '<td>'.$zutatenSpalte[0].'</td>';
                echo    '<td>'.$zutatenSpalte[1].'</td>';
                echo '</tr>';
            }

            echo   '</table>';
        echo '</div><br/>';


            echo   '<h3>Zubereitung</h3><br/>
                     <div id="zubereitung">
                         '.nl2br($anleitung).'
                     </div>
                    </div><br/>';
        ?>

        <div id="comments">
            <h3>Kommentare</h3>
            <a href="kommentar_schreiben.php"><button class="button">Kommentar schreiben</button></a>
        </div>
</div>


</body>
</html>
