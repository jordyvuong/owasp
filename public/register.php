<?php
session_start();
include_once('../src/db.php');

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    try {
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        if ($password !== $confirmPassword) {
            throw new Exception("Les mots de passe ne correspondent pas.");
        }

        try {
            // Hashage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Préparation et exécution de la requête
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, :2)");
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password
            ]);

        header("Location: products.php");
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

require_once '../templates/register_form.php';
