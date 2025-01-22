<?php
class ProfileController {
    public function index() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth');
            exit();
        }

        // Charger le modèle User
        require_once 'app/models/User.php';
        $userModel = new User();
        $info = $userModel->getUserById($_SESSION['user_id']);
        
        // Vérification de la validité de $info avant d'accéder à ses indices
        if ($info === false) {
            die("Erreur : utilisateur non trouvé.");
        }

        if ($info['role'] == 'admin') {
            $info['role'] = 'Administrateur';
        } else {
            $info['role'] = 'Utilisateur';
        }

        // Récupérer l'adresse de l'utilisateur
        $userAddress = $userModel->getUserAddress($_SESSION['user_id']);
        
        // Vérifie si des adresses sont retournées
        if ($userAddress === false) {
            $userAddress = [];  // Si pas d'adresse, on initialise un tableau vide
        }

        // Charger la photo de profil, vérifier la validité de la donnée
        $profilePic = null;
        if (isset($_SESSION['user_id'])) {
            // Charger la photo de profil uniquement
            $profilePic = $userModel->getProfilePic($_SESSION['user_id']);
            if ($profilePic === false) {
                $profilePic = null;  // Si aucune photo, mettre la variable à null
            }
        }

        // Charger les informations de commande
        require_once 'app/models/Order.php';
        require_once 'app/models/Ships.php';
        $invoiceModel = new Order();
        $shipModel = new Ships();
        $Invoices = $invoiceModel->getOrder($_SESSION['user_id']);
        
        // Vérifier si des commandes sont présentes
        if ($Invoices === false) {
            $Invoices = [];  // Si aucune commande, on initialise un tableau vide
        } else {
            foreach ($Invoices as $key => $invoice) {
                $Invoices[$key]['order_date'] = date('d/m/Y', strtotime($invoice['order_date']));
            
                // Vérification si getShipId retourne false
                $ShipId = $invoiceModel->getShipId($invoice['id']);
                if ($ShipId !== false && isset($ShipId['ship_id'])) {
                    $shipName = $shipModel->getShipNamePrice($ShipId['ship_id']);
                    if ($shipName !== false && isset($shipName['name'])) {
                        $Invoices[$key]['name'] = $shipName['name'];
                    } else {
                        $Invoices[$key]['name'] = 'Nom du vaisseau non trouvé';
                    }
                } else {
                    $Invoices[$key]['name'] = 'Vaisseau non trouvé';
                }
            
                // Vérification si le montant total est valide
                if (isset($invoice['total_amount'])) {
                    $Invoices[$key]['total_amount'] = number_format($invoice['total_amount'], 2, ',', ' ');
                } else {
                    $Invoices[$key]['total_amount'] = 'Montant non disponible';
                }
            }
            
        }

        // Inclure la vue
        require 'app/views/profile.php';
    }

    public function addMoney() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth');
            exit();
        }

        // Récupérer le montant
        $money = $_POST['money'];
        $symbol = $_POST['symbol'];

        // Charger le modèle User
        require_once 'app/models/User.php';
        $userModel = new User();

        // Mettre à jour le solde
        $userModel->updateBalance($_SESSION['user_id'], $money, $symbol);

        // Rediriger vers la page de profil
        header('Location: index.php?url=profile');
    }

    public function changeInfo() {
        session_start();
        require_once 'app/models/User.php';
    
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth');
            exit();
        }
    
        // Récupérer l'ID de l'utilisateur
        $userId = $_SESSION['user_id'];
    
        // Création de l'objet User avec la connexion DB
        $userModel = new User();
    
        // Récupérer les informations du formulaire
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $newPassword = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;
        $oldPassword = $_POST['password2']; // Ancien mot de passe
    
        // Vérifier l'ancien mot de passe
        if (!$userModel->verifyOldPassword($userId, $oldPassword)) {
            die("L'ancien mot de passe est incorrect.");
        }
    
        // Gérer l'upload de la photo de profil
        $profilePicture = null;
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $profilePicture = $userModel->uploadProfilePicture($_FILES['profile_picture'], $name);
        }
    
        // Mettre à jour les informations de l'utilisateur
        $updateResult = $userModel->updateUserInfo($userId, $name, $email, $newPassword, $profilePicture);
    
        if ($updateResult) {
            header('Location: index.php?url=profile');
        } else {
            echo "Erreur lors de la mise à jour des informations.";
        }
    }

    public function addAddress() {
        session_start();
        require_once 'app/models/User.php';

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth');
            exit();
        }

        // Récupérer les informations du formulaire
        $address = htmlspecialchars($_POST['address']);
        $city = htmlspecialchars($_POST['city']);
        $zip = htmlspecialchars($_POST['zip']);
        $country = htmlspecialchars($_POST['country']);

        // Création de l'objet User avec la connexion DB
        $userModel = new User();

        // Ajouter l'adresse
        $userModel->addAddress($_SESSION['user_id'], $address, $city, $zip, $country);

        // Rediriger vers la page de profil
        header('Location: index.php?url=cart');
    }
}
