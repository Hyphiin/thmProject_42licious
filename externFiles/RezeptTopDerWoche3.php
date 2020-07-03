<?php
$statement = $pdo->query("SELECT * FROM rezepte ORDER BY gesamtBewertung DESC limit 2,1");
$rezept = $statement->fetch();

include('RezeptPreview.php');
?>