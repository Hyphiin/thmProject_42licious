<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>42licious</title>
    <link href="css/general.css" rel="stylesheet" type="text/css">
    <link href="css/navigation.css" rel="stylesheet" type="text/css">
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <link href="css/forms_css/anmeldeFormular.css" rel="stylesheet" type="text/css">


</head>
<body>


<div id="website">

    <?php include("externFiles/navigation.php"); ?>
    <?php include("externFiles/rezept/rezeptAnsicht.php"); ?>

    <div id="main" class="main">

        <div class="container">
            <h1>Top der Woche</h1>

            <div class="recipe-preview">
                <diV class="recipe-preview-image-container">
                    <img src="images/lasagne.jpg" alt="">
                </diV>
                <div class="recipe-preview-description">
                    <h4>Rezeptname</h4>
                    <h5>von Username</h5>
                </div>
            </div>

            <div class="recipe-preview">
                <diV class="recipe-preview-image-container">
                    <img src="images/lasagne.jpg" alt="">
                </diV>
                <div class="recipe-preview-description">
                    <h4>Rezeptname</h4>
                    <h5>von Username</h5>
                </div>
            </div>

            <div class="recipe-preview">
                <diV class="recipe-preview-image-container">
                    <img src="images/lasagne.jpg" alt="">
                </diV>
                <div class="recipe-preview-description">
                    <h4>Rezeptname</h4>
                    <h5>von Username</h5>
                </div>
            </div>

        </div>

        <div class="container">
            <h1>Vorschläge für Dich</h1>

            <div class="recipe-preview">
                <diV class="recipe-preview-image-container">
                    <img src="images/lasagne.jpg" alt="">
                </diV>
                <div class="recipe-preview-description">
                    <h4>Rezeptname</h4>
                    <h5>von Username</h5>
                </div>
            </div>

            <div class="recipe-preview">
                <diV class="recipe-preview-image-container">
                    <img src="images/lasagne.jpg" alt="">
                </diV>
                <div class="recipe-preview-description">
                    <h4>Rezeptname</h4>
                    <h5>von Username</h5>
                </div>
            </div>

            <div class="recipe-preview">
                <diV class="recipe-preview-image-container">
                    <img src="images/lasagne.jpg" alt="">
                </diV>
                <div class="recipe-preview-description">
                    <h4>Rezeptname</h4>
                    <h5>von Username</h5>
                </div>
            </div>

        </div>

    </div>

</div>

<script src="jscript/navigation.js"></script>
<script src="jscript/recipeModal.js"></script>

</body>
</html>