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

    <title>42licious - Passwort ändern</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/navigation.css" rel="stylesheet" type="text/css">
    <link href="../css/forms_css/anmeldeFormular.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="website">

    <?php include("Navigation.php"); ?>

    <div id="main">


        <div id="main-content">

<?php
if($sess) {
    $showFormular = true;
}else{
    echo '<script>window.location.replace("index.php")</script>';
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
            echo 'Passwort inkorrekt';
        }
    }
}

if ($showFormular) {
    ?>


                <div id="head-title">
                    <h1>Passwort Ändern</h1>
                </div>
                <div id="form">
                <form action="?Speichern" method="post" id="pw">

                    <div class="textfeld">
                        Aktuelles Passwort:<br/>
                        <input type="password" name="aktuell" id="aktuell" size="40"/>
                    </div>
                    <div class="textfeld">
                        Neues Passwort:<br/>
                        <input type="password" name="passwort" id="neu" size="40"/>
                    </div>
                    <div class="textfeld">
                        Passwort bestätigen:<br/>
                        <input type="password" name="passwort2" id="bestätigen" size="40"/>

                    </div>
                </form>
                <div>
                    <br/>
                    <input type="submit" form="pw"  class="button" value="Speichern"/>
                   <?php echo '<a href="ProfilAnsicht.php?id='.$sess.'"><button type="button" class="button">Abbrechen</button></a>'; ?>
                </div>
                </div>
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