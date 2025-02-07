<?php
require_once '../src/db.php';

try {
    $query = $pdo->query("SELECT version()");
    $version = $query->fetchColumn();
    echo "Connexion réussie à PostgreSQL : " . $version;
} catch (PDOException $e) {
    echo "Échec de connexion : " . $e->getMessage();
}
?>
