<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>42licious - Logout</title>
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
            echo '<div id="notification">';
            echo '<br>';
            echo 'Logout erfolgreich!';
            echo '<br><br>';
            echo '<a href="index.php"><button class="button" id="back">Startseite</button></a>';
            echo '<br>';
            echo '</div>';
            ?>
        </div>
    </div>

</div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
<script>
    gsap.from("#main",{y:15});
</script>

</html>
