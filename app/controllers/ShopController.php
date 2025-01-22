<?php
class ShopController {
    public function index() {
        session_start();

        $profilePic = null;
        if (isset($_SESSION['user_id'])) {
            // Charger la photo de profil uniquement
            require_once 'app/models/User.php';
            $userModel = new User();
            $profilePic = $userModel->getProfilePic($_SESSION['user_id']);
        }

        // Charger le modèle Ships
        require_once 'app/models/Ships.php';
        $shipsModel = new Ships();
        $Ships = $shipsModel->getAllShips();
        //Pour chaque vaisseau, on récupère le nom du vendeur
        foreach ($Ships as $key => $ship) {
            $Seller = $Ships[$key]['author_id'];
            $SellerName = $userModel->getUsername($Seller);
            $Ships[$key]['seller'] = $SellerName['username'];

            $Category = $Ships[$key]['category_id'];
            $CategoryName = $shipsModel->getCategoryName($Category);
            $Ships[$key]['category'] = $CategoryName['name'];

            //Séparer par un espace dasn le prix pour une meilleure lisibilité
            $Ships[$key]['price'] = number_format($Ships[$key]['price'], 2, '.', ' ');
        }
        
        // Inclure la vue
        require 'app/views/shop.php';
    }
}
