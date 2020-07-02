<?php
do {
    $statement = $pdo->query("SELECT * FROM rezepte ORDER BY RAND() DESC LIMIT 1");
    $rezept = $statement->fetch();
    $rezeptID = $rezept['rid'];
}while($check1==$rezeptID OR $check2==$rezeptID);

$title = $rezept['titel'];
$timestamp = $rezept['cdate'];
$pic = $rezept['pic'];
$kategorienListe = $rezept['kategorien'];
$dauer = $rezept['dauer'];
$schwierigkeit = $rezept['schwierigkeit'];
$beschreibung = $rezept['beschreibung'];
$bewertung = $rezept['gesamtBewertung'];
if($bewertung==0){
    $bewertung = "Keine Bewertungen";
}elseif($bewertung==1){
    $bewertung.=" Stern";
}else{
    $bewertung.=" Sterne";
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
        echo '<div>Fleisch</div>';
    }elseif($kategorie[$i]=="vegetarisch"){
        echo '<div>Vegetarisch</div>';
    }elseif($kategorie[$i]=="vegan"){
        echo '<div>Vegan</div>';
    }}
echo '</div>';
echo '<div class="titleTime">';
echo '<h2 class="recipe-preview-title">' . $title . '</h2>';
echo '</div>';
echo 'Bewertung: '.$bewertung.'<br/>';
echo 'Dauer: '.$dauer.' Minuten<br/>';
echo 'Schwierigkeit: '.$schwierigkeit.'<br/><br/>';
echo    nl2br($beschreibung);
echo '<br/><br/>';
echo '</div>';

echo '</div>';
echo '</div>';
echo '</a>';
?>