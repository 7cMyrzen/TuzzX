<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/home.css">
    <title>Accueil</title>
</head>
<body>
    <nav>
        <div class="n name">TuzzX</div>
        <div class="n links">
            <a href="index.php?url=home">Accueil</a>
            <a href="index.php?url=shop">Acheter</a>
            <a href="index.php?url=sell">Vendre</a>
        </div>
        <div class="n account">
        <?php if ($profilePic): ?>
            <div class="profile">
                <img src="public/<?= $profilePic['profile_pic'] ?>" alt="" id="pp">
                <div class="dropdown" id="dropdown">
                    <a href="index.php?url=profile">Profil</a>
                    <a href="index.php?url=cart">Panier</a>
                    <a href="index.php?url=auth/logout">Déconnexion</a>
                </div>
            </div>
        <?php else: ?>
            <button onclick="location.href='index.php?url=auth'">Connexion</button>
        <?php endif; ?>
        </div>  
    </nav>
    <div class="hero">
        <div class="side left">
            <p>
                <span><?= htmlspecialchars($siteName ?? 'TuzzX') ?></span>
                <br> Sélectionnez votre vaisseau spatial <br>
                parmi une large sélection <br>
                entièrement validée par Tuzz L'Éblair !
            </p>
            <button onclick="location.href='index.php?url=shop'">Accéder à la boutique</button>
        </div>
        <div class="side right">
            <div class="img-zone">
                <img src="public/images/homeIllustration.png">
            </div>
        </div>
    </div>
    <footer>
        <div class="f insta">
            <p>Inspiration</p>
            <div class="linkdiv">
                <div class="link">
                    <img src="public/images/icon-insta.png" alt="Instagram Icon">
                    <a href="https://www.instagram.com/haskouil/reels/">haskouil</a>
                </div>
            </div>
        </div>
        <div class="f links">
            <p>Liens</p>
            <div class="linkdiv">
                <div class="link">
                    <a href="index.php?url=shop">Acheter</a>
                </div>
                <div class="link">
                    <a href="index.php?url=sell">Vendre</a>
                </div>
                <div class="link">
                    <a href="index.php?url=auth">Connexion</a>
                </div>
            </div>
        </div>
        <div class="f github">
            <p>Code source</p>
            <div class="linkdiv">
                <div class="link">
                    <img src="public/images/icon-github.png" alt="GitHub Icon">
                    <a href="https://github.com/7cMyrzen/TuzzX">GitHub</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="public/js/auth.js"></script>
</body>
</html>