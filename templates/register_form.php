<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div>
        <h2>S'inscrire</h2>
        <form method="POST" action="register.php">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name">

            <label for="email">Email :</label>
            <input type="email" name="email" required>
            
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required>

            <label for="confirmpassword">Confirmer le mot de passe :</label>
            <input type="password" name="confirmpassword" required>
            
            <button type="submit">Se connecter</button>
        </form>
        <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
    </div>
</body>
</html>