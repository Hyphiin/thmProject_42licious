<?php
$statement1 = $pdo->query("SELECT COUNT(*) FROM rezepte");
$zwischenspeicher = $statement1->fetch();
$anzahlRezepte = intval($zwischenspeicher[0]);
do {
    $random = rand(1,$anzahlRezepte);
    $statement = $pdo->query("SELECT * FROM rezepte WHERE rid = '$random' ORDER BY rid DESC LIMIT 1");
    $rezept = $statement->fetch();
}while(empty($rezept));

$rezeptID= $rezept['rid'];
$title = $rezept['titel'];
$timestamp = $rezept['cdate'];
$kategorienListe = $rezept['kategorien'];
$dauer = $rezept['dauer'];
$schwierigkeit = $rezept['schwierigkeit'];
$beschreibung = $rezept['beschreibung'];

echo '<a href="RezeptAnsicht.php?id='.$rezeptID.'">';
echo '<div class="recipe-preview-container">';
echo '<div class="recipe-preview">';
echo '<div class="recipe-preview-pic">';
echo '<img alt="Rezept-Vorschau" class="recipe-pic" src="">';
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
echo 'Dauer: '.$dauer.' Minuten<br/>';
echo 'Schwierigkeit: '.$schwierigkeit.'<br/><br/>';
echo    nl2br($beschreibung);
echo '</p>';
echo '</div>';

echo '</div>';
echo '</div>';
echo '</a>';
?>