<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/admin.css">
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

    <div class="main">
        <div class="left">
            <div class="topleft"></div>
        </div>
        <div class="right">
            <div class="searchbar">
            </div>
            <div class="content">
            
            <!--
            <div class="card" id="id">
                <div class="img">
                    <img src="public/uploads/ships/vaisseau3w.jpg" alt="">
                </div>
                <div class="info">
                    <div class="name-category"><span class="name">Nebula Warden</span> <br><span class="category">Class War</spanclass></div>
                    <div class="seller">Vendu par MarsOuCrève</div>
                    <div class="a-d">
                        <div class="ok">Ok</div>
                        <div class="ban">Ban</div>
                    </div>
                </div>
            </div>
        -->

            <?php foreach ($Ships as $ship): ?>
                <div class="card" id="<?= $ship['id'] ?>">
                    <div class="img">
                        <img src="<?= $ship['image_path'] ?>" alt="">
                    </div>
                    <div class="info">
                        <div class="name-category"><span class="name"><?= $ship['name'] ?></span> <br><span class="category"><?= $ship['category'] ?></spanclass></div>
                        <div class="seller">Vendu par <?= $ship['seller'] ?></div>
                        <div class="a-d">
                            <div class="ok">Ok</div>
                            <div class="ban">Ban</div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


            </div>
        </div>
    </div>    

    <script src="public/js/admin.js"></script>
    <script src="public/js/auth.js"></script>
</body>
</html>