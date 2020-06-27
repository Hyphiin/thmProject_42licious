<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

if ($sess == true) {
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>42licious-BlogUSER</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/blog_css/blogUSER.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/blog_css/BlogPreview.css" rel="stylesheet" type="text/css">


</head>
<body>

<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">
        <div class="main-content">
        <div id="bloglist-user">
            <?php
            if(isset($_GET['nutzer'])){
                $nutzer= $_GET['nutzer'];
            }

            $statement = $pdo->query("SELECT * FROM users WHERE id = '$nutzer' ");
            $blogAuthor = $statement->fetch();
            $authorID = $blogAuthor['id'];
            $authorName = $blogAuthor['nickname'];
            echo '<div id="head-title">';
            echo    '<h1>Blog von '.$authorName.'</h1>';
            echo '</div>';


            echo '<div id="top-buttons">';

            if ($sess==$authorID) {
             echo '<a href="blogErstellen.php?id='.$nutzer.'"><button class="button" id="b-create-blog">Blogeintrag erstellen</button></a>';
                }

            echo         '<div>';
            echo           '<label for="filter">Sortieren nach:</label>';
            echo           '<select id="filter" name="filter">';
            echo               '<option value="date">Datum</option>';
            echo               '<option value="name">Name</option>';
            echo            '</select>';
            echo       '</div>';

            echo '</div>';

            echo '<div class="blog-list">';


                $statement = $pdo->query("SELECT * FROM blog WHERE nutzer = '$nutzer' ORDER BY id DESC");
                while($blog = $statement->fetch()) {

                    $blogID= $blog['id'];
                    $title = $blog['titel'];
                    $timestamp = $blog['rdate'];
                    $entry = $blog['inhalt'];

                    echo '<a href="blogAnsicht.php?id='.$blogID.'">';
                    echo '<div class="blog-preview">';
                    echo '<div class="blog-preview-head">';
                    echo '<h2 class="blog-preview-title">' . $title . '</h2>';
                    echo '<p class="blog-preview-timestamp">' . $timestamp . '</p>';
                    echo '</div>';
                    echo '<div class="blog-preview-body">';
                    echo '<p>';
                    echo nl2br(substr($entry,0,100));
                    echo '</p>';
                    echo '</div>';
                    
                    echo '</div>';
                    echo '</a>';
                }

                ?>

            </div>

            <div id="bottom-buttons">
                 <button class="button" id="show-more">Mehr anzeigen</button>
            </div>

        </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="../jscript/blogPreview.js"></script>

</body>
</html>
    <?php
} else if($sess != true){
    echo '<div id="website">';

    echo'<div id="main">';
    echo'<div id="main-content">';
    echo"Bitte einloggen!". " ". '<a href="login.php">zum Login</a>';
    echo'<br>';
    echo"Noch kein Mitglied?". " ". '<a href="registrieren.php">Mitglied werden!</a>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
}
?>