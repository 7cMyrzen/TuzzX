<?php

require_once 'app/core/Database.php';

class Order {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function createorder($userId, $total, $addressId) {
        $stmt = $this->db->prepare('INSERT INTO orders (user_id, total_amount, billing_address_id, shipping_address_id) VALUES (?, ?, ?, ?)');
        $stmt->execute([$userId, $total, $addressId, $addressId]);
    }

    public function createOrderDetails($orderId, $shipId, $quantity, $price) {
        $stmt = $this->db->prepare('INSERT INTO order_details (order_id, ship_id, quantity, price) VALUES (?, ?, ?, ?)');
        $stmt->execute([$orderId, $shipId, $quantity, $price]);
    }

    public function getOrder($userId) {
        $stmt = $this->db->prepare('SELECT * FROM orders WHERE user_id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function get3LastOrder($userId) {
        $stmt = $this->db->prepare('SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC LIMIT 3');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getNumberOfOrder($userId) {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM orders WHERE user_id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    public  function deleteOrder($userId, $orderId) {
        $stmt = $this->db->prepare('DELETE FROM order WHERE user_id = ? AND id = ?');
        $stmt->execute([$userId, $orderId]);
    }

    public function getOrderDetails($userId) {
        $stmt = $this->db->prepare('SELECT * FROM order_details WHERE user_id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getAllInfoOfOrder($orderId) {
        $stmt = $this->db->prepare('SELECT * FROM orders WHERE id = ?');
        $stmt->execute([$orderId]);
        return $stmt->fetch();
    }

    public function getAllInfoOfOrderDetails($orderId) {
        $stmt = $this->db->prepare('SELECT * FROM order_details WHERE order_id = ?');
        $stmt->execute([$orderId]);
        return $stmt->fetch();
    }

    public function getShipId($orderId) {
        $stmt = $this->db->prepare('SELECT ship_id FROM order_details WHERE order_id = ?');
        $stmt->execute([$orderId]);
        return $stmt->fetch();
    }
}
