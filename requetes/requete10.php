<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT b.nom_bataille, SUM(pc.qte) AS qttCasque
     FROM prendre_casque pc
     INNER JOIN bataille b ON b.id_bataille = pc.id_bataille
     GROUP BY b.nom_bataille
     HAVING qttCasque >= ALL(
     SELECT SUM(pc.qte) FROM prendre_casque pc
     INNER JOIN bataille b ON b.id_bataille = pc.id_bataille
     GROUP BY b.nom_bataille
    );"
);

?>

<a href="../index.php">Retour</a>

<h2>Nom de la bataille où le nombre de casques pris a été le plus important</h2>
<p>Il y a <?= $requete->rowCount() ?> bataille</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DE LA BATAILLE</th>
            <th style="border:1px solid black">QUANTITE CASQUE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete as $bataille){ ?>
            <tr>
                <td style="border:1px solid black"><?= $bataille["nom_bataille"] ?></td>
                <td style="border:1px solid black"><?= $bataille["qttCasque"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>