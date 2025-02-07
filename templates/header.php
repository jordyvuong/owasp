<?php
session_start();
require_once __DIR__ . '/../src/db.php'; 

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $_SESSION['user_role'] ?? null; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owasp</title>
</head>
<body>

<nav class="navbar">
    <div class="container">
        <a href="/products.php">Owasp</a>

        <ul class="nav-links" id="menu">
            <li><a href="/products.php">Produits</a></li>
            <li><a href="/contact.php">Contact</a></li>

            <?php if ($isLoggedIn): ?>
                <li><a href="/profile.php">Mon Compte</a></li>
                <?php if ($userRole === 'admin'): ?>
                    <li><a href="">Admin</a></li>
                <?php endif; ?>
                <li><a href="">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="/login.php">Connexion</a></li>
                <li><a href="/register.php">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
