<?php 
include_once('../db.php');

//fonction d'inscription 

function registerUser($pdo, $name, $password, $confirmPassword, $email) {
    if (!empty($email) && !empty($password) && !empty($name) && !empty($confirmPassword)) {
        
        // Vérifie si les mots de passe correspondent
        if ($password !== $confirmPassword) {
            throw new Exception("Les mots de passe ne correspondent pas.");
        }try{
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmp = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmp->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password
            ]);
            return true;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'inscription : " . $e->getMessage());
        }
    }
}
