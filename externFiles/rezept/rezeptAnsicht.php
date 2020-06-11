<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>42licious-RezeptAnsicht</title>

    <link href="../../css/rezept_css/rezeptAnsicht.css" rel="stylesheet" type="text/css">



</head>
<body>
<div id="website">

    <?php include("../navigation.php"); ?>

    <div id="main">

        <div id="top-buttons">

            <a href="../../rezepteSuchen.php"><button class="button">Zurück zur Suche</button></a>
            <a href="rezeptBearbeiten.php"><button class="button">Bearbeiten</button></a>

        </div>

        <div id="main-content">

            <div id="recipe-info">
                <div id="recipe-title">
                    <h1>Rezeptname</h1>
                </div>
                <div id="timestamp">
                    <p>TT.MM.JJ SS:MM</p>
                </div>
            </div>

            <div id="creator">
                <h5>von:...</h5>
            </div>

            <div class="recipe-preview">
                <diV class="recipe-preview-image-container">
                    <img src="images/lasagne.jpg" alt="">
                </diV>
                <div class="recipe-preview-description"></div>
            </div>

            <div id="recipe-rating">

                <div id="stars">
                    <p class="sternebewertung">
                        <input type="radio" id="stern5" name="bewertung" value="5"><label for="stern5" title="5 Sterne">5 Sterne</label>
                        <input type="radio" id="stern4" name="bewertung" value="4"><label for="stern4" title="4 Sterne">4 Sterne</label>
                        <input type="radio" id="stern3" name="bewertung" value="3"><label for="stern3" title="3 Sterne">3 Sterne</label>
                        <input type="radio" id="stern2" name="bewertung" value="2"><label for="stern2" title="2 Sterne">2 Sterne</label>
                        <input type="radio" id="stern1" name="bewertung" value="1"><label for="stern1" title="1 Stern">1 Stern</label>
                        <span id="Bewertung" title="Keine Bewertung">
                        Bewertung:
                        </span>
                    </p>

                </div>

                <div id="like">
                    <p class="merken">
                        <input type="radio" id="like" name="like" value="like"><label for="like" title="Rezept merken"></label>
                        <span id="Merken">
                        Merken:
                        </span>
                    </p>
                </div>

            </div>

            <div id="dauer">Dauer: 50min</div>
            <div id="schwierigkeit">Schwierigkeit: mittel</div>

        <div id="beschreibung">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pellentesque dignissim ipsum id placerat.
                    Aenean egestas lacus et quam varius, sit amet hendrerit lorem rutrum. Morbi feugiat velit quis pretium auctor.
                    Praesent a magna vel mauris interdum bibendum et sit amet augue. Aliquam blandit, diam nec elementum vehicula,
                    lorem sem mollis libero, at pellentesque nunc nibh et lorem. Cras ac facilisis quam. Donec laoreet nisi at purus venenatis,
                    a auctor tellus mattis. Aliquam erat volutpat. Pellentesque ac neque ac dui tincidunt fringilla. Duis in elementum felis,
                    sit amet porttitor ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Interdum et malesuada fames ac ante
                    ipsum primis in faucibus.
                </p>
            </div>


        <div id="zutaten">
            <h3>Zutaten für
            <select name="numbers" id="numbers">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
                Personen</h3>


            <div id="table">
                <table style="width:100%">
                    <tr>
                        <td>100 ml</td>
                        <td>Wasser</td>
                    </tr>
                    <tr>
                        <td>500 g</td>
                        <td>Mehl</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Eier</td>
                    </tr>
                    <tr>
                        <td>1/4 TL</td>
                        <td>Backpulver</td>
                    </tr>
                    <tr>
                        <td>...</td>
                        <td>...</td>
                    </tr>
                </table>

            </div>
            <h3>Zubereitung</h3>
            <div id="zubereitung">
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pellentesque dignissim ipsum id placerat.
                Aenean egestas lacus et quam varius, sit amet hendrerit lorem rutrum. Morbi feugiat velit quis pretium auctor.
                Praesent a magna vel mauris interdum bibendum et sit amet augue. Aliquam blandit, diam nec elementum vehicula,
                lorem sem mollis libero, at pellentesque nunc nibh et lorem. Cras ac facilisis quam. Donec laoreet nisi at purus venenatis,
                a auctor tellus mattis. Aliquam erat volutpat. Pellentesque ac neque ac dui tincidunt fringilla. Duis in elementum felis,
                sit amet porttitor ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Interdum et malesuada fames ac ante
                ipsum primis in faucibus.
                </p>
            </div>
        </div>

        <div id="comments">
            <h3>Kommentare</h3>
            <a href="../kommentare/kommentar_schreiben.php"><button class="button">Kommentar schreiben</button></a>
        </div>
</div>


</body>
</html>
