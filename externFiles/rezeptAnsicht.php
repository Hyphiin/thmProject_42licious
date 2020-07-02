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
    <title>42licious-RezeptAnsicht</title>

    <link href="../css/rezept_css/rezeptAnsicht.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/kommentare_css/kommentar.css" rel="stylesheet" type="text/css">


</head>
<body>
<div id="website">

    <?php include("navigation.php");

    if (isset($_GET['comment'])) {
        $rid = $_POST['rid'];
        $message = $_POST['message'];


        $statement1 = $pdo->prepare("INSERT INTO recipecomments (rid, uid, message) VALUES (:rid, :uid ,:message)");
        $result = $statement1->execute(array('rid' => $rid, 'uid' => $sess, 'message' => $message));

    }

    if (isset($_GET['delete'])) {
        $cid = $_POST['cid'];

        $sql = "DELETE FROM recipecomments WHERE cid = '$cid'";
        $update = $pdo->prepare($sql);
        $update->execute();
    }

    if (isset($_GET['id'])) {
        $rezeptID = $_GET['id'];
    }



    $statement = $pdo->query("SELECT * FROM rezepte WHERE rid = '$rezeptID' ");
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

    if ($sess) {
        if (isset($_POST['bewertung'])) {
            if ($sess != $uid) {
                $fetch = $pdo->query("SELECT COUNT(*) FROM bewertung WHERE BNutzer = '$sess' AND rezeptID = '$rezeptID'");
                $bewertungscheck = $fetch->fetch();
                $bewertung = $_POST['bewertung'];
                if ($bewertungscheck[0] == 0) {
                    $statement5 = $pdo->prepare("INSERT INTO bewertung (rezeptID, BSterne, BNutzer) VALUES(:rezeptid, :bsterne, :bnutzer)");
                    $ergebnis = $statement5->execute(array('rezeptid' => $rezeptID, 'bsterne' => $bewertung, 'bnutzer' => $sess));
                } elseif ($bewertungscheck[0] != 0) {
                    $statement6 = $pdo->query("UPDATE bewertung SET BSterne = '$bewertung' WHERE BNutzer = '$sess' AND rezeptID = '$rezeptID'");
                }
            }
        }
    }

    echo '<div id="main">

        <div id="top-buttons">

            <a href="javascript:history.back()"><button class="button">Zurück</button></a>';
    if ($sess == $uid) {
        echo '<form action="rezeptBearbeiten.php?bearbeiten" method="post">';
        echo '<input type="hidden" name="id" value="' . $rezeptID . '">';
        echo '<button type="submit" class="button">Bearbeiten</button>';
        echo '</form>';
    }
    echo '</div>

        <div class="main-content">
        
        <div class="kategorien">';

    $kategorie = explode(";", $kategorienListe);

    for ($i = 0; $i < count($kategorie); $i++) {
        if ($kategorie[$i] == "fleisch") {
            echo '<div>Fleisch</div>';
        } elseif ($kategorie[$i] == "vegetarisch") {
            echo '<div>Vegetarisch</div>';
        } elseif ($kategorie[$i] == "vegan") {
            echo '<div>Vegan</div>';
        }
    };


    echo '</div>

            <div id="recipe-info">
                <div class="recipe-title">
                    <h1>' . $titel . '</h1>
                    <a href="profil_ansicht.php?id=' . $uid . '"><h5>von: ' . $ersteller . '</h5></a>
                </div>
                
                
                <div id="timestamp">
                    <p>erstellt : ' . $timestamp . '</p>
                </div>
            </div>
            <div id="recipe-body">

            <div class="recipe-preview">
                <diV class="recipe-preview-image-container">
                    <img alt="Rezept-Vorschaubild" id="rezept-vorschaubild" src=../images/rezepte/'.$pic.'> 
                </diV>
                <div class="recipe-preview-description"></div>
            </div>

            <div id="recipe-rating">
    
                <form id="stars" method="post" action="?id=' . $rezeptID . '">
                    <p class="sternebewertung">
                        <input type="radio" id="stern5" name="bewertung" value="5"><label for="stern5" title="5 Sterne">5 Sterne</label>
                        <input type="radio" id="stern4" name="bewertung" value="4"><label for="stern4" title="4 Sterne">4 Sterne</label>
                        <input type="radio" id="stern3" name="bewertung" value="3"><label for="stern3" title="3 Sterne">3 Sterne</label>
                        <input type="radio" id="stern2" name="bewertung" value="2"><label for="stern2" title="2 Sterne">2 Sterne</label>
                        <input type="radio" id="stern1" name="bewertung" value="1"><label for="stern1" title="1 Stern">1 Stern</label>
                        <span id="Bewertung" title="Keine Bewertung">
                        Bewertung: ';
    $statementbewertung = $pdo->query("SELECT gesamtBewertung FROM rezepte WHERE rid = '$rezeptID'");
    $bewertungsanzeige = $statementbewertung->fetch();
    echo "$bewertungsanzeige[0] Sterne";
    echo '
                        </span>
                    </p>
                        <input type="submit" class="button" id="bewertenButton" value="Bewerten">

                </form>';


    echo '

                <div id="like">
                    <p class="merken">
                        <input type="radio" id="like" name="like" value="like"><label for="like" title="Rezept merken"></label>
                        <span id="Merken">
                        Merken:
                        </span>
                    </p>
                </div>

            </div>

            <div id="dauer"><h4>Dauer: </h4>' . $dauer . ' Minuten</div>
            <div id="schwierigkeit"><h4>Schwierigkeit: </h4>' . $schwierigkeit . '</div><br/>

        <div id="beschreibung">
        <h3>Beschreibung:</h3><br/>
                ' . nl2br($beschreibung) . '
            </div><br/>


        <div id="zutaten">
            <h3>Zutaten für ' . $personen . ' Personen</h3>';

    echo '<div id="table">';
    echo '<table style="width:100%">';

    for ($i = 0; $i < count($zutatenTable); $i++) {
        $zutatenSpalte = explode(":", $zutatenTable[$i]);
        echo '<tr>';
        echo '<td>' . $zutatenSpalte[0] . '</td>';
        echo '<td>' . $zutatenSpalte[1] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div><br/>';


    echo '<h3>Zubereitung:</h3><br/>
                     <div id="zubereitung">
                         <p>' . nl2br($anleitung) . '</p>
                     </div>
                    </div><br/>';

    echo '</div>';
    echo '<div id="comments">';

    echo '<h3>Kommentare</h3>';


    if ($sess == true) {
        echo '<div class="write-comment">';

        echo '<form id="comment-area" method="post" action="rezeptAnsicht.php?id=' . $rezeptID . '&comment=1">';
        echo '<textarea placeholder="Kommentar schreiben..." name="message" maxlength="600"></textarea>';
        echo '<input type="hidden" name="rid" value="' . $rezeptID . '">';
        echo '<input id="comment" type="submit" class="button" value="Kommentieren">';
        echo '</form>';
        echo '</div>';
    }
    echo '<div class="comment-list">';

    $statement3 = $pdo->query("SELECT * FROM recipecomments WHERE rid = '$rezeptID' ORDER BY cid DESC");
    while ($comment = $statement3->fetch()) {
        $uid = $comment['uid'];
        $date = $comment['date'];
        $commentMessage = $comment['message'];
        $cid = $comment['cid'];

        $statement4 = $pdo->query("SELECT nickname FROM users WHERE id = '$uid'");
        $nutzer = $statement4->fetch();
        $nutzerName = $nutzer['nickname'];

        echo '<div class="comment">';
        echo '<div class="comment-info">';
        echo '<a href="profil_ansicht.php?id=' . $uid . '"><h3>' . $nutzerName . '</h3></a>';
        echo '<p class="timestamp">' . $date . '</p>';
        echo '</div>';
        echo '<div class="comment-body">';
        echo '<p>';
        echo nl2br($commentMessage);
        echo '</p>';
        echo '</div>';

        if ($sess == $uid) {
            echo '<div class="delete-button">';
            echo '<form action="?delete=1&id=' . $rezeptID . '" method="post">';
            echo '<input type="hidden" name="cid" value="' . $cid . '">';
            echo '<button class="button" id="delete">Löschen</button>';
            echo '</form>';
            echo '</div>';
        }
        echo '</div>';


    }

    echo '<div id="bottom-buttons">';
    echo '<button class="button" id="show-more">Mehr anzeigen</button>';
    echo '</div>';
    ?>
</div>


<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="../jscript/comments.js"></script>

</body>
</html>
