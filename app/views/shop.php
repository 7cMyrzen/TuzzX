<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/shop.css">
    <title>Boutique</title>
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
            <div class="filter">
                <div class="title">Filtres :</div>
                <div class="category">
                    <input type="checkbox" id="all" name="all" value=""> <label for="all">Tous</label><br>
                    <input type="checkbox" id="c1" name="1" value=""> <label for="c1">Class Tuzz</label><br>
                    <input type="checkbox" id="c2" name="2" value=""> <label for="c2">Class Giant</label><br>
                    <input type="checkbox" id="c3" name="3" value=""> <label for="c3">Class War</label><br>
                    <input type="checkbox" id="c4" name="4" value=""> <label for="c4">Class Classic</label><br>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="searchbar">
                <input id="input" type="text" placeholder="Rechercher un produit">
                <img id="search" src="public/images/icon-search.png" alt="•">
            </div>
            <div class="content">

            <!-- Exemple de carte de vaisseau -->
            <!--
                <div class="card" id="id">
                    <div class="img">
                        <img src="public/uploads/ships/vaisseau3w.jpg" alt="">
                    </div>
                    <div class="info">
                        <div class="name-category"><span class="name">Nebula Warden</span> <br><span class="category">Class War</spanclass></div>
                        <div class="seller">Vendu par MarsOuCrève</div>
                        <div class="price">845 000 €</div>
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
                            <div class="price"><?= $ship['price'] ?> €</div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <img src="public/images/nothing.png" id="defaultimg" class="dimg" alt="">

            </div>
        </div>
    </div>    

    
    <script src="public/js/auth.js"></script>
    <script src="public/js/shop.js"></script>
</body>
</html>