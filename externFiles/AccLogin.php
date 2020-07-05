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
        die(include 'AccLoginAnzeige.php');
    } else {
        die(include 'AccLoginFehlerAnzeige.php');
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
    <link href="../css/forms_css/anmeldeFormular.css" rel="stylesheet" type="text/css">
</head>
<body>


<?php
if (isset($errorMessage)) {
    echo $errorMessage;
}
?>

<div id="website">

    <?php include("Navigation.php"); ?>

    <div id="main">

        <div id="top-buttons">

            <a href="javascript:history.back()"><button class="button">Zurück</button></a>

        </div>



        <div id="main-content">

            <div id="head-title">
                <h1>Login</h1>
            </div>

            <form action="?login=1" method="post">
                E-Mail:<br>
                <input type="email" size="40" maxlength="250" name="email"><br><br>

                Dein Passwort:<br>
                <input type="password" size="40" maxlength="250" name="passwort"><br>

                <input type="submit" class="button" value="Abschicken">
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
<script>
    gsap.from("#main",{y:15});
</script>

</body>
</html>
