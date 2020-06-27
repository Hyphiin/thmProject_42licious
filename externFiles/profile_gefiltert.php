<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>42licious-Profil-Ansicht</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/profil_css/profil_ansicht.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("navigation.php"); ?>



    <?php

    if(isset($_GET["suchbegriff"])) {
        $suchwort = $_GET["suchbegriff"];
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


        if(mysqli_connect_errno() == 0)
        {
            $sql = "SELECT * FROM `users` WHERE " . $abfrage;
            $ergebnis = $db->query($sql);
            if(is_object($ergebnis)){
                while($zeile = $ergebnis->fetch_object())
                {
                    echo '<div id="users">';
                    echo $zeile->vorname;
                    echo '<br>';
                    echo $zeile->nachname;
                    echo '<br>';
                    echo $zeile->nickname;
                    echo '<br>';
                    echo '<br>';
                    echo '<br>';
                    echo '</div>';

                }
            }
        }
        $db->close();
    }

    ?>


</body>
</html>
