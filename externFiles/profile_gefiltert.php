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
    <link href="../css/profil_css/profil_ansicht.css" rel="stylesheet" type="text/css">
    <link href="../css/profil_css/profil_anzeigen.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">

        <div class="main-content">

            <div class="profil-list">

                <?php

                if (isset($_GET['order'])){
                    $selected = 'selected';
                }else{
                    $selected = '';
                }

                if(isset($_GET["suchbegriff"])) {
                    $suchwort = $_GET["suchbegriff"];

                echo '<div id="head-title">';
                    echo    '<h1>Suchergebnisse für "'.$suchwort.'"</h1>';
                    echo' </div>';

                    echo'<div id="top-buttons">';
                    echo   '<div>';
                    echo    '<label for="filter">Sortieren nach:</label>';
                    echo          '<select id="filter" name="filter" onchange="location = this.value">';
                    echo              '<option value="profile_gefiltert.php?suchbegriff='.$suchwort.'">Name</option>';
                    echo              '<option value="profile_gefiltert.php?suchbegriff='.$suchwort.'&order=created_at" '.$selected.'>Erstellungsdatum</option>';
                    echo          '</select>';
                    echo '</div>';

                    echo '</div>';

                    echo '<div class="users">';



        $suchwort = explode(" ", $suchwort);
        $abfrage = "";
        $a = array('vorname', 'nachname', 'nickname');
        for($i = 0; $i < sizeof($suchwort); $i++)
        {
            for($ii = 0; $ii < sizeof($a); $ii++)
            {
                if($ii == 0){
                    $abfrage .= "(";
                }
                $abfrage .= "`".$a[$ii]."` LIKE '%".$suchwort[$i]."%'";
                if($ii < (sizeof($a) - 1)) {
                    $abfrage .= " OR ";
                }else{
                    $abfrage .= ")";
                }
            }
            if($i < (sizeof($suchwort) - 1)) {
                $abfrage .= " AND ";
            }
        }

        $host_name  = "localhost";
        $database   = "42licious";
        $user_name  = "root";
        $password   = "";

        $db = mysqli_connect($host_name, $user_name, $password, $database);

                    if(isset($_GET['order'])){
                        $order = $_GET['order'];
                    }else{
                        $order = 'nickname';
                    }


        if(mysqli_connect_errno() == 0)
        {
            $sql = "SELECT * FROM `users` WHERE $abfrage ORDER BY $order ";
            $ergebnis = $db->query($sql);
            if(is_object($ergebnis)){
                while($zeile = $ergebnis->fetch_object())
                {
                    echo    '<a href="profil_ansicht.php?id='.$zeile->id.'">';
                    echo        '<div class="profil-preview">';
                    echo        '<div class="profil-preview-body">';
                    echo            '<div class="profil-preview-pic">';
                    echo               '<img alt="Profil-Bild" id="profil_bild" src='."$zeile->pic".'>';
                    echo            '</div>';
                    echo            '<div class="profil-preview-info">';
                    echo                '<p>Name: '.$zeile->vorname." ".substr($zeile->nachname,0,1).".".'</p>';
                    echo                '<p>Nutzername: '.$zeile->nickname.'</p>';
                    echo                   '<br>';
                    echo                '<p>Mitglied seit: '.$zeile->created_at.'</p>';
                    echo            '</div>';
                    echo            '</div>';
                    echo        '</div>';
                    echo    '</a>';
                }
            }
        }
        $db->close();
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
