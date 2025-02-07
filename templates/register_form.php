<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="POST" action="login.php">
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
        <p>Pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a></p>
    </div>
</body>
</html>