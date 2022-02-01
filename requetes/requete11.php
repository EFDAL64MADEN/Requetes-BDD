<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT c.nom_casque, SUM(pc.qte) AS qttCasque, SUM(c.cout_casque) AS coutTotal
     FROM prendre_casque pc
     INNER JOIN casque c ON c.id_casque = pc.id_casque
     GROUP BY c.nom_casque
     ORDER BY coutTotal DESC"
);

?>

<a href="../index.php">Retour</a>

<h2>Nombre de casque de chaque type + coût total</h2>
<p>Il y a <?= $requete->rowCount() ?> type de casque</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DU CASQUE</th>
            <th style="border:1px solid black">QUANTITE CASQUE</th>
            <th style="border:1px solid black">COUT TOTAL</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete as $casque){ ?>
            <tr>
                <td style="border:1px solid black"><?= $casque["nom_casque"] ?></td>
                <td style="border:1px solid black"><?= $casque["qttCasque"] ?></td>
                <td style="border:1px solid black"><?= $casque["coutTotal"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>