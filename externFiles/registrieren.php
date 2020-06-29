<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Registrierung</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/forms_css/anmeldeFormular.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if (isset($_GET['register'])) {
    $error = false;
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $email = $_POST['email'];
    $nickname = $_POST['nickname'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $pic = $_POST['pic'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if (strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if ($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if (!$error) {
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if ($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
    }

    //Keine Fehler, wir können den Nutzer registrieren
    if (!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("INSERT INTO users (vorname, nachname, email, nickname, passwort, pic) VALUES (:vorname ,:nachname, :email, :nickname, :passwort, :pic)");
        $result = $statement->execute(array('vorname' => $vorname, 'nachname' => $nachname, 'email' => $email, 'nickname' => $nickname, 'passwort' => $passwort_hash, 'pic' => $pic));

        if ($result) {
            die(include "registriertAnzeige.php");
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}

if ($showFormular) {
    ?>
    <div id="website">

        <?php include("navigation.php"); ?>

        <div id="main">

            <div id="top-buttons">

                <a href="index.php"><button class="button">Zurück</button></a>

            </div>

            <div id="main-content">
                <form action="?register=1" method="post">
                    Vorname:<br>
                    <input type="text" size="40" maxlength="250" name="vorname"><br><br>

                    Nachname:<br>
                    <input type="text" size="40" maxlength="250" name="nachname"><br><br>

                    E-Mail:<br>
                    <input type="email" size="40" maxlength="250" name="email"><br><br>

                    Nickname:<br>
                    <input type="text" size="40" maxlength="250" name="nickname"><br><br>

                    Dein Passwort:<br>
                    <input type="password" size="40" maxlength="250" name="passwort"><br>

                    Passwort wiederholen:<br>
                    <input type="password" size="40" maxlength="250" name="passwort2"><br><br>

                    Profil-Bild einfügen:<br>
                    <input type="file" accept="image/*" name="pic"/><br><br>

                    <input type="submit" value="Abschicken">
                </form>
            </div>
        </div>
    </div>

    <?php
} //Ende von if($showFormular)
?>

</body>
</html>