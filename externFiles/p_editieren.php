<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');
$sess = $_SESSION['userid'];

?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Editieren</title>
</head>
<body>
    <form action="?edit=1" method="POST">

        Vorname:<br>
        <input type="text" size="40" maxlength="250" name="vorname"><br><br>

        Nachname:<br>
        <input type="text" size="40" maxlength="250" name="nachname"><br><br>

        Nickname:<br>
        <input type="text" size="40" maxlength="250" name="nickname"><br><br>

        <input type="submit" value="Bearbeitung">

    </form>
<?php

    if (isset($_GET['edit'])) {
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $nickname = $_POST['nickname'];

        $sql="UPDATE users SET vorname = '$vorname', nachname = '$nachname', nickname= '$nickname' WHERE  id = '$sess' ";
        $update = $pdo->prepare($sql);
        $update->execute();
   }

?>

    <div>
        <?php
        $statement = $pdo->query("SELECT * FROM users WHERE id = '$sess' ");
        $user = $statement->fetch();

        $vorname= $user['vorname'];
        $nachname= $user['nachname'];
        $email= $user['email'];
        $nickname= $user['nickname'];

        echo "Vorname :". $vorname;
        echo "Nachname :". $nachname;
        echo "Email :". $email;
        echo "Nickname :". $nickname;
        ?>
    </div>

</body>
</html>

<?php

?>