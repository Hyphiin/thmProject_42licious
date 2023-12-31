<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];


?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-BlogAnsicht</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/blog_css/blogAnsicht.css" rel="stylesheet" type="text/css">
    <link href="../css/kommentare_css/kommentar.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">

    <?php include("navigation.php"); ?>

<div id="main">

    <div id="top-buttons">

        <?php
        if(isset($_GET['comment'])) {
            $bid = $_POST['bid'];
            $message = $_POST['message'];


            $statement1 = $pdo->prepare("INSERT INTO blogcomments (bid, uid, message) VALUES (:bid, :uid ,:message)");
            $result = $statement1->execute(array('bid' => $bid, 'uid' => $sess, 'message' => $message));

        }

        if(isset($_GET['delete'])) {
            $cid = $_POST['cid'];

            $sql = "DELETE FROM blogcomments WHERE cid = '$cid'";
            $update = $pdo->prepare($sql);
            $update->execute();
        }
        if(isset($_GET['id'])){
            $blogID= $_GET['id'];
        }

        $statement2 = $pdo->query("SELECT * FROM blog WHERE id = '$blogID' ");
        $blog = $statement2->fetch();

        $author= $blog['nutzer'];
        $title = $blog['titel'];
        $timestamp = $blog['rdate'];
        $entry = $blog['inhalt'];

        echo '<a href="blogUSER.php?nutzer='.$author.'"><button class="button">Zurück zum Blog</button></a>';

        if ($sess==$author) {
            echo '<a href="blogBearbeiten.php?id='.$blogID.'"><button class="button">Bearbeiten</button></a>';
        }
        ?>

    </div>

    <div class="main-content">
        <?php


        echo '<div id="blog-info">';

        echo  '<div id="blog-title">';
        echo    '<h1>' .$title. '</h1>';
        echo  '</div>';

        echo  '<div id="timestamp">';
        echo    '<p>' .$timestamp. '</p>';
        echo  '</div>';

        echo '</div>';

        echo '<div id="blog-content">';
        echo    '<p>';
        echo       nl2br($entry);
        echo    '</p>';
        echo  '</div>';
?>



    <div id="comments">

        <h3>Kommentare</h3>


            <?php

            if($sess==true){
            echo '<div class="write-comment">';

        echo '<form method="post" action="blogAnsicht.php?comment=1&id='.$blogID.'">';
            echo  '<textarea placeholder="Kommentar schreiben..." name="message" maxlength="600"></textarea>';
             echo '<input type="hidden" name="bid" value="'.$blogID.'">';
            echo '<input type="submit" class="button" value="Kommentieren">';
            echo '</form>';
            echo '</div>';
}
            echo '<div class="comment-list">';

            $statement3 = $pdo->query("SELECT * FROM blogcomments WHERE bid = '$blogID' ORDER BY cid DESC");
            while($comment = $statement3->fetch()) {
                $uid = $comment['uid'];
                $date = $comment['date'];
                $commentMessage = $comment['message'];
                $cid = $comment['cid'];

                $statement4 = $pdo->query("SELECT nickname FROM users WHERE id = '$uid'");
                $nutzer= $statement4->fetch();
                $nutzerName = $nutzer['nickname'];

                echo '<div class="comment">';
                echo '<div class="comment-info">';
                echo '<h3>' . $nutzerName . '</h3>';
                echo '<p class="timestamp">' . $date . '</p>';
                echo '</div>';
                echo '<div class="comment-body">';
                echo '<p>';
                echo    nl2br($commentMessage);
                echo '</p>';
                echo '</div>';

                if($sess==$uid) {
                    echo '<div class="delete-button">';
                    echo '<form action="?delete=1&id='.$blogID.'" method="post">';
                    echo '<input type="hidden" name="cid" value="'.$cid.'">';
                    echo '<button class="button" id="delete">Löschen</button>';
                    echo '</form>';
                    echo '</div>';
                }
                echo '</div>';


            }

            echo '<div id="bottom-buttons">';
            echo     '<button class="button" id="show-more">Mehr anzeigen</button>';
            echo '</div>';
?>
    </div>

    </div>

    </div>

</div>

</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="../jscript/comments.js"></script>

</body>
</html>
