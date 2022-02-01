<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT i.nom_ingredient, i.cout_ingredient, c.qte
     FROM composer c
     INNER JOIN potion p ON c.id_potion = p.id_potion
     INNER JOIN ingredient i ON c.id_ingredient = i.id_ingredient
     WHERE p.nom_potion = 'Santé'"
);

?>

<a href="../index.php">Retour</a>

<h2>Nom des ingrédients + coût + quantité de chaque ingrédient pour 'Santé'</h2>
<p>Il y a <?= $requete->rowCount() ?> ingrédients pour la potion de Santé</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DE L'INGREDIENT</th>
            <th style="border:1px solid black">COUT</th>
            <th style="border:1px solid black">QUANTITE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete as $ingredient){ ?>
            <tr>
                <td style="border:1px solid black"><?= $ingredient["nom_ingredient"] ?></td>
                <td style="border:1px solid black"><?= $ingredient["cout_ingredient"] ?></td>
                <td style="border:1px solid black"><?= $ingredient["qte"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>