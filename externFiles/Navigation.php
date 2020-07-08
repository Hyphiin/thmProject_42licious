<?php
$pdo = new PDO('mysql:host=localhost;dbname=42licious', 'root', '');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sess = $_SESSION['userid'];

?>

<div class="navbar-links" xmlns="">
    <a href="index.php">
        <img alt="Logo-Links-Navbar" class="logo" src="../images/42licious_bearbeitet.png">
    </a>

    <div class="searchBar">
        <form class="search" action="Suche.php" method="get">
            <select class="selection" name="selection">
                <option value="rezepte" name="rezepte">in Rezepten</option>
                <option value="users" name="users">in Nutzern</option>
            </select>
            <input type="text" placeholder="Suchen..." name="suchbegriff">
            <button class="submitBtn" type="submit" value="suchen">
                <img src="../images/searchIcon.png" alt="SearchIcon">
            </button>
            <button id="modalBtn" class="modalBtn" type="button" onclick="recipeModalOpen()">
                <img src="../images/angleDown.png" alt="ModalIconForSearchFilter">
            </button>
        </form>
    </div>


    <?php
    $statement = $pdo->query("SELECT pic FROM users WHERE id= '$sess'");
    $user = $statement->fetch();
    $pic = $user['pic'];


    ?>

    <div class="dropdown">
        <button onclick="dropdown()" class="dropbtn"><?php
            if (isset($pic)) {
                echo "<img alt='Profil-Bild' id='profil_bild' src='../images/profile/$pic'>";
            } else {
                echo '<img alt="Profil-Bild" id="profil_bild" src="../images/profile/profileIcon.png">';
            }
            ?>
        </button>
        <div id="myDropdown" class="dropdown-content">
            <?php
            if (!isset($sess)) {
                echo "<a href='AccLogin.php'>Login</a>";
                echo "<a href='AccRegistrieren.php'>Register</a>";
            }
            ?>
            <?php
            if (isset($sess)) {
                echo "<a href='AccLogout.php'>Logout</a>";
            }
            ?>
        </div>
    </div>

    <ul class="content" id="b">
        <?php
        echo '<li><a href="Kochbuch.php?nutzer=' . $sess . '">Kochbuch</a></li>';
        echo '<li><a href="BlogUser.php?nutzer=' . $sess . '">Blog</a></li>';
        echo '<li><a href="ProfilAnsicht.php?id=' . $sess . '">Profil</a></li>';
        ?>
    </ul>


    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h2>Rezeptfilter</h2>
            </div>

            <div class="modal-body">
                <form id="filterSuche" action="SucheFilter.php" method="get">

                    Kategorien:<br/>
                    <label for="fleisch">
                        <input type="checkbox" id="fleisch" name="fleisch" value="1">
                        <span>Fleisch</span>
                    </label>
                    <label for="vegetarisch">
                        <input type="checkbox" id="vegetarisch" name="vegetarisch" value="1">
                        <span>Vegetarisch</span>
                    </label>
                    <label for="vegan">
                        <input type="checkbox" id="vegan" name="vegan" value="1">
                        <span>Vegan</span>
                    </label>
                    <br/><br/>
                    Zutaten (max 1 pro Feld):<br/>
                    <input type="text" id="zutat" name="zutat" placeholder="Zutat eingeben...">
                    <br>
                    <input type="text" id="zutat2" name="zutat2" placeholder="Zutat eingeben...">


                    <p>
                        max Dauer:<br/>
                        <input type="number" name="zeit"/>
                        Minuten
                    </p>
                    <p>

                        max Schwierigkeit:
                        <select name="schwierigkeit">
                            <option value="Auswahl">Auswahl</option>
                            <option value="leicht">Leicht</option>
                            <option value="mittel">Mittel</option>
                            <option value="schwer">Schwer</option>
                            <option value="sehrschwer">Sehr Schwer</option>
                        </select>
                    </p>
                    Suchbegriff:<br/>
                    <input type="text" placeholder="Suchenbegriff eingeben..." name="suchbegriff">
                    <br/>


                </form>
            </div>
            <div class="modal-footer">
                <button class="modalCloseBtn" type="submit" form="filterSuche">Suchen</button>
                <button class="modalCloseBtn" type="button" onclick="recipeModalClose()">Abbrechen</button>
            </div>
        </div>
    </div>


</div>

<script src="../jscript/navigation.js"></script>
<script src="../jscript/recipeModal.js"></script>
<script>
    let x = document.getElementById("zutat");
    let y = document.getElementById("zutat2");
    x.onchange = function () {
        if (x.value != "") {
            y.style.display = "block";
        } else {
            y.style.display = "none";
        }
    }
</script>
