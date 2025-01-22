<?php
class HomeController {
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
        require 'app/views/home.php';
    }
}
