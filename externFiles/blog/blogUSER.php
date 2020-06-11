<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>42licious-BlogUSER</title>
    <link href="../../css/general.css" rel="stylesheet" type="text/css">
    <link href="../../css/blog_css/blogUSER.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="website">

    <?php include("../navigation.php"); ?>

    <div id="main">

        <div id="bloglist-user">

            <div id="head-title">
                <h1>Blog von USER</h1>
            </div>

            <div id="top-buttons">
                    <a href="blogErstellen.php"><button class="button" id="b-create-blog">Blogeintrag erstellen</button></a>
                     <div>
                        <label for="filter">Sortieren nach:</label>
                        <select id="filter" name="filter">
                            <option value="name">Name</option>
                            <option value="date">Datum</option>
                         </select>
                    </div>

            </div>

            <div id="blog-list">

                <div class="blog-preview">
                    <div class="blog-preview-head">
                        <h2 class="blog-preview-title">Titel</h2>
                        <p class="blog-preview-timestamp">TT.MM.JJ SS:MM</p>
                    </div>
                    <div class="blog-preview-body">
                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pellentesque dignissim ipsum id placerat.
                            Aenean egestas lacus et quam varius, sit amet hendrerit lorem rutrum. Morbi feugiat velit quis pretium auctor.
                            Praesent a magna vel mauris interdum bibendum et sit amet augue. Aliquam blandit, diam nec elementum vehicula,
                            lorem sem mollis libero, at pellentesque nunc nibh et lorem. Cras ac facilisis quam. Donec laoreet nisi at purus venenatis,
                            a auctor tellus mattis...
                        </p>
                    </div>

                </div>

                <div class="blog-preview">
                    <div class="blog-preview-head">
                        <h2 class="blog-preview-title">Titel</h2>
                        <p class="blog-preview-timestamp">TT.MM.JJ SS:MM</p>
                    </div>
                    <div class="blog-preview-body">
                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pellentesque dignissim ipsum id placerat.
                            Aenean egestas lacus et quam varius, sit amet hendrerit lorem rutrum. Morbi feugiat velit quis pretium auctor.
                            Praesent a magna vel mauris interdum bibendum et sit amet augue. Aliquam blandit, diam nec elementum vehicula,
                            lorem sem mollis libero, at pellentesque nunc nibh et lorem. Cras ac facilisis quam. Donec laoreet nisi at purus venenatis,
                            a auctor tellus mattis...
                        </p>
                    </div>

                </div>

                <div class="blog-preview">
                    <div class="blog-preview-head">
                        <h2 class="blog-preview-title">Titel</h2>
                        <p class="blog-preview-timestamp">TT.MM.JJ SS:MM</p>
                    </div>
                    <div class="blog-preview-body">
                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pellentesque dignissim ipsum id placerat.
                            Aenean egestas lacus et quam varius, sit amet hendrerit lorem rutrum. Morbi feugiat velit quis pretium auctor.
                            Praesent a magna vel mauris interdum bibendum et sit amet augue. Aliquam blandit, diam nec elementum vehicula,
                            lorem sem mollis libero, at pellentesque nunc nibh et lorem. Cras ac facilisis quam. Donec laoreet nisi at purus venenatis,
                            a auctor tellus mattis...
                        </p>
                    </div>

                </div>

             </div>

            <div id="bottom-buttons">
                 <button class="button" id="show-more">Mehr anzeigen</button>

            </div>

        </div>




    </div>

</div>

</body>
</html>
