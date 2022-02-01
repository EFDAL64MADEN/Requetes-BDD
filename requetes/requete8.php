<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT p.nom_personnage, SUM(pc.qte) AS qttCasque
     FROM prendre_casque pc
     INNER JOIN bataille b ON b.id_bataille = pc.id_bataille
     INNER JOIN personnage p ON p.id_personnage = pc.id_personnage
     WHERE b.nom_bataille = 'Bataille du village gaulois'
     GROUP BY p.nom_personnage
     HAVING qttCasque >= ALL(
     SELECT SUM(pc.qte) FROM prendre_casque pc
     INNER JOIN bataille b ON b.id_bataille = pc.id_bataille
     INNER JOIN personnage p ON p.id_personnage = pc.id_personnage
     WHERE b.nom_bataille = 'Bataille du village gaulois'
     GROUP BY p.nom_personnage
    );"
);

?>

<a href="../index.php">Retour</a>

<h2>Nom du ou des personnages qui ont ramassé le plus de casques dans la 'Bataille du village gaulois'</h2>
<p>Il y a <?= $requete->rowCount() ?> personnage(s)</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DU PERSONNAGE</th>
            <th style="border:1px solid black">NB CASQUE PRIS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete as $perso){ ?>
            <tr>
                <td style="border:1px solid black"><?= $perso["nom_personnage"] ?></td>
                <td style="border:1px solid black"><?= $perso["qttCasque"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>