<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>42licious-BlogUSER</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/blog_css/blogUSER.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">

        <div id="bloglist-user">

            <div id="head-title">
                <h1>Blog von USER</h1>
            </div>

            <div id="top-buttons">
                    <a href="blogErstellen.php"><button class="button" id="b-create-blog">Blogeintrag erstellen</button></a>
                     <div>
                        <label for="filter">Sortieren nach:</label>
                        <select id="filter" name="filter">
                            <option value="name">Name</option>
                            <option value="date">Datum</option>
                         </select>
                    </div>

            </div>

            <div class="blog-list">

                <?php
                include("blogPreview.php");
                include("blogPreview.php");
                include("blogPreview.php");
                include("blogPreview.php");
                include("blogPreview.php");
                include("blogPreview.php");
                include("blogPreview.php");
                include("blogPreview.php");
                include("blogPreview.php");
                include("blogPreview.php");
                include("blogPreview.php");
                include("blogPreview.php");
                ?>

            </div>

            <div id="bottom-buttons">
                 <button class="button" id="show-more">Mehr anzeigen</button>
            </div>

        </div>




    </div>

</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="../jscript/blogPreview.js"></script>

</body>
</html>
