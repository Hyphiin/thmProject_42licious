<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

if(isset($_GET['nutzer'])){
    $nutzer= $_GET['nutzer'];
}
if($nutzer==0){

    include("AccNoSess.php");

}else{
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

    <?php include("Navigation.php"); ?>

    <div id="main">
        <div class="main-content">

        <div id="bloglist-user">

            <div class="top-buttons">
                <a href="javascript:history.back()"><button class="button">Zurück</button></a>
            </div>

            <?php


            $statement = $pdo->query("SELECT * FROM users WHERE id = '$nutzer' ");
            $blogAuthor = $statement->fetch();
            $authorID = $blogAuthor['id'];
            $authorName = $blogAuthor['nickname'];
            echo '<div id="head-title">';
            echo    '<h1>Blog von <a href="ProfilAnsicht.php?id='.$authorID.'">'.$authorName.'</a></h1>';
            echo '</div>';


            echo '<div id="top-buttons">';

            if ($sess==$authorID) {
             echo '<a href="BlogErstellen.php?id='.$nutzer.'"><button class="button" id="b-create-blog">Blogeintrag erstellen</button></a>';
                }

            if (isset($_GET['order'])){
                $selected = 'selected';
            }else{
                $selected = '';
            }

            echo         '<div>';
            echo           '<label for="filter">Sortieren nach:</label>';
            echo          '<select id="filter" name="filter" onchange="location = this.value">';
            echo              '<option value="BlogUser.php?nutzer='.$nutzer.'">Neuste</option>';
            echo              '<option value="BlogUser.php?nutzer='.$nutzer.'&order=titel" '.$selected.'>Titel</option>';
            echo          '</select>';
            echo       '</div>';

            echo '</div>';

            echo '<div class="blog-list">';

            if(isset($_GET['order'])){
                $order = $_GET['order'];
            }else{
                $order = 'id DESC';
            }


                $statement = $pdo->query("SELECT * FROM blog WHERE nutzer = '$nutzer' ORDER BY $order");
                while($blog = $statement->fetch()) {

                    $blogID= $blog['id'];
                    $title = $blog['titel'];
                    $timestamp = $blog['rdate'];
                    $entry = $blog['inhalt'];

                    echo '<a href="BlogAnsicht.php?id='.$blogID.'">';
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


            echo '</div>';

            echo '<div id="bottom-buttons">';
            echo     '<button class="button" id="show-more">Mehr anzeigen</button>';
            echo '</div>';

                }
                ?>
        </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="../jscript/blogPreview.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
<script>
    gsap.from("#main",{y:15});
</script>

</body>
</html>
