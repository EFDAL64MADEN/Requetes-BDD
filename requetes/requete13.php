<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT l.nom_lieu, COUNT(*) AS nbHabitants
     FROM personnage p
     INNER JOIN lieu l ON l.id_lieu = p.id_lieu
     WHERE l.nom_lieu != 'Village gaulois'
     GROUP BY l.nom_lieu
     HAVING nbHabitants >= ALL(
     SELECT COUNT(*) AS nbHabitants FROM personnage p
     INNER JOIN lieu l ON l.id_lieu = p.id_lieu
     WHERE l.nom_lieu != 'Village gaulois'
     GROUP BY l.nom_lieu
     );"
);

?>

<a href="../index.php">Retour</a>

<h2>Nom du / des lieu(x) possédant le plus d'habitants, en dehors du village gaulois</h2>
<p>Il y a <?= $requete->rowCount() ?> lieu(x)</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DU LIEU</th>
            <th style="border:1px solid black">NB HABITANTS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete as $lieu){ ?>
            <tr>
                <td style="border:1px solid black"><?= $lieu["nom_lieu"] ?></td>
                <td style="border:1px solid black"><?= $lieu["nbHabitants"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>