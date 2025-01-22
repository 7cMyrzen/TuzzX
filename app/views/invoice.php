<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/invoices.css">
    <title>Facture n°</title>
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
        <div class="invoice">
            <div class="invoice-header">
                <h1>Facture n°<?= $invoice['id'] ?></h1>
                <p>Commandé le <?= $invoice['order_date'] ?> à <?= $invoice['time'] ?></p>
            </div>
            <div class="invoice-details">
                <div class="invoice-ship">
                    <h2>Vaisseau</h2>
                    <hr>
                    <p>id n°<?= $invoiceDetails['ship_id'] ?></p>
                </div>
                <div class="invoice-quantity">
                    <h2>Quantité</h2>
                    <hr>
                    <p>Nombre d'unité achetée(s) : <?= $invoiceDetails['quantity'] ?></p>
                    <p>Prix de l'unité : <?= $invoice['total_amount'] ?></p>
                </div>
                <div class="invoice-price">
                    <h2>Prix</h2>
                    <hr>
                    <p><?= $invoice['total_amount'] ?> €TTC</p>
                </div>
            </div>
        </div>
    </main>

    <script src="public/js/auth.js"></script>
</body>
</html>