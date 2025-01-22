<?php
class cartController {
    public function index() {
        session_start();

        $profilePic = null;
        if (isset($_SESSION['user_id'])) {
            // Charger la photo de profil uniquement
            require_once 'app/models/User.php';
            $userModel = new User();
            $profilePic = $userModel->getProfilePic($_SESSION['user_id']);
        }
        
        $userAddress = $userModel->getUserAddress($_SESSION['user_id']);

        // Charger le modèle Cart
        require_once 'app/models/Cart.php';
        $cartModel = new Cart();
        $cart = $cartModel->getCartItems($_SESSION['user_id']);

        // Inclure la vue
        require 'app/views/cart.php';
    }

    public function delFromCart() {
        session_start();
    
        // Utiliser la variable correcte pour récupérer l'ID du produit
        $cartId = $_POST['cartId'];
    
        // Charger le modèle Cart
        require_once 'app/models/Cart.php';
        $cartModel = new Cart();
    
        // Appeler la méthode pour supprimer l'élément du panier
        $cartModel->removeFromCart($_SESSION['user_id'], $cartId);
    
        // Retourner une réponse JSON plutôt que de rediriger directement
        echo json_encode(['success' => true]);
        exit();
    }

    public function buyItem() {
        session_start();
    
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth');
            exit();
        }
    
        // Vérifier si les IDs de l'article et de l'adresse ont été envoyés
        if (isset($_POST['itemId']) && isset($_POST['addressId'])) {
            $itemId = $_POST['itemId'];
            $addressId = $_POST['addressId'];
    
            // Charger les modèles Cart et Address
            require_once 'app/models/Cart.php';
            require_once 'app/models/User.php';
            $cartModel = new Cart();
            $userModel = new User();

            // Récupérer les informations de l'article
            $item = $cartModel->getCartItem($_SESSION['user_id'], $itemId);
            
            // Récupérer les informations de l'adresse
            $address = $userModel->getAddressInfo($addressId);

            // Vérifier si l'article et l'adresse existent
            if ($item && $address) {
                // Charger le modèle Order
                require_once 'app/models/Order.php';
                $orderModel = new Order();

                require_once 'app/models/Ships.php';
                $shipModel = new Ships();
                $stock = $shipModel->getStock($itemId);

                if ($stock < $item['quantity']) {
                    echo json_encode(['success' => false, 'message' => 'Stock insuffisant']);
                    exit();
                }

                $userBalance = $userModel->getUserBalance($_SESSION['user_id']);
                if ($userBalance< $item['price']) {
                    echo json_encode(['success' => false, 'message' => 'Solde insuffisant']);
                    exit();
                }
    
                // Appeler la méthode pour ajouter une commande
                $orderModel->createOrder($_SESSION['user_id'], $item["price"], $addressId);
                $lastOrderId = $userModel->getLastOrderId($_SESSION['user_id']);
                $orderModel->createOrderDetails($lastOrderId, $itemId, $item['quantity'], $item['price']);


                // Appeler la méthode pour mettre à jour le stock
                $shipModel->updateStockab($itemId);

                // Appeler la méthode pour mettre à jour le solde
                $userModel->updateBalance($_SESSION['user_id'], $item["price"], '-');
                $sellerId = $shipModel->getSellerId($itemId);
                $sellerId = $sellerId['author_id'];
                $userModel->updateBalance($sellerId, $item["price"], '+');

                // Appeler la méthode pour retirer l'article du panier
                $cartModel->removeFromCart($_SESSION['user_id'], $itemId);

                // Retourner une réponse JSON plutôt que de rediriger directement
                echo json_encode(['success' => true]);
                exit();
            }
        }
    }
    
                
}
