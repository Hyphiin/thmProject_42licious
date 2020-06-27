<div class="navbar-links" xmlns="">
    <a href="index.php">
        <img alt="Logo-Links-Navbar" class="logo" src="../images/42licious_bearbeitet.png">
    </a>

    <div class="searchBar">
        <form class="search" action="profile_gefiltert.php" method="get">
            <select class="selection" onchange="location = this.value;">
                <option value="recipe">in Rezepten</option>
                <option value="profile_anzeigen.php">in Nutzern</option>
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

    <div class="dropdown">
        <button onclick="dropdown()" class="dropbtn">
            <img src="../images/profile/profileIcon.png">
        </button>
        <div id="myDropdown" class="dropdown-content">
            <a href="login.php">Login</a>
            <a href="registrieren.php">Register</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <ul class="content" id="b">
        <li><a href="kochbuch.php">Kochbuch</a></li>
        <li><a href="blogUSER.php">Blog</a></li>
        <li><a href="profil_ansicht.php">Profil</a></li>
    </ul>


    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h2>Rezeptfilter</h2>
            </div>

            <div class="modal-body">
                <form action="" method="post">

                    <label for="vegetarisch">
                        <input type="checkbox" id="vegetarisch" name="dietType[]" value="vegetarisch">
                        <span>Vegetarisch</span>
                    </label>
                    <label for="laktosefrei">
                        <input type="checkbox" id="laktosefrei" name="dietType[]" value="laktosefrei">
                        <span>Laktosefrei</span>
                    </label>
                    <label for="vegan">
                        <input type="checkbox" id="vegan" name="dietType[]" value="vegan">
                        <span>Vegan</span>
                    </label>
                    <label for="sonstiges">
                        <input type="checkbox" id="sonstiges" name="dietType[]" value="sonstiges">
                        <span>Sonstiges</span>
                    </label>
                    
                    <p>
                        <select>
                            <option value="time15">15</option>
                            <option value="time30">30</option>
                            <option value="time45">45</option>
                            <option value="time60">60</option>
                            <option value="time120">120</option>
                        </select>

                    </p>
                    <p>
                        <select>
                            <option value="difficultyEasy">Leicht</option>
                            <option value="difficultyNormal">Mittel</option>
                            <option value="difficultyHard">Schwer</option>
                        </select>
                    </p>

                    <button class="modalApplyBtn" formaction="" type="submit">Speichern</button>

                </form>
            </div>
            <div class="modal-footer">
                <button class="modalCloseBtn" type="button" onclick="recipeModalClose()">Abbrechen</button>
            </div>
        </div>
    </div>


</div>
