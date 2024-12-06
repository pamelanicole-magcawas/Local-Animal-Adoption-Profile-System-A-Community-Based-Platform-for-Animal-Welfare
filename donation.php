<?php

class Donation {
    private $conn;
    private $table = "donations";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Retrieve donations by user ID
    public function getDonationsByUserId($userId) {
        $query = "
            SELECT d.id, d.amount, d.message, d.status, d.date, u.full_name, u.username
            FROM donations d
            JOIN users u ON d.user_id = u.id
            WHERE d.user_id = :user_id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    // Retrieve all donations
    public function getAllDonations() {
        $query = "
            SELECT d.id, d.amount, d.message, d.status, d.date, u.username 
            FROM donations d
            JOIN users u ON d.user_id = u.id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Add a donation
    public function addDonation($user_id, $amount, $message) {
        $query = "INSERT INTO " . $this->table . " (user_id, amount, message, status) 
                  VALUES (:user_id, :amount, :message, 'Pending')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':message', $message);
        
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error: " . implode(" - ", $stmt->errorInfo());
            return false;
        }
    }

    // Accept a donation
    public function acceptDonation($id) {
        $query = "UPDATE " . $this->table . " SET status = 'Accepted' WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Reject a donation
    public function rejectDonation($id) {
        $query = "UPDATE " . $this->table . " SET status = 'Not Accepted' WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Calculate total approved donations
    public function getTotalApprovedDonations() {
        $query = "
            SELECT SUM(amount) AS total
            FROM " . $this->table . "
            WHERE status = 'Accepted'
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0; 
    }
}
