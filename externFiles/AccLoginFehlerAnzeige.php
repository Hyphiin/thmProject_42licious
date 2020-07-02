<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>NoSess</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/nosess.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="website">
    <?php include("Navigation.php"); ?>

    <div id="main">
        <div id="main-content">
            <?php
           echo 'Login fehlgeschlagen!';
             echo '<br><br>';
             echo '<a href="AccLogin.php"><button class="button" id="back">Zurück zum Login</button></a>';
             echo '<br><br>';
            ?>
           </div>
        </div>

        </div>
</body>

</html>
