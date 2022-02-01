<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT p.nom_personnage
     FROM personnage p
     WHERE p.id_personnage
     NOT IN(
     SELECT b.id_personnage
     FROM boire b
     );"
);

?>

<a href="../index.php">Retour</a>

<h2>Nom des personnages qui n'ont jamais bu aucune potion</h2>
<p>Il y a <?= $requete->rowCount() ?> personnages qui n'ont bu aucune potion</p>

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