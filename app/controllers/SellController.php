<?php
class SellController {
    public function index() {
        session_start();

        $profilePic = null;
        if (isset($_SESSION['user_id'])) {
            // Charger la photo de profil uniquement
            require_once 'app/models/User.php';
            $userModel = new User();
            $profilePic = $userModel->getProfilePic($_SESSION['user_id']);
        }
        
        // Inclure la vue
        require 'app/views/sell.php';
    }

    public function sendShip() {
        session_start();

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=auth');
            exit();
        }

        // Charger le modèle Ship
        require_once 'app/models/Ships.php';
        $shipModel = new Ships();

        // Vérifier si le formulaire est soumis et si le fichier est valide
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
            // Récupérer les données du formulaire
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $price = floatval($_POST['price']);
            $category = intval($_POST['category']);
            $stock = intval($_POST['stock']);
            $image = $_FILES['profile_picture'];

            // Vérifier si le fichier a été correctement téléchargé
            if ($image['error'] === UPLOAD_ERR_OK) {
                // Créer un chemin unique pour le fichier
                $uploadDir = 'public/uploads/ships/';
                $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
                $fileName = $name . '-' . date('d_m_Y') . '.' . $extension;
                $filePath = $uploadDir . $fileName;

                // Créer le dossier si nécessaire
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Déplacer le fichier dans le dossier cible
                if (move_uploaded_file($image['tmp_name'], $filePath)) {
                    // Sauvegarder les données dans la base de données
                    $shipModel->addShip([
                        'name' => $name,
                        'description' => $description,
                        'price' => $price,
                        'category' => $category+1,
                        'stock' => $stock,
                        'image' => $filePath, // Enregistrer le chemin de l'image
                        'user_id' => $_SESSION['user_id'] // ID de l'utilisateur connecté
                    ]);

                    // Rediriger vers une page de confirmation ou de liste
                    header('Location: index.php?url=profile');
                    exit();
                } else {
                    echo "Erreur lors de l'enregistrement de l'image.";
                }
            } else {
                echo "Erreur lors du téléchargement de l'image.";
            }
        } else {
            echo "Formulaire invalide.";
        }
    }
}
