<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT p.id_potion AS id_potion, p.nom_potion, ROUND(SUM(i.cout_ingredient*c.qte),2) AS coutTotal
     FROM composer c
     INNER JOIN potion p ON c.id_potion = p.id_potion
     INNER JOIN ingredient i ON c.id_ingredient = i.id_ingredient
     GROUP BY p.id_potion
     ORDER BY coutTotal DESC"
);

?>

<a href="../index.php">Retour</a>

<h2>Nom des potions et coût de réalisation</h2>
<p>Il y a <?= $requete->rowCount() ?> potions</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DE LA POTION</th>
            <th style="border:1px solid black">COUT DE REALISATION</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $potion){ ?>
            <tr>
                <td style="border:1px solid black"><a href="voirPotion.php?id_potion=<?= $potion["id_potion"] ?>"><?= $potion["nom_potion"] ?></a></td>
                <td style="border:1px solid black"><?= $potion["coutTotal"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>