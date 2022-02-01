<?php 

function connect() {
        // déclaration des constantes pour le user et son mdp
        define("DBUSER", "root");
        define("DBPASS", "");

        // connexion à la bdd (à travers l'instanciation de la classe PDO)
        $pdo = new PDO("mysql:host=localhost;dbname=gaulois;charset=utf8", DBUSER, DBPASS);

        return $pdo;
}
?>