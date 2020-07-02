<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>NoSess</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/nosess.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="website">
    <?php include("Navigation.php"); ?>

    <div id="main">
        <div id="main-content">
            <?php
            echo 'Fehlerhafte Eingabe!';
            echo '<br><br>';
            echo '<a href="javascript:history.back()"><button class="button" id="back">Zurück</button></a>';
            echo '<br><br>';
            echo '<a href="index.php"><button class="button" id="back">Weiter zur Startseite</button></a>';
            echo '<br><br>';
            ?>
        </div>
    </div>

</div>
</body>

</html>