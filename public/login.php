<?php
session_start();
require_once  '../src/db.php'; 

if (isset($_SESSION['user_id'])) {
    header("Location: products.php");
    exit();
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($email) && !empty($password)) {
        try {
            $stmt = $pdo->prepare("SELECT users.id, users.password, roles.name AS role 
                                   FROM users 
                                   JOIN roles ON users.role_id = roles.id 
                                   WHERE email = :email");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["user_role"] = $user["role"];

                header("Location: " . ($user["role"] == "admin" ? "admin.php" : "products.php"));
                exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            die("Erreur lors de la connexion : " . $e->getMessage());
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}

require_once '../templates/login_form.php';
?>