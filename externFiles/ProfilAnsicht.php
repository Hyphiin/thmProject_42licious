<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

if (isset($_GET['id'])) {
    $nutzerID = $_GET['id'];
}
if ($nutzerID == 0){

    include("AccNoSess.php");

}else{
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
    <link href="../css/blog_css/BlogPreview.css" rel="stylesheet" type="text/css">
    <link href="../css/rezept_css/rezeptPreview.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("Navigation.php"); ?>

    <div class="main">
        <div id="main-content">

            <?php


            $statement = $pdo->query("SELECT * FROM users WHERE id = '$nutzerID' ");
            $user = $statement->fetch();
            $profilID = $user['id'];
            $vorname = $user['vorname'];
            $nachname = $user['nachname'];
            $nickname = $user['nickname'];
            $date = $user['created_at'];
            $pic = $user['pic'];

            echo '<div id="top-buttons">';

            if($sess!=$nutzerID){
                echo '<a href="javascript:history.back()"><button class="button">Zurück</button></a>';
            }else{
                echo '<a href="index.php"><button class="button">Zurück</button></a>';
            }

            if ($profilID == $sess) {
                echo '<form action="ProfilBearbeiten.php?bearbeiten" method="post">';
                echo '<input type="hidden" name="id" value="' . $profilID . '">';
                echo '<button type="submit" class="button">Bearbeiten</button>';
                echo '</form>';
            }

            echo '</div>';


            echo '<div id="main-profil">';
            echo '<div id="profil-title">';
            echo ' <h1>Profil von' . ' ' . $vorname . ' ' . '</h1>';
            echo '</div>';

            echo '<div id="profil_inhalt">';
            echo '<div id="profil_links">';
            echo '<div id="BildUndButtons">';
            echo '<img alt="Profil-Bild" id="profil_pic" src=' . "$pic" . '>';
            echo '<div id="linksbuttons">';
            echo '<a href="ProfilRezept.php?nutzer=' . $nutzerID . '"><button id="user_rezept" class="button">Rezepte</button></a>';
            echo '<a href="BlogUser.php?nutzer=' . $nutzerID . '"><button id="user_blog" class="button">Blog</button></a>';
            echo '</div>';
            echo '</div>';
            echo '<div id="details">';
            echo '<p id="name">Name: ' . $vorname . " " . $nachname . '</p>';
            echo '<p id="nickname">Nickname: ' . $nickname . '</p>';
            echo '</div>';

            echo '<p>Mitglied seit: ' . substr($date,0,10) . '</p>';
            echo '</div>';

            echo '<div id="profil_rechts">';


            echo '<div class="recipe-highlight">';
            echo '<h4>Top Rezept</h4>';

            $statement = $pdo->query("SELECT * FROM rezepte WHERE uid = '$nutzerID' ORDER BY gesamtBewertung DESC LIMIT 1");
            $rezept = $statement->fetch();

            if (!empty($rezept)) {
                $rezeptID = $rezept['rid'];
                $title = $rezept['titel'];
                $timestamp = $rezept['cdate'];
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

                echo '<a href="RezeptAnsicht.php?id=' . $rezeptID . '">';
                echo '<div class="recipe-preview-container">';
                echo '<div class="recipe-preview">';
                echo '<div class="recipe-preview-pic">';
                echo '<img alt="Rezept-Vorschau" class="recipe-pic" src="">';
                echo '</div>';
                echo '<div class="recipe-preview-info">';
                echo '<div class="kategorien">';
                $kategorie = explode(";", $kategorienListe);

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
                echo '<h2 class="recipe-preview-title">' . $title . '</h2>';
                echo '</div>';
                echo 'Bewertung: '.$bewertung.'<br/>';
                echo 'Dauer: ' . $dauer . ' Minuten<br/>';
                echo 'Schwierigkeit: ' . $schwierigkeit . '<br/><br/>';
                echo nl2br($beschreibung);
                echo '<br/><br/>';
                echo '</div>';

                echo '</div>';
                echo '</div>';
                echo '</a>';
            } else {
                echo '<p>Kein Rezept vorhanden</p>';
            }
            echo '</div>';

            echo '<div class="recipe-highlight">';
            echo '<h4>Letzter Blogeintrag</h4>';

            $statement = $pdo->query("SELECT * FROM blog WHERE nutzer = '$nutzerID' ORDER BY id DESC LIMIT 1");
            $blog = $statement->fetch();

            if (!empty($blog)) {
                $blogID = $blog['id'];
                $title = $blog['titel'];
                $timestamp = $blog['rdate'];
                $entry = $blog['inhalt'];

                echo '<a href="BlogAnsicht.php?id=' . $blogID . '">';
                echo '<div class="blog-preview">';
                echo '<div class="blog-preview-head">';
                echo '<h4 class="blog-preview-title">' . $title . '</h4>';
                echo '<p class="blog-preview-timestamp">' . $timestamp . '</p>';
                echo '</div>';
                echo '<div class="blog-preview-body">';
                echo '<p>';
                echo nl2br(substr($entry, 0, 100));
                echo '</p>';
                echo '</div>';

                echo '</div>';
                echo '</a>';
            } else {
                echo '<p>Kein Blog vorhanden</p>';
            }
            echo '</div>';

            echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
</div>
</div>

</body>
</html>

