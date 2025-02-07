<?php 
include_once('../db.php');
//fonction de connection 

//fonction d'inscription 

function registerUser($pdo, $name, $password, $email){
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