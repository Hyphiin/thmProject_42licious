<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

if (isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="index.php">internen Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Login</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/form_css/anmeldeFormular.css" rel="stylesheet" type="text/css">
</head>
<body>


<?php
if (isset($errorMessage)) {
    echo $errorMessage;
}
?>
<div id="website">

    <?php include("navigation.php"); ?>

    <div id="main">

        <div id="top-buttons">

            <a href="index.php"><button class="button">Zurück</button></a>

        </div>

        <div id="main-content">
            <form action="?login=1" method="post">
                E-Mail:<br>
                <input type="email" size="40" maxlength="250" name="email"><br><br>

                Dein Passwort:<br>
                <input type="password" size="40" maxlength="250" name="passwort"><br>

                <input type="submit" value="Abschicken">
            </form>
        </div>
    </div>
</div>
</body>
</html>
