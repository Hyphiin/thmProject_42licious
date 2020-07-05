<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

$referer = $_SERVER['HTTP_REFERER'];

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

    <?php include("Navigation.php");

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

    if ($sess) {
        if (isset($_POST['bewertung'])) {
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
    $zutatenTable = explode(";", $zutatenListe);
    $anleitung = $rezept['anleitung'];
    $gesBewertung = $rezept['gesamtBewertung'];

    if ($sess == $uid) {
        $rDisable = "disabled";
    }

    if ($sess) {
        if ($sess != $uid) {
            if (isset($_POST['like'])) {
                if ($_POST['checkFav'] == "checked") {
                    $statement7 = $pdo->query("SELECT favRezepte FROM users WHERE id = '$sess' ");
                    $favorites = $statement7->fetch();
                    $curFavorites = explode(",", $favorites[0]);
                    for ($i = 0; $i < count($curFavorites); $i++) {
                        if ($curFavorites[$i] == $rezeptID) {
                            $remember = $i;
                        }
                    }
                    for ($i = 0; $i < count($curFavorites); $i++) {
                        if ($i == 0) {
                            if ($remember != 0) {
                                $favRezepte = $curFavorites[$i];
                            } else {
                                $favRezepte = $curFavorites[$i + 1];
                                $i++;
                            }
                        } elseif ($i != $remember) {
                            $favRezepte .= "," . $curFavorites[$i];
                        }
                    }
                    $statement9 = $pdo->query("UPDATE users SET favRezepte = '$favRezepte' WHERE id = '$sess'");
                } else {
                    $statement7 = $pdo->query("SELECT favRezepte FROM users WHERE id = '$sess' ");
                    $favorites = $statement7->fetch();
                    if (empty($favorites[0])) {
                        $favRezepte = $rezeptID;
                        $statement8 = $pdo->query("UPDATE users SET favRezepte = '$favRezepte' WHERE id = '$sess'");
                    } else {
                        $curFavorites = explode(",", $favorites[0]);
                        $newFavorite = true;
                        for ($i = 0; $i < count($curFavorites); $i++) {
                            if ($curFavorites[$i] == $rezeptID) {
                                $newFavorite = false;
                                break;
                            }
                        }
                        if ($newFavorite != false) {
                            $favRezepte = $favorites[0];
                            $favRezepte .= "," . $rezeptID;
                            $statement9 = $pdo->query("UPDATE users SET favRezepte = '$favRezepte' WHERE id = '$sess'");
                        }
                    }
                }
            }
        }
    }

    $statement10 = $pdo->query("SELECT favRezepte FROM users WHERE id = '$sess' ");
    $favorites = $statement10->fetch();
    $curFavorites = explode(",", $favorites[0]);
    for ($i = 0; $i < count($curFavorites); $i++) {
        if ($curFavorites[$i] == $rezeptID) {
            $fav = 'checked';
        }
    }


    $statement2 = $pdo->query("SELECT COUNT(BID) FROM bewertung WHERE rezeptID = '$rezeptID' ");
    $bewertungenAnzahl = $statement2->fetch();
    if (!empty($bewertungenAnzahl)) {
        $bewertungenZahl = $bewertungenAnzahl[0];
    }

    if ($gesBewertung == 0) {
        $gesBewertung = "Keine Bewertungen";
    } elseif ($gesBewertung == 1) {
        $gesBewertung = "Bewertung: " . $gesBewertung . " Stern (" . $bewertungenZahl . ")";
    } else {
        $gesBewertung = "Bewertung: " . $gesBewertung . " Sterne (" . $bewertungenZahl . ")";
    }

    $statement3 = $pdo->query("SELECT * FROM users WHERE id = '$uid' ");
    $autor = $statement3->fetch();
    $ersteller = $autor['nickname'];

    $statement4 = $pdo->query("SELECT BSterne FROM bewertung WHERE rezeptID = '$rezeptID' AND BNutzer = '$sess' ");
    $userBewertung = $statement4->fetch();
    $UserWertung = $userBewertung['BSterne'];
    if ($UserWertung == 5) {
        $Wertung5 = "checked";
    } elseif ($UserWertung == 4) {
        $Wertung4 = "checked";
    } elseif ($UserWertung == 3) {
        $Wertung3 = "checked";
    } elseif ($UserWertung == 2) {
        $Wertung2 = "checked";
    } elseif ($UserWertung == 1) {
        $Wertung1 = "checked";
    }

    echo '<div id="main">

        

        <div class="main-content">
        
        <div id="top-buttons">';

    if (substr($referer, -15, 15) == "SucheFilter.php") {
        echo '<a href="index.php"><button class="button">Zurück zur Startseite</button></a>';
    } else {
        echo '<a href="javascript:history.back()"><button class="button">Zurück</button></a>';
    }

    if ($sess == $uid) {
        echo '<form class="form-row" action="RezeptBearbeiten.php?bearbeiten" method="post">';
        echo '<input type="hidden" name="id" value=" ' . $rezeptID . ' ">';
        echo '<button type="submit" class="button">Bearbeiten</button>';
        echo '</form>';
    }
    echo '</div>
        
        
        <div id="top-info">
            
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
            </div>
            <div id="recipe-info">
                <div class="recipe-title">
                    <h1>' . $titel . '</h1>
                    <a href="ProfilAnsicht.php?id=' . $uid . '"><h5>von: ' . $ersteller . '</h5></a>
                </div>
                
                
                <div id="timestamp">
                    <p>erstellt : ' . $timestamp . '</p>
                </div>
            </div>
            <div id="recipe-body">

            <div class="recipe-preview">
                <diV class="recipe-preview-image-container">
                    <img alt="Rezept-Vorschaubild" id="rezept-vorschaubild" src=../images/rezepte/' . $pic . '>
                </diV>
                <div class="recipe-preview-description"></div>
            </div>
            <div class="rating-favorite">
            <div id="recipe-rating">
    
                <form id="stars" class="form-row" method="post" action="?id=' . $rezeptID . '">
                    <p class="sternebewertung">
                        <input type="radio" id="stern5" name="bewertung" value="5" ' . $Wertung5 . ' onclick="this.form.submit()" ' . $rDisable . '><label for="stern5" title="5 Sterne">5 Sterne</label>
                        <input type="radio" id="stern4" name="bewertung" value="4" ' . $Wertung4 . ' onclick="this.form.submit()" ' . $rDisable . '><label for="stern4" title="4 Sterne">4 Sterne</label>
                        <input type="radio" id="stern3" name="bewertung" value="3" ' . $Wertung3 . ' onclick="this.form.submit()" ' . $rDisable . '><label for="stern3" title="3 Sterne">3 Sterne</label>
                        <input type="radio" id="stern2" name="bewertung" value="2" ' . $Wertung2 . ' onclick="this.form.submit()" ' . $rDisable . '><label for="stern2" title="2 Sterne">2 Sterne</label>
                        <input type="radio" id="stern1" name="bewertung" value="1" ' . $Wertung1 . ' onclick="this.form.submit()" ' . $rDisable . '><label for="stern1" title="1 Stern">1 Stern</label>
                        <span id="Bewertung" title="Keine Bewertung">
                        ' . $gesBewertung . '';

    echo '    </span>
                    </p>
                        </form>';


    echo '</div>

            <div id="like-recipe">
             <form id="fav" class="form-row" method="post" action="?id=' . $rezeptID . '">
                <p class="merken">
                    <input type="hidden" name="checkFav" value="' . $fav . '">
                    <input type="radio" id="like" name="like" value="like" ' . $fav . ' onclick="this.form.submit()"><label for="like" title="Rezept merken"></label>
                    <span id="Merken">
                        Merken:
                    </span>
                </p>
                </form>
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

        echo '<form id="comment-area" method="post" action="RezeptAnsicht.php?id=' . $rezeptID . '&comment=1">';
        echo '<textarea placeholder="Kommentar schreiben..." name="message" maxlength="400"></textarea>';
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
        echo '<a href="ProfilAnsicht.php?id=' . $uid . '"><h3>' . $nutzerName . '</h3></a>';
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
<script>
    gsap.from(".main-content", {y: 20});
</script>

</body>
</html>
