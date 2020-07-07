<?php
$rezeptID= $rezept['rid'];
$title = $rezept['titel'];
$timestamp = $rezept['cdate'];
$pic = $rezept['pic'];
$kategorienListe = $rezept['kategorien'];
$dauer = $rezept['dauer'];
$schwierigkeit = $rezept['schwierigkeit'];
$beschreibung = $rezept['beschreibung'];
$bewertung = $rezept['gesamtBewertung'];

$Wertung="";
$Wertung1="";
$Wertung2="";
$Wertung3="";
$Wertung4="";
$Wertung5="";
if ($bewertung>0) {
    $Wertung = round($bewertung);
}
if ($Wertung == 5) {
    $Wertung5 = "checked";
} elseif ($Wertung == 4) {
    $Wertung4 = "checked";
} elseif ($Wertung == 3) {
    $Wertung3 = "checked";
} elseif ($Wertung == 2) {
    $Wertung2 = "checked";
} elseif ($Wertung == 1) {
    $Wertung1 = "checked";
}

echo '<a href="RezeptAnsicht.php?id='.$rezeptID.'">';
    echo '<div class="recipe-preview-container">';
        echo '<div class="recipe-preview">';
            echo '<div class="recipe-preview-pic">';
                echo '<img alt="Rezept-Vorschau" class="recipe-pic" src="../images/rezepte/'.$pic.'">';
                echo '</div>';
            echo '<div class="recipe-preview-info">';
                echo '<div class="kategorien">';
                    $kategorie = explode(";", $kategorienListe);

                    for($i=0;$i<count($kategorie);$i++){
                    if($kategorie[$i]=="fleisch"){
                    echo '<div id="fleischkat">Fleisch</div>';
                    }elseif($kategorie[$i]=="vegetarisch"){
                    echo '<div id="vegetarischkat">Vegetarisch</div>';
                    }elseif($kategorie[$i]=="vegan"){
                    echo '<div id="vegankat">Vegan</div>';
                    }}
                    echo '</div>';
                echo '<div class="titleTime">';
                    echo '<div class="timestamp-container"><p class="recipe-preview-timestamp">' . substr($timestamp,0,10) . '</p></div>';
                    echo '<div class="title-container"><h2 class="recipe-preview-title">' . $title . '</h2></div>';
                    echo '</div>';
                        echo '<div id="recipe-rating">
    
                <form id="stars" method="post" action="">
                    <p class="sternebewertung">               
                        <input type="radio" id="stern5" name="bewertung" value="5" ' . $Wertung5 . ' disabled><label for="stern5" title="5 Sterne">5 Sterne</label>
                        <input type="radio" id="stern4" name="bewertung" value="4" ' . $Wertung4 . ' disabled><label for="stern4" title="4 Sterne">4 Sterne</label>
                        <input type="radio" id="stern3" name="bewertung" value="3" ' . $Wertung3 . ' disabled><label for="stern3" title="3 Sterne">3 Sterne</label>
                        <input type="radio" id="stern2" name="bewertung" value="2" ' . $Wertung2 . ' disabled><label for="stern2" title="2 Sterne">2 Sterne</label>
                        <input type="radio" id="stern1" name="bewertung" value="1" ' . $Wertung1 . ' disabled><label for="stern1" title="1 Stern">1 Stern</label>
                    </p>   
                    ('.round($bewertung,1).')             
                    </form>
                </div>';
                echo '<br/><br/>Dauer: '.$dauer.' Minuten<br/>';
                echo 'Schwierigkeit: '.$schwierigkeit.'<br/><br/>';
                echo  '<p id="beschreibung">'.nl2br(substr($beschreibung,0,80)).'</p>'  ;
                echo '<br/><br/>';
                echo '</div>';

            echo '</div>';
        echo '</div>';
    echo '</a>';




