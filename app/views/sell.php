<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/sell.css">
    <title>Vendre</title>
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

    <main>
        <form action="index.php?url=sell/sendShip" method="POST" enctype="multipart/form-data">
            <h1>Vendre un vaisseau</h1>

            <label for="profile_picture">Photo du vaisseau: </label>
            <input type="file" id="image" name="profile_picture" accept="image/*" required>


            <label for="name">Nom du vaisseau</label>
            <input class="input" type="text" name="name" id="name" required>

            <label for="description">Description</label>
            <textarea name="description" id="description" required></textarea>

            <label for="price">Prix</label>
            <input class="input" type="number" name="price" id="price" required>

            <label for="stock">Category</label>
            <select name="category" id="category" required>
                <option value="1">Géant</option>
                <option value="2">Guerre</option>
                <option value="3">Classique</option>
            </select>

            <label for="stock">Stock</label>
            <input class="input" type="number" name="stock" id="stock" required>

            <button type="submit">Vendre</button>
        </form>
    </main>


    <script src="public/js/auth.js"></script>
</body>
</html>
