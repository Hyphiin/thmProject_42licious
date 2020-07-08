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
            echo '<br>';
            echo '<div id="notification">';
            echo 'Du wurdest erfolgreich registriert!';
            echo '<br><br>';
            echo '<a href="AccLogin.php"><button class="button" id="back">Weiter zum Login</button></a>';
            echo '<br>';
            echo '</div>';
            ?>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
<script>
    gsap.from("#main",{y:15});
</script>

</body>

</html>