<?php

require_once 'app/core/Database.php';

class Reviews {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getReviews($id) {
        $stmt = $this->db->prepare('SELECT * FROM reviews WHERE ship_id = ?');
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    public function createReview($userId, $shipId, $rating, $comment) {
        $stmt = $this->db->prepare('INSERT INTO reviews (user_id, ship_id, rating, comment) VALUES (?, ?, ?, ?)');
        $stmt->execute([$userId, $shipId, $rating, $comment]);
    }

    public function deleteReview($userId, $reviewId) {
        $stmt = $this->db->prepare('DELETE FROM reviews WHERE user_id = ? AND id = ?');
        $stmt->execute([$userId, $reviewId]);
    }

}
