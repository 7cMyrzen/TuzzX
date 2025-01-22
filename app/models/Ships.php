<?php

require_once 'app/core/Database.php';

class Ships {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getBasicShips() {
        $stmt = $this->db->prepare('SELECT id, name, description, price, image_path FROM ships');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getWFVBasicShips() {
        $stmt = $this->db->prepare('SELECT id, name, description, price, image_path FROM ships_wfv');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllShips() {
        $stmt = $this->db->prepare('SELECT * FROM ships');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllWFVShips() {
        $stmt = $this->db->prepare('SELECT * FROM ships_wfv');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createShip($name, $description, $price, $image_path, $author_id, $category_id) {
        $query = "INSERT INTO ships (name, description, price, image_path, author_id, category_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$name, $description, $price, $image_path, $author_id, $category_id]);
    }

    public function getShipById($id) {
        $stmt = $this->db->prepare('SELECT * FROM ships WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getWFVShipById($id) {
        $stmt = $this->db->prepare('SELECT * FROM ships_wfv WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getShipNamePrice($id) {
        $stmt = $this->db->prepare('SELECT name, price FROM ships WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function get3ShipsFromCategory($category, $id) {
        $stmt = $this->db->prepare('SELECT * FROM ships WHERE category_id = ? AND id != ? LIMIT 3');
        $stmt->execute([$category, $id]);
        return $stmt->fetchAll();
    }
    
    public function deleteShip($id) {
        $stmt = $this->db->prepare('DELETE FROM ships WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function deleteWFVShip($id) {
        $stmt = $this->db->prepare('DELETE FROM ships_wfv WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function getCategoryName($id) {
        $stmt = $this->db->prepare('SELECT categories.name FROM categories JOIN ships ON categories.id = ships.category_id WHERE ships.id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getShipName($id) {
        $stmt = $this->db->prepare('SELECT name FROM ships WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getStock($id) {
        $stmt = $this->db->prepare('SELECT stock.quantity FROM stock JOIN ships ON stock.ship_id = ships.id WHERE ships.id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateStockab($id) {
        $stmt = $this->db->prepare('UPDATE stock SET quantity = quantity - 1 WHERE ship_id = ?');
        $stmt->execute([$id]);
    }

    public function getSellerId($itemId) {
        $stmt = $this->db->prepare('SELECT author_id FROM ships WHERE id = ?');
        $stmt->execute([$itemId]);
        return $stmt->fetch();
    }

    public function addShip($data) {
        $query = "INSERT INTO ships_wfv (name, description, price, image_path, author_id, category_id, stock) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $data['name'],
            $data['description'],
            $data['price'],
            $data['image'],
            $data['user_id'],
            $data['category'],
            $data['stock']
        ]);
    }
}
