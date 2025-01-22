<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/profile.css">
    <title>Profil</title>
</head>
<body>

<div class="modal">
        <div class="top">
            <span class="close">&times;</span>
        </div>
        <div class="body">
            <form action="index.php?url=profile/changeInfo" method="POST" enctype="multipart/form-data">
                <h2>Modifier</h2>

                <label for="profile_picture">Photo de profil :</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required>

                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" value="<?= $info['username'] ?>" placeholder="Votre nom">

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= $info['email'] ?>" placeholder="Votre email">

                <label for="password">Nouveau mot de passe :</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe">

                <label for="password2">Ancien mot de passe :</label>
                <input type="password" id="password2" name="password2" placeholder="Votre mot de passe" required>

                <button type="submit">S'inscrire</button>
            </form>

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
        <div class="hero">
            <div class="left">
                <div class="info">
                    <div class="title">Mes Informations <img class="editimg" src="public/images/icon-edit.png" alt=""></div>
                    <hr>
                    <div class="info-container">
                        <div class="pfpn">
                            <div class="pfp">
                            <img src="public/<?= $profilePic['profile_pic'] ?>" alt="">
                            </div>
                            <div class="name">
                                <h1><?= $info['username'] ?></h1>
                            </div>
                        </div>
                        <div class="other">
                            <h2><span>Email : </span> <?= $info['email'] ?></h2>
                            <h2><span>Rôle : </span> <?= $info['role'] ?></h2>
                        </div>
                    </div>
                </div>
                <div class="address">
                    <div class="title">Adresse(s)</div>
                    <hr>
                    <div class="address-container">

                        <?php foreach ($userAddress as $address): ?>
                            <div class="address-info">
                                <h2><span>Adresse : </span><?= $address['address'] ?></h2>
                                <h2><span>Ville : </span><?= $address['city'] ?></h2>
                                <h2><span>Code postal : </span><?= $address['zip'] ?></h2>
                                <h2><span>Pays : </span><?= $address['country'] ?></h2>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <div class="right">
                <div class="money">
                    <div class="top">
                        <div class="title">Mon Argent</div>
                        <div class="balance"><img src="public/images/icon-money.png" alt=""> <br> Solde <br> <?= $info['balance'] ?> €</div>
                    </div>
                    <hr>
                    <div class="bottom">
                        <input type="text" placeholder="Montant">
                        <button>Recharger</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="cart">
            <div class="title">Mon panier</div>
            <hr>
            <a href="index.php?url=cart" class="view">Voir le panier</a>
        </div>

        <div class="invoices">
            <div class="title">Mes factures</div>
            <hr>
            <div class="invoices-container">

                <?php foreach ($Invoices as $invoice): ?>
                    <div class="invoice">
                        <div class="dt">
                            <div class="date">Date : <?= $invoice['order_date'] ?></div>
                            <div class="total">Total : <?= $invoice['total_amount'] ?> €</div>
                        </div>
                        <div class="item">Produit : <?= $invoice['name'] ?></div>
                        <div class="redirect"><a href="index.php?url=invoice&id=<?= $invoice['id'] ?>" class="view">Voir la facture</a></div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <div class="settings">
            <div class="title">Paramètres</div>
            <hr>
            <div class="settings-container">
                <a href="index.php?url=auth/logout" id="logout">Se déconnecter</a>
                <a id="delete">Supprimer mon compte</a>
            </div>
        </div>

    </main>

    <script src="public/js/auth.js"></script>
    <script src="public/js/profile.js"></script>
</body>
</html>
