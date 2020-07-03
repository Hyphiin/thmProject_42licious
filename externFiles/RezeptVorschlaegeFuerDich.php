<?php
do {
    $statement = $pdo->query("SELECT * FROM rezepte ORDER BY RAND() DESC LIMIT 1");
    $rezept = $statement->fetch();
    $rezeptID = $rezept['rid'];
}while($check1==$rezeptID OR $check2==$rezeptID);

include('RezeptPreview.php');
?>