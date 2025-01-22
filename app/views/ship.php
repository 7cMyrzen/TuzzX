<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/ship.css">
    <title><?= $ship['name'] ?></title>
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
        <div class="top" id="<?= $ship['id'] ?>">

            <!--Test sans PHP-->
            <!--
            <div class="left">
                <img src="public/images/homeIllustration.png" alt="">
                <div class="name">Name of the Ship</div>
                <div class="desc">qzukvvhbGH GVH HIYCWUVGH CBQDSIU GH VHJL QVG cbhj ngfvjhb cgctuybjg gcthj ngfcjhbj bnjbh fcjtybh cbkh cjhgvb  vgvbjnk n </div>
            </div>
            <div class="right">
                <div class="card">
                    <div class="price">99 999 999.99 €</div>
                    <div class="details">
                        <div class="class">Class Tuzz</div>
                        <div class="pubuser">Publié le 11/09/2015 par Tuzz L'Eblair</div>
                    </div>
                    <div class="btn">Ajouter au panier</div>
                </div>
            </div>
            -->

            <div class="left">
                <img src="<?= $ship['image_path'] ?>" alt="">
                <div class="name"><?= $ship['name'] ?></div>
                <div class="desc"><?= $ship['description'] ?></div>
            </div>
            <div class="right">
                <div class="card">
                    <div class="price"><?= $ship['price'] ?> €</div>
                    <div class="details">
                        <div class="class"><?= $ship['category'] ?></div>
                        <div class="pubuser">Publié le <?= $ship['publication_date'] ?> par <?= $ship['seller'] ?></div>
                    </div>
                    <div class="btn">Ajouter au panier</div>
                </div>
            </div>

        </div>

        <div class="recommandation">
            <div class="title">Recommandations</div>
            <div class="cards">

                <?php foreach ($Ships as $oship): ?>
                    <div class="cardss" id="<?= $oship['id'] ?>">
                        <div class="img">
                            <img src="<?= $oship['image_path'] ?>" alt="">
                        </div>
                        <div class="info">
                            <div class="name-category"><span class="name"><?= $oship['name'] ?></span> <br><span class="category"><?= $oship['category'] ?></spanclass></div>
                            <div class="seller">Vendu par <?= $oship['seller'] ?></div>
                            <div class="price"><?= $oship['price'] ?> €</div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        

        <div class="reviews">
            <div class="title">Commentaires</div>
            <div class="cards">
                
                <?php foreach ($reviews as $review): ?>
                    
                    <div class="card">
                        <div class="user">
                            <img src="public/<?= $review["image_path"] ?>" alt="">
                            <div class="nr">
                                <div class="name"><?= $review['username'] ?></div>
                                <div class="rating"><img src="public/images/icon-star.png" alt=""><?= $review['rating'] ?>/5</div>
                            </div>
                        </div>
                        <div class="comment"><?= $review['comment'] ?></div>
                        <div class="date">Publié le <?= $review['review_date'] ?></div>
                    </div>

                <?php endforeach; ?>
                
            </div>

        </div>

        <div class="addreview">
            <div class="card">
                <form action="index.php?url=ship/addComment" method="post">
                    <div class="stars">
                        <img src="public/images/icon-star.png" alt="" id="star1" class="1">
                        <img src="public/images/icon-star.png" alt="" id="star2" class="2">
                        <img src="public/images/icon-star.png" alt="" id="star3" class="3">
                        <img src="public/images/icon-star.png" alt="" id="star4" class="4">
                        <img src="public/images/icon-star.png" alt="" id="star5" class="5">
                    </div>
                    <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Votre commentaire"></textarea>
                    <input type="hidden" name="ship_id" value="<?= $ship['id'] ?>">
                    <input type="hidden" name="ratinginput" id="ratinginput" value="0">
                    <button>Envoyer</button>
                </form>
            </div>
        </div>

    </main>


    <script src="public/js/auth.js"></script>
    <script src="public/js/ship.js"></script>
</body>
</html>
