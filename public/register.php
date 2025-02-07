<?php 
require_once '../templates/header.php';
require_once '../src/db.php';

//fonction d'inscription 

function registerUser($pdo, $name, $password, $email){
    if (!empty($email) && !empty($password) && !empty($name)) {
        try{
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
require_once '../templates/register_form.php';