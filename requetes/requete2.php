<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT l.id_lieu AS id_lieu, nom_lieu, COUNT(p.id_lieu) AS nbGaulois
     FROM lieu l
     INNER JOIN personnage p ON p.id_lieu = l.id_lieu
     GROUP BY l.id_lieu
     ORDER BY nbGaulois DESC"
);

?>

<a href="../index.php">Retour</a>

<h2>Nombre de gaulois par lieu</h2>
<p>Il y a <?= $requete->rowCount() ?> lieux</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DU LIEU</th>
            <th style="border:1px solid black">NOMBRE DE GAULOIS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $lieu){ ?>
            <tr>
                <td style="border:1px solid black"><a href="voirLieu.php?id_lieu=<?= $lieu["id_lieu"] ?>"><?= $lieu["nom_lieu"] ?></a></td>
                <td style="border:1px solid black"><?= $lieu["nbGaulois"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>