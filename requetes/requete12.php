<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT p.nom_potion
     FROM potion p
     INNER JOIN composer c ON c.id_potion = p.id_potion
     INNER JOIN ingredient i ON i.id_ingredient = c.id_ingredient
     WHERE i.nom_ingredient = 'Poisson frais'
     GROUP BY p.nom_potion"
);

?>

<a href="../index.php">Retour</a>

<h2>Nom des potions dont un des ingrédients est le poisson frais</h2>
<p>Il y a <?= $requete->rowCount() ?> potions</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DE LA POTION</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete as $potion){ ?>
            <tr>
                <td style="border:1px solid black"><?= $potion["nom_potion"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>