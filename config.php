<?php
//configuration de la base de données
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "todolist");

// Connexion à la base de données en utilisant PDO
try {
    $conn = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Test de la connexion réussie
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
    