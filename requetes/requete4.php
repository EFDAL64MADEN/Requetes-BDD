<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT s.nom_specialite, COUNT(p.id_personnage) AS nbPersonnages
     FROM specialite s
     INNER JOIN personnage p ON s.id_specialite = p.id_specialite
     GROUP BY s.nom_specialite
     ORDER BY nbPersonnages DESC"
);

?>

<a href="../index.php">Retour</a>

<h2>Nom spécialités avec nombre de perso par spécialité</h2>
<p>Il y a <?= $requete->rowCount() ?> spécialités</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DE LA SPECIALITE</th>
            <th style="border:1px solid black">NOMBRE DE PERSONNAGE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete as $specialite){ ?>
            <tr>
                <td style="border:1px solid black"><?= $specialite["nom_specialite"] ?></td>
                <td style="border:1px solid black"><?= $specialite["nbPersonnages"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>