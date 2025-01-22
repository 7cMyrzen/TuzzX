<?php
class ShipController {
    public function index() {
        session_start();

        $id = $_GET['id'] ?? null;

        // Charger le modèle User
        require_once 'app/models/User.php';
        $userModel = new User();
        $profilePic = null;
        if (isset($_SESSION['user_id'])) {
            // Charger la photo de profil uniquement
            $profilePic = $userModel->getProfilePic($_SESSION['user_id']);
        }

        //Charger le modèle Ships
        require_once 'app/models/Ships.php';
        $shipsModel = new Ships();
        $ship = $shipsModel->getShipById($id);
        $ship['publication_date'] = date('d/m/Y', strtotime($ship['publication_date']));
        $ship['price'] = number_format($ship['price'], 2, '.', ' ');
        $ship['seller'] = $userModel->getUsername($ship['author_id'])['username'];
        $ship['category'] = $shipsModel->getCategoryName($ship['category_id'])['name'];

        $Ships = $shipsModel->get3ShipsFromCategory($ship['category_id'], $id);
        foreach ($Ships as $key => $oship) {
            $Seller = $Ships[$key]['author_id'];
            $SellerName = $userModel->getUsername($Seller);
            $Ships[$key]['seller'] = $SellerName['username'];

            $Category = $Ships[$key]['category_id'];
            $CategoryName = $shipsModel->getCategoryName($Category);
            $Ships[$key]['category'] = $CategoryName['name'];

            //Séparer par un espace dasn le prix pour une meilleure lisibilité
            $Ships[$key]['price'] = number_format($Ships[$key]['price'], 2, '.', ' ');
        }


        //Chager le modele reviews
        require_once 'app/models/Reviews.php';
        $reviewsModel = new Reviews();
        $reviews = $reviewsModel->getReviews($id);
        foreach ($reviews as $key => $review) {
            $reviews[$key]['review_date'] = date('d/m/Y', strtotime($review['review_date']));
            $reviews[$key]['username'] = $userModel->getUsername($review['user_id'])['username'];
            $reviews[$key]['image_path'] = $userModel->getProfilePic($review['user_id'])['profile_pic'];
        }
        
        // Inclure la vue
        require 'app/views/ship.php';
    }

    public function addToCart() {
        session_start();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['form_type'] === 'add_to_cart') {
            $userId = $_SESSION['user_id'] ?? null;
            $shipId = $_POST['ship_id'];
    
            if (!$userId) {
                header('Location: index.php?url=auth&error=Vous devez être connecté pour ajouter au panier.');
                exit();
            }
    
            require_once 'app/models/Cart.php';
            $cartModel = new Cart();
            $cartModel->addToCart($userId, $shipId, 1);
    
            header('Location: index.php?url=cart');
            exit();
        }
    }

    public function addComment() {
        session_start();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'] ?? null;
            $shipId = $_POST['ship_id'] ?? null;
            $comment = trim($_POST['comment']);
            $rating = intval($_POST['ratinginput'] ?? 0);
    
            // Vérifications de base
            if (!$userId) {
                header('Location: index.php?url=auth&error=Vous devez être connecté pour commenter.');
                exit();
            }
            if (empty($comment)) {
                header("Location: index.php?url=ship&id=$shipId&error=Le commentaire ne peut pas être vide.");
                exit();
            }
            if ($rating < 0 || $rating > 5) {
                header("Location: index.php?url=ship&id=$shipId&error=La note doit être comprise entre 0 et 5.");
                exit();
            }
    
            // Charger le modèle Reviews
            require_once 'app/models/Reviews.php';
            $reviewsModel = new Reviews();
    
            // Ajouter le commentaire et la note
            $reviewsModel->createReview($userId, $shipId, $rating, $comment);
    
            // Rediriger vers la page du vaisseau
            header("Location: index.php?url=ship&id=$shipId");
            exit();
        }
    }
    
    
}