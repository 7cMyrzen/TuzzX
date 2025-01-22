<?php
class AdminController {
    public function index() {
        session_start();

        $profilePic = null;
        if (isset($_SESSION['user_id'])) {
            // Charger la photo de profil uniquement
            require_once 'app/models/User.php';
            $userModel = new User();
            $profilePic = $userModel->getProfilePic($_SESSION['user_id']);
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth');
            exit();
        }

        // Charger le modèle User
        require_once 'app/models/User.php';
        $userModel = new User();
        $info = $userModel->getUserById($_SESSION['user_id']);

        if ($info['role'] != 'admin') {
            header('Location: index.php?url=home');
        } 

        // Charger le modèle Ships
        require_once 'app/models/Ships.php';
        $shipsModel = new Ships();
        $Ships = $shipsModel->getAllWFVShips();
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
        require 'app/views/admin.php';
    }

    public function delete() {
        // Vérifier que la requête est en POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['id'])) {
                $shipId = intval($input['id']);

                // Charger le modèle Ships
                require_once 'app/models/Ships.php';
                $shipModel = new Ships();

                // Supprimer le vaisseau
                $shipModel->deleteWFVShip($shipId);

                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function accept() {
        // Vérifier que la requête est en POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['id'])) {
                $shipId = intval($input['id']);

                // Charger le modèle Ships
                require_once 'app/models/Ships.php';
                $shipModel = new Ships();
                
                //Tout récupérer du vaisseau
                $ship = $shipModel->getWFVShipById($shipId);

                //Ajouter le vaisseau dans la table ships
                $shipModel->createShip($ship['name'], $ship['description'], $ship['price'], $ship['image_path'], $ship['author_id'], $ship['category_id']);

                // Supprimer le vaisseau de la table ships_wfv
                $shipModel->deleteWFVShip($shipId);

                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false]);
        }
    }

}
