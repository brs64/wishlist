<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'authentification</title>
    <link rel="stylesheet" href="../css/auth.css">
</head>
<body>
    <div class="ring">
        <i style="--clr:#71BC68;"></i>
        <i style="--clr:#68BC89;"></i>
        <i style="--clr:#9BBC68;"></i>
        <div class="login">
            <h2>Connexion</h2>
            <form action="../utilities/auth.function.php" method="post">
                <div class="inputBx">
                    <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="inputBx">
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                </div>
                <div class="inputBx">
                    <input type="submit" value="Se connecter">
                </div>
                <!-- Add error message display -->
                <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials'): ?>
                    <p style="color: red;">Nom d'utilisateur ou mot de passe incorrect.</p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>