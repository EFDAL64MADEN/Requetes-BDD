<?php

require "../dbconnect.php";
$pdo = connect();

// éxecution de la requête
$requete = $pdo->query(
    "SELECT nom_lieu
     FROM lieu
     WHERE nom_lieu LIKE '%um'
     ORDER BY nom_lieu"
);

?>

<a href="../index.php">Retour</a>

<h2>Nom des lieux qui finissent par 'um'</h2>

<!-- Compter le nombre d'enregistrement de la requête 1 -->
<p>Il y a <?= $requete->rowCount() ?> lieux qui finissent par 'um'</p>

<table style="border:1px solid black">
<thead>
    <tr>
        <th style="border:1px solid black">NOM DU LIEU</th>
    </tr>
</thead>
<tbody>
<?php
// var_dump($requete1->fetchAll());

// parcourir la requête pour en afficher le contenu
foreach($requete as $lieu){ ?>
    <tr>
        <td style="border:1px solid black"><?= $lieu["nom_lieu"] ?></td>
    </tr>
<?php } ?>
</tbody>
</table>

<?php
$requete = null;
?>