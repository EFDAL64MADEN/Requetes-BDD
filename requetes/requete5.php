<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT b.nom_bataille, DATE_FORMAT(b.date_bataille, '%d %M -%y') as dateBataille, l.nom_lieu
     FROM bataille b
     INNER JOIN lieu l ON b.id_lieu = l.id_lieu
     ORDER BY YEAR(b.date_bataille) ASC, MONTH(b.date_bataille) DESC, DAY(b.date_bataille) DESC"
);

?>

<a href="../index.php">Retour</a>

<h2>Nom, date, et lieu des batailles (ordre décroissant)</h2>
<p>Il y a <?= $requete->rowCount() ?> batailles</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DE LA BATAILLE</th>
            <th style="border:1px solid black">DATE</th>
            <th style="border:1px solid black">LIEU</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete as $bataille){ ?>
            <tr>
                <td style="border:1px solid black"><?= $bataille["nom_bataille"] ?></td>
                <td style="border:1px solid black"><?= $bataille["dateBataille"] ?></td>
                <td style="border:1px solid black"><?= $bataille["nom_lieu"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>