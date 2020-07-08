<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

if($sess!=true){
    $sess=0;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>42licious - Startseite</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/index.css" rel="stylesheet" type="text/css">
    <link href="../css/rezept_css/rezeptPreview.css" rel="stylesheet" type="text/css">



</head>
<body>


<div id="website">

    <?php include("Navigation.php"); ?>

    <div class="main">

        <div class="container-index">
            <div class="index-title">
                <h1>Top der Woche</h1>
            </div>

            <?php
            include("RezeptTopDerWoche.php");
            include("RezeptTopDerWoche2.php");
            include("RezeptTopDerWoche3.php");
            ?>


        </div>

        <div class="container-index">
            <div class="index-title">
                <h1>Vorschläge für Dich</h1>
            </div>

            <?php
            $check1 = 0;
            $check2 = 0;
            $rezeptID = 0;
            include("RezeptVorschlaegeFuerDich.php");
            $check1 = $rezeptID;
            include("RezeptVorschlaegeFuerDich.php");
            $check2 = $rezeptID;
            include("RezeptVorschlaegeFuerDich.php");
            ?>

        </div>

    </div>



<?php include("Footer.php")?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
<script>
    gsap.from(".recipe-preview-container",{});
    gsap.from(".main",{y:20})
</script>

</body>
</html>
