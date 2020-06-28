<?php

$host_name = "localhost";
$database = "42licious";
$user_name = "root";
$password = "";

$db = mysqli_connect($host_name, $user_name, $password, $database);


if (mysqli_connect_errno() == 0)
{
    $sql = "SELECT rezept.name,users.vorname,rezept.bewertung,rezept.pic FROM `rezept`, `users` WHERE rezept.user = users.id";
    $ergebnis = $db->query($sql);
    if (is_object($ergebnis))
    {
        while ($zeile = $ergebnis->fetch_object())
        {

            echo '<a href="rezeptAnsicht.php">';
            echo '<div class="recipe-preview-container">';
            echo '<div class="recipe-preview">';
            echo '<diV class="recipe-preview-image-container">';
            echo '<img alt="Rezept_Bild_Vorschau" src='."$zeile->pic".'>';
            echo '</diV>';
            echo '<div class="recipe-preview-description">';
            echo '<div class="recipe-name-author">';
            echo '<h3>'.$zeile->name.'</h3>';
            echo '<h5>von '.$zeile->vorname.'</h5>';
            echo '</div>';
            echo '<div class="recipe-rating">';
            echo ' </div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
        }
    }
}




