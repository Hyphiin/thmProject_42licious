<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>42licious</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/index.css" rel="stylesheet" type="text/css">
    <link href="../css/recipePreview.css" rel="stylesheet" type="text/css">


</head>
<body>


<div id="website">

    <?php include("navigation.php"); ?>

    <div class="main">

        <div class="container-index">
            <div class="index-title">
                <h1>Top der Woche</h1>
            </div>

            <?php
            include("rezeptPreview.php");
            include("rezeptPreview.php");
            include("rezeptPreview.php");
            ?>


        </div>

        <div class="container-index">
            <div class="index-title">
                <h1>Vorschläge für Dich</h1>
            </div>

            <?php
            include("rezeptPreview.php");
            include("rezeptPreview.php");
            include("rezeptPreview.php");
            ?>

        </div>

    </div>

</div>

</body>
</html>