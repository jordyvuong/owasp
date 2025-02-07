<?php
require '../src/db.php';

function getAllProducts() {
    global $pdo; 

    $sql = "SELECT * FROM products";
    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        die("Erreur lors de la récupération des produits : " . $e->getMessage());
    }
}
?>