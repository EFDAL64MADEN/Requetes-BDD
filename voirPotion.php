<?php

require "dbconnect.php";
$pdo = connect();

if(isset($_GET["id_potion"])){
    // afficher le détail de la potion
    $id_potion = $_GET["id_potion"];
    $requete = $pdo->prepare("
        SELECT id_potion, nom_potion, nom_ingredient
        FROM potion p
        INNER JOIN ingredient i ON i.id_ingredient = p.id_ingredient
        WHERE id_potion = :id_potion
    ");

    $requete->execute([":id_potion" => $id_potion]);
    $result = $requete->fetch();

    if($result){ ?>
        <h1><?= $result["nom_potion"] ?></h1>
        <p>
            Ingrédients utilisés : <br>
            <?php
                foreach($id_potion as $ingredient){
                    echo $result["nom_ingredient"];
                }
            ?>
        </p>
<?php
    } else {
        echo "Identifiant de potion introuvable !";
    }
} else {
    // redirection vers page d'accueil 
    header("Location: index.php");
}

?>