<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

$sess = $_SESSION['userid'];

if($sess== true){
?>
<!DOCTYPE html>
<head>
<link href="../css/forms_css/anmeldeFormular.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class = anmeldefo>

    <div class="form">
        <form action="?delete=1" method="post">

            <div class="text">
                Account unwiederruflich löschen?
            </div>

            <button class="button" type="submit" name="delete">LÖSCHEN!</button>

        </form>
    </div>

    <?php

    if(isset($_GET['delete'])){
        $statement = $pdo->query("DELETE FROM users WHERE id= '$sess'");
        session_destroy();
        echo "Löschen erfolgreich!";
        echo '<a href='.'index.php'.'>Startseite</a>';
    }
    }
    else{
        echo"Bitte einloggen!". " ". '<a href="login.php">zum Login</a>';
        echo'<br>';
        echo"Noch kein Mitglied?". " ". '<a href="registrieren.php">Mitglied werden!</a>';
    }

    ?>

</div>
</body>
</html>