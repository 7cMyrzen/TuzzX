<?php

require_once 'app/core/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function createUser($username, $email, $password, $profilePic) {
        $stmt = $this->db->prepare('INSERT INTO users (username, email, password, profile_pic) VALUES (?, ?, ?, ?)');
        $stmt->execute([$username, $email, $password, $profilePic]);
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getProfilePic($id) {
        $stmt = $this->db->prepare('SELECT profile_pic FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function deleteUser($id) {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function updateUser($id, $username, $email, $password, $profilePic) {
        $stmt = $this->db->prepare('UPDATE users SET username = ?, email = ?, password = ?, profile_pic = ? WHERE id = ?');
        $stmt->execute([$username, $email, $password, $profilePic, $id]);
    }

    public function getUserAddress($id) {
        $stmt = $this->db->prepare('SELECT * FROM user_addresses WHERE user_id = ?');
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }   

    public function getUsername($id) {
        $stmt = $this->db->prepare('SELECT username FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateBalance($id, $money, $symbol) {
        switch ($symbol) {
            case '+':
                $stmt = $this->db->prepare('UPDATE users SET balance = balance + ? WHERE id = ?');
                $stmt->execute([$money, $id]);
                break;
            case '-':
                $stmt = $this->db->prepare('UPDATE users SET balance = balance - ? WHERE id = ?');
                $stmt->execute([$money, $id]);
                break;
        }
    }

    public function verifyOldPassword($id, $password) {
        $stmt = $this->db->prepare('SELECT password FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $old = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($old && password_verify($password, $old['password'])) {
            return true;
        } else {
            return false;
        }
    }

    
    public function updateUserInfo($userId, $name, $email, $newPassword, $profilePicture) {

        // Requête SQL pour mettre à jour les informations de l'utilisateur
        $query = "UPDATE users SET username = :username, email = :email, password = :password, profile_pic = :profile_pic WHERE id = :user_id";
        $stmt = $this->db->prepare($query);
    
        // Paramétrage des valeurs à insérer dans la requête
        $stmt->bindParam(':username', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $newPassword);
        $stmt->bindParam(':profile_pic', $profilePicture);
        $stmt->bindParam(':user_id', $userId);
    
        // Exécution de la requête
        return $stmt->execute();
    }
    

    public function uploadProfilePicture($file, $name) {
        // Vérifier si un fichier a été téléchargé
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Récupérer le chemin temporaire du fichier et son nom
            $tmpName = $file['tmp_name'];
            $fileName = basename($file['name']);

            // Spécifier le répertoire de destination
            $uploadsDir = 'public/uploads/';
            $destinationPath = $uploadsDir . $fileName;

            // Déplacer le fichier vers le répertoire 'uploads/'
            if (move_uploaded_file($tmpName, $destinationPath)) {
                // Retourner le chemin relatif à stocker dans la base de données
                return 'uploads/' . $fileName;
            } else {
                // Gestion des erreurs de téléchargement
                die("Échec du téléchargement de l'image.");
            }
        }
        return null;  // Retourner null si aucun fichier n'est téléchargé
    }
    
    public function addAddress($userId, $address, $city, $zipCode, $country) {
        $stmt = $this->db->prepare('INSERT INTO user_addresses (user_id, address, city, zip, country) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$userId, $address, $city, $zipCode, $country]);
    }

    public function getAddressInfo($addressId) {
        $stmt = $this->db->prepare('SELECT * FROM user_addresses WHERE id = ?');
        $stmt->execute([$addressId]);
        return $stmt->fetch();
    }

    public function getUserBalance($userId) {
        $stmt = $this->db->prepare('SELECT balance FROM users WHERE id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    public function getLastOrderId($userId) {
        $stmt = $this->db->prepare('SELECT id FROM orders WHERE user_id = ? ORDER BY order_date DESC LIMIT 1');
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }
}