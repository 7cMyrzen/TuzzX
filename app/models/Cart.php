<?php

require_once 'app/core/Database.php';

class Cart {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function addToCart($userId, $shipId, $quantity) {
        $stmt = $this->db->prepare('INSERT INTO cart (user_id, ship_id, quantity) VALUES (?, ?, ?)');
        $stmt->execute([$userId, $shipId, $quantity]);
    }

    public function getCartItems($userId) {
        $stmt = $this->db->prepare('SELECT ships.id, ships.name, ships.price, ships.image_path, cart.quantity FROM cart INNER JOIN ships ON cart.ship_id = ships.id WHERE cart.user_id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getCartItem ($userId, $shipId) {
        $stmt = $this->db->prepare('SELECT ships.id, ships.name, ships.price, ships.image_path, cart.quantity FROM cart INNER JOIN ships ON cart.ship_id = ships.id WHERE cart.user_id = ? AND cart.ship_id = ?');
        $stmt->execute([$userId, $shipId]);
        return $stmt->fetch();
    }
    public function removeFromCart($userId, $cartId) {
        $stmt = $this->db->prepare('DELETE FROM cart WHERE user_id = ? AND ship_id = ?');
        $stmt->execute([$userId, $cartId]);
    }

    public function updateQuantity($userId, $shipId, $quantity) {
        $stmt = $this->db->prepare('UPDATE cart SET quantity = ? WHERE user_id = ? AND ship_id = ?');
        $stmt->execute([$quantity, $userId, $shipId]);
    }

    public function emptyCart($userId) {
        $stmt = $this->db->prepare('DELETE FROM cart WHERE user_id = ?');
        $stmt->execute([$userId]);
    }
}
