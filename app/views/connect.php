<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/connect.css">
    <title>Connexion</title>
</head>
<body>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <div class="connect">
        <div class="login">
            <h1>Connexion</h1>
            <form action="index.php?url=auth/login" method="post">
                <input type="hidden" name="form_type" value="login">
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit">Se connecter</button>
            </form>
        </div>

        <div class="register">
            <h1>Inscription</h1>
            <form action="index.php?url=auth/register" method="post">
                <input type="hidden" name="form_type" value="register">
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="email" name="email" placeholder="Adresse e-mail" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <input type="password" name="password2" placeholder="Confirmer le mot de passe" required>
                <button type="submit">S'inscrire</button>
            </form>
        </div>

        <div class="hover">
            <div class="img">
                <img src="public/images/lock.png">
            </div>
            <div class="lr">
                <p class="hovertxt">Vous n'avez pas de compte ?</p>
                <button class="hoverbtn" onclick="hoverConnect()">Inscrivez-vous !</button>
            </div>
        </div>
    </div>
    <script src="public/js/connect.js"></script>
</body>
</html>
