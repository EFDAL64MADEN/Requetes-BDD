<?php

require "dbconnect.php";
$pdo = connect();

if(isset($_GET["id_personnage"])){
    // afficher le détail du personnage
    $id_personnage = $_GET["id_personnage"];
    $requete = $pdo->prepare("
        SELECT id_personnage, nom_personnage, adresse_personnage, nom_lieu, nom_specialite
        FROM personnage p
        INNER JOIN specialite s ON s.id_specialite = p.id_specialite
        INNER JOIN lieu l ON l.id_lieu = p.id_lieu
        WHERE id_personnage = :id_personnage
    ");

    $requete->execute([":id_personnage" => $id_personnage]);
    $result = $requete->fetch();

    if($result){ ?>
        <h1><?= $result["nom_personnage"] ?></h1>
        <p>
            Adresse : <?= $result["adresse_personnage"] ?><br>
            Lieu : <?= $result["nom_lieu"] ?><br>
            Spécialité : <?= $result["nom_specialite"] ?>
        </p>
<?php
    } else {
        echo "Identifiant de personnage introuvable !";
    }
} else {
    // redirection vers page d'accueil 
    header("Location: index.php");
}

?>