<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-Profil-Bearbeitung</title>
    <link href="../../css/general.css" rel="stylesheet" type="text/css">
    <link href="../../css/profil_css/profil_edit.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="website">
    <div id="main">
        <div id="top-buttons">
            <a href="profil_ansicht.php"><button class="button">Zurück</button></a>
        </div>
        <div id="main-content">
            <div id="profil-title">
                <h1>Profil bearbeiten</h1>
            </div>
            <div id="profil_inhalt">
                <div id="Picture">
                    <img id="profilpic" alt="Profil-Bild" src="shindy.jpg">

                    <form action="form.php" method="post">
                        <input type="file" value="Datei auswählen" id="profil_pic">
                        <input type="submit" value="Hochladen" />
                    </form>
                </div>

                <label for="vorname">Vorname</label>
                <input type="text" maxlength="25" id="vorname" placeholder="Vorname">

                <label for="nachname">Nachname</label>
                <input type="text" maxlength="25" id="nachname" placeholder="Nachname">

                <label for="birthday">Geburtsdatum</label>
                <div id="birthday">
                    <select id="TT" size="1">
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                        <option>31</option>
                    </select>
                    <select id="MM" size="1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                    </select>
                    <select id="JJ" size="1">
                        <option>2020</option>
                        <option>2019</option>
                        <option>2018</option>
                        <option>2017</option>
                        <option>2016</option>
                        <option>2015</option>
                        <option>2014</option>
                        <option>2013</option>
                        <option>2012</option>
                        <option>2011</option>
                        <option>2010</option>
                        <option>2009</option>
                        <option>2008</option>
                        <option>2007</option>
                        <option>2006</option>
                        <option>2005</option>
                        <option>2004</option>
                        <option>2003</option>
                        <option>2002</option>
                        <option>2001</option>
                        <option>2000</option>
                        <option>1999</option>
                        <option>1998</option>
                        <option>1997</option>
                        <option>1996</option>
                        <option>1995</option>
                        <option>1994</option>
                        <option>1993</option>
                        <option>1992</option>
                        <option>1991</option>
                        <option>1990</option>
                        <option>1989</option>
                        <option>1988</option>
                        <option>1987</option>
                        <option>1986</option>
                        <option>1985</option>
                        <option>1984</option>
                        <option>1983</option>
                        <option>1982</option>
                        <option>1981</option>
                        <option>1980</option>
                        <option>1979</option>
                        <option>1978</option>
                        <option>1977</option>
                        <option>1976</option>
                        <option>1975</option>
                        <option>1974</option>
                        <option>1973</option>
                        <option>1972</option>
                        <option>1971</option>
                        <option>1970</option>
                        <option>1969</option>
                        <option>1968</option>
                        <option>1967</option>
                        <option>1966</option>
                        <option>1965</option>
                        <option>1964</option>
                        <option>1963</option>
                        <option>1962</option>
                        <option>1961</option>
                        <option>1960</option>
                        <option>1959</option>
                        <option>1958</option>
                        <option>1957</option>
                        <option>1956</option>
                        <option>1955</option>
                        <option>1954</option>
                        <option>1953</option>
                        <option>1952</option>
                        <option>1951</option>
                        <option>1950</option>
                        <option>1949</option>
                        <option>1948</option>
                        <option>1947</option>
                    </select>
                </div>

                <label for="namensanzeige">Namensanzeige</label>
                <select id="namensanzeige" size="1">
                    <option>Voller Name</option>
                    <option>Nur Vorname</option>
                    <option>Vorname + Initiale</option>
                </select>



                <label for="beschreibung">Beschreibung</label>
                <textarea id="beschreibung" cols="50" rows="4"></textarea>

                <div id="bottom-buttons">
                    <a href="profil_edit.php"><button>Abbrechen</button></a>
                    <button>Änderungen Speichern</button>
                </div>

            </div>
    </div>
    </div>
</div>
</body>
</html>