<?php

require "../dbconnect.php";
$pdo = connect();

$requete = $pdo->query(
    "SELECT p.id_personnage AS id_personnage, p.nom_personnage, l.nom_lieu, p.adresse_personnage, s.nom_specialite
     FROM personnage p
     INNER JOIN lieu l ON p.id_lieu = l.id_lieu
     INNER JOIN specialite s ON p.id_specialite = s.id_specialite
     ORDER BY l.nom_lieu, p.nom_personnage"
);

?>

<a href="../index.php">Retour</a>

<h2>Personnage + spécialité + adresse et lieu</h2>
<p>Il y a <?= $requete->rowCount() ?> personnages</p>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th style="border:1px solid black">NOM DU PERSONNAGE</th>
            <th style="border:1px solid black">LIEU</th>
            <th style="border:1px solid black">ADRESSE</th>
            <th style="border:1px solid black">SPECIALITE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete as $perso){ ?>
            <tr>
                <td style="border:1px solid black"><a href="voirPersonnage.php?id_personnage=<?= $perso["id_personnage"] ?>"><?= $perso["nom_personnage"] ?></a></td>
                <td style="border:1px solid black"><?= $perso["nom_lieu"] ?></td>
                <td style="border:1px solid black"><?= $perso["adresse_personnage"] ?></td>
                <td style="border:1px solid black"><?= $perso["nom_specialite"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>