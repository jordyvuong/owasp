<?php 
include_once('../src/db.php');

//fonction d'inscription 

function registerUser($pdo, $name, $password, $confirmPassword, $email) {
    if (!empty($email) && !empty($password) && !empty($name) && !empty($confirmPassword)) {
        
        // Vérifie si les mots de passe correspondent
        if ($password !== $confirmPassword) {
            throw new Exception("Les mots de passe ne correspondent pas.");
        }

        try {
            // Hashage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Préparation et exécution de la requête
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, :role_id)");
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password,
                'role_id' => 2
            ]);

            return true; // Inscription réussie
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'inscription : " . $e->getMessage());
        }
    } else {
        throw new Exception("Tous les champs sont requis.");
    }
}
require_once '../templates/register_form.php';