<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>42licious-BlogBearbeiten</title>
    <link href="../../css/general.css" rel="stylesheet" type="text/css">
    <link href="../../css/blog_css/blogBearbeiten.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="website">

    <div id="main">

        <div id="edit-blog">
            <h1>Blogeintrag bearbeiten</h1>

            <form id="blog-bearbeiten">
                <label for="titel">Titel:</label>
                <input type="text" name="titel" id="titel" size="40" value="Titel"><br/>
                <br/>
                <label for="blog-inhalt">Inhalt:</label><br/>
            </form>

            <textarea rows="20" maxlength="2000" name="blog-inhalt" form="blog-erstellen" id="blog-inhalt">Blog Inhalt...</textarea>

        </div>

        <div id="bottom-buttons">
            <div>
            <button class="button" id="delete">Eintrag löschen</button>
            </div>
            <div>
            <button class="button" id="cancel">Abbrechen</button>
            <button class="button" id="save">Speichern</button>
            </div>

        </div>

    </div>
</div>

</body>
</html>
