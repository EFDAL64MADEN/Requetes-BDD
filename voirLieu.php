<?php

require "dbconnect.php";
$pdo = connect();

if(isset($_GET["id_lieu"])){
    // afficher le détail du lieu
    $id_lieu = $_GET["id_lieu"];
    $requete = $pdo->prepare("
        SELECT nom_lieu
        FROM lieu
        WHERE id_lieu = :id_lieu
    ");

    $requete->execute([":id_lieu" => $id_lieu]);
    $result = $requete->fetch();

    if($result){
        echo $result["nom_lieu"];
    } else {
        echo "Identifiant de lieu introuvable !";
    }
} else {
    // redirection vers page d'accueil 
    header("Location: index.php");
}

?>