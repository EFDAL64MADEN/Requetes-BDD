<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT p.nom_personnage
     FROM personnage p
     WHERE p.id_personnage
     NOT IN(
     SELECT ab.id_personnage
     FROM autoriser_boire ab
     INNER JOIN potion po ON po.id_potion = ab.id_potion
     WHERE po.nom_potion = 'Magique'
     );"
);

?>

<a href="../index.php">Retour</a>

<h2>Nom du / des personnages qui n'ont pas le droit de boire de la potion 'Magique'</h2>
<p>Il y a <?= $requete->rowCount() ?> personnage(s) qui n'ont pas le droit de boire la potion Magique</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DU PERSONNAGE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete as $personnage){ ?>
            <tr>
                <td style="border:1px solid black"><?= $personnage["nom_personnage"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>