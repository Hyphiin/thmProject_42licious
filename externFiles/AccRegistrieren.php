<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if (isset($_GET['register'])) {
    $error = false;
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $email = $_POST['email'];
    $nickname = $_POST['nickname'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

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

    if($_FILES['pic']['error']!=4){
        $errors= array();
        $file_name = $_FILES['pic']['name'];
        $file_size = $_FILES['pic']['size'];
        $file_tmp =$_FILES['pic']['tmp_name'];
        $file_type=$_FILES['pic']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['pic']['name'])));

        $extensions= array("jpeg","jpg","png");

        if($file_name=="standard.png"){
            $errors[]="Bitte Dateinamen ändern.";
        }

        if(in_array($file_ext,$extensions)=== false){
            $errors[]="Dateiendung nicht erlaubt, bitte wähle eine JPEG oder PNG Datei.";
        }

        if($file_size > 2097152){
            $errors[]='Dateigröße darf 2MB nicht überschreiten!';
        }

        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"../images/profile/".$file_name);
        }else{
            print_r($errors);
            $error = true;
        }
    }
    else{
        $file_name="standard.png";
    }

    //Keine Fehler, wir können den Nutzer registrieren
    if (!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        global $file_name;
        $statement = $pdo->query("INSERT INTO users (vorname, nachname, email, nickname, passwort, pic) VALUES ('$vorname', '$nachname', '$email', '$nickname', '$passwort_hash', '$file_name')");
        if (!empty($statement)) {
            die(include "AccRegistriertAnzeige.php");
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
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
                    <h1>Registrierung</h1>
                </div>

                <div id="form">
                <form action="?register=1" method="post" enctype="multipart/form-data">
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

                    <input type="submit" class="button" value="Registrieren">
                </form>
                </div>
            </div>
        </div>
    </div>

    <?php
} //Ende von if($showFormular)
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
<script>
    gsap.from("#main",{y:20});
</script>

</body>
</html>