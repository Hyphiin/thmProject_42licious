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

        <title>42licious-Profil-Ansicht</title>
        <link href="../css/general.css" rel="stylesheet" type="text/css">
        <link href="../css/navigation.css" rel="stylesheet" type="text/css">
        <link href="../css/profil_css/profil_anzeigen.css" rel="stylesheet" type="text/css">

    </head>
    <body>
    <div id="website">

        <?php include("Navigation.php"); ?>

        <div id="main">

            <div class="main-content">

                <?php

                if (isset($_GET['order'])){
                    $selected = 'selected';
                }else{
                    $selected = '';
                }
                echo '<div class="profil-list">';

                 echo   '<div id="head-title">';
                 echo       '<h1>Suchergebnisse</h1>';
                 echo   '</div>';

                 echo   '<div id="top-buttons">';
                  echo      '<div>';
                  echo          '<label for="filter">Sortieren nach:</label>';
                  echo          '<select id="filter" name="filter" onchange="location = this.value">';
                  echo              '<option value="profile_anzeigen.php">Name</option>';
                  echo              '<option value="profile_anzeigen.php?order=created_at" '.$selected.'>Erstellungsdatum</option>';
                  echo          '</select>';
                  echo      '</div>';

                  echo  '</div>';

            echo '<div class="users">';

        if(isset($_GET['order'])){
            $order = $_GET['order'];
        }else{
            $order = 'nickname';
        }

        $statement = $pdo->query("SELECT * FROM users ORDER BY $order");
        while ($user = $statement->fetch()) {

            $nutzerID = $user['id'];
            $vorname = $user['vorname'];
            $nachname = $user['nachname'];
            $nickname = $user['nickname'];
            $created = $user['created_at'];
            $pic = $user['pic'];

            echo    '<a href="profil_ansicht.php?id='.$nutzerID.'">';
            echo        '<div class="profil-preview">';
            echo        '<div class="profil-preview-body">';
            echo            '<div class="profil-preview-pic">';
            echo               '<img alt="Profil-Bild" id="profil_bild" src='."$pic".'>';
            echo            '</div>';
            echo            '<div class="profil-preview-info">';
            echo                '<p>Name: '.$vorname." ".substr($nachname,0,1).".".'</p>';
            echo                '<p>Nutzername: '.$nickname.'</p>';
            echo                   '<br>';
            echo                '<p>Mitglied seit: '.$created.'</p>';
            echo            '</div>';
            echo            '</div>';
            echo        '</div>';
            echo    '</a>';
        }
?>
            </div>
                    <div id="bottom-buttons">
                        <button class="button" id="show-more">Mehr anzeigen</button>
                    </div>

                </div>
                </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="../jscript/profilPreview.js"></script>

    </body>
    </html>
