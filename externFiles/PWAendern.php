<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Registrierung</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/forms_css/anmeldeFormular.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
if($sess) {
    $showFormular = true;
}

if (isset($_GET['Speichern'])) {
    $error = false;
    $aktuell = $_POST['aktuell'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if (strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if ($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    if(!$error){
        $check = $pdo->query("SELECT * FROM users WHERE id = '$sess'");
        $user = $check->fetch();
        if ($user !== false && password_verify($aktuell, $user['passwort'])) {
            $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
            $statement = $pdo->query("UPDATE users SET passwort = '$passwort_hash' WHERE id = '$sess'");
            die(include 'PWErfolgreichGeaendert.php');
        }
        else{
            die(include 'PWAenderFehler.php');
        }
    }
}

if ($showFormular) {
    ?>
    <div id="website">

        <?php include("Navigation.php"); ?>

        <div id="main">

            <div id="top-buttons">

                <a href="javascript:history.back()"><button class="button">Zurück</button></a>

            </div>

            <div id="main-content">

                <div id="head-title">
                    <h1>Passwort Ändern</h1>
                </div>

                <form action="?Speichern" method="post">

                    <div class="textfeld">
                        <label for="aktuell">Aktuelles Passwort:</label>
                        <input type="password" name="aktuell" id="aktuell"/>
                    </div>
                    <div class="textfeld">
                        <label for="neu">Neues Passwort:</label>
                        <input type="password" name="passwort" id="neu"/>
                    </div>
                    <div class="textfeld">
                        <label for="bestätigen">Passwort bestätigen:</label>
                        <input type="password" name="passwort2" id="bestätigen"/>
                    </div>

                    <input type="submit" class="button" value="Speichern"/>
                    <button class="button">Abbrechen</button>

                </form>
            </div>
        </div>
    </div>

    <?php
} //Ende von if($showFormular)
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
<script>
    gsap.from("#main",{y:15});
</script>

</body>
</html>