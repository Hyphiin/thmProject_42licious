<?php
$statement = $pdo->query("SELECT * FROM rezepte ORDER BY gesamtBewertung DESC limit 1");
$rezept = $statement->fetch();

include('RezeptPreview.php');
?>