<?php
class AuthController {
    public function index() {
        session_start();

    // Enregistrer l'URL précédente si elle n'est pas déjà enregistrée
    if (!isset($_SESSION['previous_url']) && isset($_SERVER['HTTP_REFERER'])) {
        $_SESSION['previous_url'] = $_SERVER['HTTP_REFERER'];
    }

    // Rediriger si l'utilisateur est déjà connecté
    if (isset($_SESSION['user_id'])) {
        $redirectUrl = $_SESSION['previous_url'] ?? 'index.php?url=shop';
        unset($_SESSION['previous_url']); // Nettoyer après redirection
        header('Location: ' . $redirectUrl);
        exit();
    }

        // Afficher la vue de connexion
        $error = $_GET['error'] ?? '';
        require 'app/views/connect.php';
    }

    public function login() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['form_type'] === 'login') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Charger le modèle User
            require_once 'app/models/User.php';
            $userModel = new User();

            $user = $userModel->getUserByUsername($username);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                
                // Redirection vers l'URL précédente ou vers "shop" par défaut
                $redirectUrl = $_SESSION['previous_url'] ?? 'index.php?url=shop';
                unset($_SESSION['previous_url']); // Nettoyer après redirection
                header('Location: ' . $redirectUrl);
                exit();
            } else {
                header('Location: index.php?url=auth&error=Nom d\'utilisateur ou mot de passe incorrect.');
                exit();
            }
        }
    }

    public function register() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['form_type'] === 'register') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $profilePicPath = 'images/profile_pic/defaultUserPicture.jpeg';

            if ($password !== $password2) {
                header('Location: index.php?url=auth&error=Les mots de passe ne correspondent pas.');
                exit();
            }

            // Charger le modèle User
            require_once 'app/models/User.php';
            $userModel = new User();

            if ($userModel->getUserByUsername($username)) {
                header('Location: index.php?url=auth&error=Nom d\'utilisateur déjà pris.');
                exit();
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $userModel->createUser($username, $email, $hashedPassword, profilePic: $profilePicPath);

            $user = $userModel->getUserByUsername($username);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                
                // Redirection vers l'URL précédente ou vers "shop" par défaut
                $redirectUrl = $_SESSION['previous_url'] ?? 'index.php?url=shop';
                unset($_SESSION['previous_url']); // Nettoyer après redirection
                header('Location: ' . $redirectUrl);
                exit();
            } else {
                header('Location: index.php?url=auth&error=Erreur lors de l\'inscription.');
                exit();
            }
        }
    }

    public function logout() {
        session_start();
    
        // Supprimer toutes les données de session
        $_SESSION = [];
        session_destroy();
    
        // Supprimer le cookie de session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    
        // Récupérer la page précédente (URL de la page d'où l'utilisateur vient)
        $previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php?url=home';
    
        // Vérifier si l'utilisateur est déjà sur la page 'shop'
        if (strpos($previousPage, 'shop') !== false) {
            // Si l'utilisateur était sur la page 'shop', rediriger vers shop
            header('Location: index.php?url=shop');
        } else {
            // Sinon, rediriger vers home
            header('Location: index.php?url=home');
        }
    
        exit();
    }
    
    public function delete() {
        session_start();
    
        // Charger le modèle User
        require_once 'app/models/User.php';
        $userModel = new User();
    
        // Supprimer l'utilisateur
        $userModel->deleteUser($_SESSION['user_id']);
    
        // Supprimer toutes les données de session
        $_SESSION = [];
        session_destroy();
    
        // Supprimer le cookie de session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    
        // Rediriger vers la page d'accueil
        header('Location: index.php?url=home');
        exit();
    }

}
