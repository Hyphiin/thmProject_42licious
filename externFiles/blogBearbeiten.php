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

    <title>42licious-BlogBearbeiten</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/blog_css/blogBearbeiten.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">
        <div class="blog-main">
        <div id="edit-blog">
            <h1>Blogeintrag bearbeiten</h1>
            <?php
            if (isset($_GET['edit'])) {
                $titel = $_POST['titel'];
                $inhalt = $_POST['inhalt'];
                $ID = $_POST['blogid'];

                $sql = "UPDATE blog SET titel = '$titel', inhalt = '$inhalt' WHERE  id = '$ID' ";
                $update = $pdo->prepare($sql);
                $update->execute();
                echo 'Bearbeitung erfolgreich!';
                echo '<br><br>';
                echo '<a href="blogAnsicht.php?id='.$ID.'"><button class="button" id="back">Zurück zum Blog</button></a>';
                echo '<br><br>';
            }elseif(isset($_GET['delete'])) {
                $blogID = $_POST['blogID'];

                $sql = "DELETE FROM blog WHERE id = '$blogID'";
                $update = $pdo->prepare($sql);
                $update->execute();
                echo 'Löschen erfolgreich!';
                echo '<br><br>';
                echo '<a href="blogUSER.php?nutzer='.$sess.'"><button class="button" id="back">Zurück zum Blog</button></a>';
                echo '<br><br>';
            }else {

                if (isset($_GET['bearbeiten'])) {
                    $blogID = $_POST['id'];
                }

                $statement = $pdo->query("SELECT * FROM blog WHERE id = '$blogID' ");
                $blog = $statement->fetch();

                $author = $blog['nutzer'];
                $title = $blog['titel'];
                $entry = $blog['inhalt'];

                echo '<form action="?id=' . $blogID . '&edit" method="post">';
                echo 'Titel:<br>';
                echo '<input type="text" name="titel" size="40" maxlength="255" value="' . $title . '">';
                echo '<br><br>';
                echo 'Inhalt:<br>';
                echo '<textarea name="inhalt">' . $entry . '</textarea>';
                echo '<br><br>';
                echo '<input type="hidden" name="blogid" value="' . $blogID . '">';
                echo '<input type="submit" value="Bearbeiten" class="button">';
                echo '</form>';


                echo '</div>';

                echo '<div id="bottom-buttons">';
                echo '<div>';
                echo '<form action="?delete=1" method="post">';
                echo '<input type="hidden" name="blogID" value="'.$blogID.'">';
                echo '<button class="button" id="delete">Eintrag löschen</button>';
                echo '</form>';
                echo '</div>';
                echo '<div>';
                echo '<a href="blogAnsicht.php?id=' . $blogID . '"><button class="button" id="cancel">Abbrechen</button></a>';
                echo '</div>';

                echo '</div>';

                echo '</div>';
                echo '</div>';

            }


            ?>
</body>
</html>

    <?php
    ;
} else if($sess != true){

    echo"Bitte einloggen!". " ". '<a href="login.php">zum Login</a>';
    echo'<br>';
    echo"Noch kein Mitglied?". " ". '<a href="registrieren.php">Mitglied werden!</a>';

}
?>