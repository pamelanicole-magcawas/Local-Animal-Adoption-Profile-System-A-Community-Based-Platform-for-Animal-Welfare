<?php

class Report {
    private $conn;
    private $table = "emergency_requests";

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getAllReports() {
        $query = "
            SELECT r.id, r.user_id, r.full_name, r.message, r.status, r.date, u.username AS user_name, u.email AS email
            FROM " . $this->table . " r
            JOIN users u ON r.user_id = u.id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Fetch reports by user ID
    public function getReportsByUserId($userId) {
        $query = "
            SELECT r.id, r.full_name, r.message, r.status, r.date, u.username AS user_name, u.email AS email
            FROM " . $this->table . " r
            JOIN users u ON r.user_id = u.id
            WHERE r.user_id = :user_id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    // Submit a new report
    public function submitReport($user_id, $full_name, $message) {
        $query = "INSERT INTO emergency_requests (user_id, full_name, message) 
                  VALUES (:user_id, :full_name, :message)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':message', $message);
        return $stmt->execute();
    }

    // Update the report status
    public function updateStatus($report_id, $status) {
        $query = "UPDATE " . $this->table . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $report_id);
        return $stmt->execute();
    }

    // Fetch user details by user ID
    public function getUserDetailsById($user_id) {
        $query = "SELECT username, email FROM users WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Process the form submission for reports
    public function processReportSubmission($user_id, $full_name, $message) {
        return $this->submitReport($user_id, $full_name, $message);
    }
}

?>
