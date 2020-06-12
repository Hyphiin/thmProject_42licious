<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-BlogErstellen</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/blog_css/blogErstellen.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="website">

    <div id="main">

        <div id="create-blog">
            <h1>Blogeintrag erstellen</h1>

            <form id="blog-erstellen">
                <label for="titel">Titel:</label>
                <input type="text" name="titel" id="titel" size="40" placeholder="Titel eingeben..."><br/>
                <br/>
                <label for="blog-inhalt">Inhalt:</label><br/>
            </form>

            <textarea rows="20" maxlength="2000" name="blog-inhalt" form="blog-erstellen" id="blog-inhalt" placeholder="Inhalt eingeben..."></textarea>

        </div>

        <div id="bottom-buttons">
            <a href="blogUSER.php"><button class="button" id="cancel">Abbrechen</button></a>
            <a href="blogErstellen.php"><button class="button" id="create">Erstellen</button></a>

        </div>

    </div>
</div>

</body>
</html>