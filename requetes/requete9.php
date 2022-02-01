<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT p.nom_personnage, SUM(b.dose_boire) AS qttDose
     FROM boire b
     INNER JOIN potion po ON po.id_potion = b.id_potion
     INNER JOIN personnage p ON p.id_personnage = b.id_personnage
     GROUP BY p.nom_personnage
     ORDER BY qttDose DESC"
);

?>

<a href="../index.php">Retour</a>

<h2>Nom des personnages et leur quantité de potion bue (ordre décroissant)</h2>
<p>Il y a <?= $requete->rowCount() ?> personnages qui ont bu de la potion</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DU PERSONNAGE</th>
            <th style="border:1px solid black">QUANTITE POTION BUE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete as $perso){ ?>
            <tr>
                <td style="border:1px solid black"><?= $perso["nom_personnage"] ?></td>
                <td style="border:1px solid black"><?= $perso["qttDose"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>