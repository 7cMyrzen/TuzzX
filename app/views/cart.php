<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/cart.css">
    <title>Panier</title>
</head>
<body>

    <div class="modal">
        <div class="top">
            <span class="close">&times;</span>
        </div>
        <div class="body">
            <form action="index.php?url=profile/addAddress" method="POST">
            <h2>Ajouter une adresse</h2>
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" placeholder="Votre adresse" required>
            <label for="city">Ville</label>
            <input type="text" id="city" name="city" placeholder="Votre ville" required>
            <label for="zip">Code postal</label>
            <input type="text" id="zip" name="zip" placeholder="Votre code postal" required>
            <label for="country">Pays</label>
            <input type="text" id="country" name="country" placeholder="Votre pays" required>
            <button type="submit">Ajouter</button>
        </div>
        <div class="bottom">

        </div>
    </div>

    <div class="overlay"></div>

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

    <main>
        <div class="facturation">
            <div class="title">Facturation</div>
            <hr>
            <div class="address">

                <div class="na">
                    <img src="public/images/icon-edit.png" alt="">
                    <h2>Nouvelle Adresse</h2>
                </div>
                
                <div class="ua">

                    <?php if ($userAddress): ?>
                        <?php foreach ($userAddress as $address): ?>
                            <div class="address-container">
                                <div class="address-info">
                                    <h2><?= $address['address'] ?></h2>
                                    <h2><?= $address['city'] ?></h2>
                                    <h2><?= $address['zip'] ?></h2>
                                    <h2><?= $address['country'] ?></h2>
                                </div>
                                <div class="choice">
                                    <input type="radio" name="address" id="address<?= $address['id'] ?>" >
                                    <label for="address<?= $address['id'] ?>">Utiliser cette adresse</label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
    
            </div>
        </div>

        <div class="panier">
            <div class="title">Panier</div>
            <hr>
            
            <?php foreach ($cart as $item): ?>
                <div class="elmt">
                    <div class="nom"><?= $item['name'] ?></div>
                    <div class="prix"><?= $item['price'] ?></div>
                    <div class="buy-del">
                        <img src="public/images/icon-buy.png" alt="" id="buy-<?= $item['id'] ?>" class="buy">
                        <img src="public/images/icon-del.png" alt="" id="del-<?= $item['id'] ?>" class="del">
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </main>


    <script src="public/js/auth.js"></script>
    <script src="public/js/cart.js"></script>
</body>
</html>