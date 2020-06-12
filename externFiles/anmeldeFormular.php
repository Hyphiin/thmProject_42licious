<link href="../css/forms_css/anmeldeFormular.css" rel="stylesheet" type="text/css">
<link href="../css/general.css" rel="stylesheet" type="text/css">


<div class = anmeldefo>

    <div class="ueberschrift">Anmeldung</div>

    <div class="form">
        <form action="" method="post">

            <div class="textfeld">
            <label for="email">E-Mail:</label>
                <input type="email" name="email" id="email"/>
            </div>
            <div class="textfeld">
            <label for="pw">Passwort:</label>
                <input type="text" name="passwort" id="pw">
            </div>

            <button class="button" id="pwVergessenButton">Passwort vergessen?</button>
            <button class="button">Anmelden</button>
            <button class="button">Abbrechen</button> </br>
            <label for="registrierenButton">Noch keinen Account?</label>
               <a href="registrierung.php"><button class="button" id="registrierenButton">Registrieren</button> </a>
        </form>
    </div>

</div>
