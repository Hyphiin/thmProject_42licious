<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

if(isset($_GET['id'])){
    $nutzerID = $_GET['id'];
}
if($nutzerID==0){

    include("nosess.php");

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

</head>
<body>
<div id="website">

    <?php include("navigation.php"); ?>

    <div class="main">
    <div id="main-content">

        <?php


            $statement = $pdo->query("SELECT * FROM users WHERE id = '$nutzerID' ");
            $user = $statement->fetch();
            $profilID = $user['id'];
            $vorname= $user['vorname'];
            $nachname= $user['nachname'];
            $nickname= $user['nickname'];
            $date= $user['created_at'];
            $pic= $user['pic'];

        echo '<div id="top-buttons">';

         echo    '<a href="index.php"><button class="button">Zurück</button></a>';

         if ($profilID==$sess) {
             echo '<a href="p_editieren.php?id='.$nutzerID.'"><button class="button">Bearbeiten</button></a>';
         }

        echo '</div>';


            echo '<div id="main-profil">';
            echo '<div id="profil-title">';
               echo' <h1>Profil von' .' '.$vorname.' '.'</h1>';
            echo '</div>';

            echo '<div id="profil_inhalt">';
                echo '<div id="profil_links">';
                    echo '<div id="BildUndButtons">';
                        echo '<img alt="Profil-Bild" id="profil_bild" src='."$pic".'>';
                        echo '<div id="linksbuttons">';
                            echo '<a href="profil_rezept.php"><button id="user_rezept" class="button">Rezepte</button></a>';
                            echo '<a href="blogUSER.php?nutzer='.$nutzerID.'"><button id="user_blog" class="button">Blog</button></a>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div id="details">';
                        echo '<p id="name">Name: '.$vorname." ".$nachname.'</p>';
                        echo '<p id="nickname">Nickname: '.$nickname.'</p>';
                    echo '</div>';

                    echo '<p>Mitglied seit: '.$date.'</p>';
                echo '</div>';

                echo '<div id="profil_rechts">';
            echo    '<div id="top_rezept">';
            echo        '<label>Top Rezept</label>';
            echo        '<p id="toprezept">Hier soll das Top-Rezept stehen!</p>';
            echo       '</div>';

              echo      '<div class="recipe-highlight">';
              echo          '<h4>Letzter Blogeintrag</h4>';

                $statement = $pdo->query("SELECT * FROM blog WHERE nutzer = '$nutzerID' ORDER BY id DESC LIMIT 1");
                $blog = $statement->fetch();

        $blogID= $blog['id'];
        $title = $blog['titel'];
        $timestamp = $blog['rdate'];
        $entry = $blog['inhalt'];

        echo '<a href="blogAnsicht.php?id='.$blogID.'">';
        echo '<div class="blog-preview">';
        echo '<div class="blog-preview-head">';
        echo '<h4 class="blog-preview-title">' . $title . '</h4>';
        echo '<p class="blog-preview-timestamp">' . $timestamp . '</p>';
        echo '</div>';
        echo '<div class="blog-preview-body">';
        echo '<p>';
        echo nl2br(substr($entry,0,100));
        echo '</p>';
        echo '</div>';

        echo '</div>';
        echo '</a>';

             echo       '</div>';

             echo   '</div>';
        }
                ?>
            </div>
        </div>
    </div>
    </div>
</div>

</body>
</html>

