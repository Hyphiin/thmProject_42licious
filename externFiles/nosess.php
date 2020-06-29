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
    <?php include("navigation.php");  ?>
    <div id="main">
        <div id="main-content">
            <?php
            echo "Bitte einloggen!" . " " . '<a href="login.php">zum Login</a>';
            echo '<br>';
            echo "Noch kein Mitglied?" . " " . '<a href="registrieren.php">Mitglied werden!</a>';
            ?>
        </div>
    </div>
</div>
</body>

</html>

