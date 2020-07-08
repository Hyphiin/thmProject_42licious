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

    <title>42licious-BlogErstellen</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/blog_css/blogErstellen.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="website">

    <?php include("Navigation.php"); ?>

    <div id="main">
        <div class="blog-main">
        <div id="create-blog">


            <?php
            if(isset($_GET['erstellen'])){
                $titel = $_POST['titel'];
                $inhalt = $_POST['inhalt'];

                $statement = $pdo->prepare("INSERT INTO blog (Nutzer, titel, inhalt) VALUES (:Nutzer ,:titel, :inhalt)");
                $result = $statement->execute(array('Nutzer' => $sess, 'titel' => $titel, 'inhalt' => $inhalt));
                echo '<div id="notification">';
                echo 'Blogeintrag erstellt!';
                echo '<br><br>';
                echo '<a href="BlogUser.php?nutzer='.$sess.'"><button class="button" id="back">Zurück zum Blog</button></a>';
                echo '<br>';
                echo '</div>';
            }else{
?>
            <h1>Blogeintrag erstellen</h1>

            <form action="?erstellen=1" method="post">
                Titel:<br>
                <input type="text" name="titel" size="40" maxlength="255">
                <br><br>
                Inhalt:<br>
                <textarea name="inhalt" maxlength="3000"></textarea>
                <br><br>
                <input type="submit" value="Bloggen" class="button">
            </form>

        </div>

        <div id="bottom-buttons">
            <?php
            if (isset($_GET['id'])){
                $nutzer = $_GET['id'];
            }
            echo '<a href="BlogUser.php?nutzer='.$nutzer.'"><button class="button" id="cancel">Abbrechen</button></a>';
            ?>
        </div>
        </div>
    </div>
</div>
<?php
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
<script>
    gsap.from("#main",{y:15});
</script>

</body>
</html>

    <?php
    ;
} else if($sess != true){

    echo"Bitte einloggen!". " ". '<a href="AccLogin.php">zum Login</a>';
    echo'<br>';
    echo"Noch kein Mitglied?". " ". '<a href="AccRegistrieren.php">Mitglied werden!</a>';

}
?>