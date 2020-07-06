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

    <?php include("Navigation.php"); ?>

<div id="main">



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


    ?>
    <div class="main-content">
        <?php
        echo '<div id="top-buttons">';

        if($sess!=$author){
            echo '<a href="javascript:history.back()"><button class="button">Zurück</button></a>';
        }else{
            echo '<a href="BlogUser.php?nutzer='.$sess.'"><button class="button">Zurück</button></a>';
        }

        if ($sess==$author) {
            echo '<form action="BlogBearbeiten.php?bearbeiten" method="post">';
            echo '<input type="hidden" name="id" value="'.$blogID.'">';
            echo '<button type="submit" class="button">Bearbeiten</button>';
            echo '</form>';
        }


        echo '</div>';

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

        echo '<form method="post" action="BlogAnsicht.php?comment=1&id='.$blogID.'">';
            echo  '<textarea placeholder="Kommentar schreiben..." name="message" maxlength="400"></textarea>';
             echo '<input type="hidden" name="bid" value="'.$blogID.'">';
            echo '<input type="submit" class="button" value="Kommentieren">';
            echo '</form>';
            echo '</div>';
}
            echo '<div class="comment-list">';

            $commentCount = 0;
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
                echo '<a href="ProfilAnsicht.php?id='.$uid.'"><h3>' . $nutzerName . '</h3></a>';
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
                $commentCount++;

            }
            if ($commentCount>3) {
                echo '<div id="bottom-buttons">';
                echo '<button class="button" id="show-more">Mehr anzeigen</button>';
                echo '</div>';
            }
?>
    </div>

    </div>

    </div>



<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="../jscript/comments.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
<script>
    gsap.from("#main",{y:20});
</script>

</body>
</html>
