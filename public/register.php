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

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'email n'est pas valide.");
        }

        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            throw new Exception("Cet email est déjà utilisé.");
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, 2)");
        $stmt->execute([
            'name' => htmlspecialchars($name),
            'email' => htmlspecialchars($email),
            'password' => $hashed_password
        ]);

        header("Location: products.php");
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

require_once '../templates/register_form.php';
