<?php

class AdoptionRequest {
    private $conn;
    private $table = 'adoption_requests';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createAdoptionRequest($animalId, $userId, $userContact, $email, $vetName, $exercisePlan, $emergencyCare) {
        $query = "INSERT INTO " . $this->table . " (animal_id, user_id, user_contact, email, vet_name, exercise_plan, emergency_care, date, status) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Reserved')";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute([$animalId, $userId, $userContact, $email, $vetName, $exercisePlan, $emergencyCare, date("Y-m-d H:i:s")]);

        // Update the animal status to 'Reserved'
        $updateAnimalQuery = "UPDATE animals SET status = 'Reserved' WHERE id = ?";
        $updateStmt = $this->conn->prepare($updateAnimalQuery);
        $updateStmt->execute([$animalId]);

        return $stmt;
    }

    public function getAdoptionRequestsByUserId($userId) {
        $query = "SELECT ar.request_id, ar.user_contact, ar.email, ar.vet_name, ar.exercise_plan, ar.emergency_care, ar.date, ar.status, a.name AS animal_name, u.username AS user_name
                  FROM adoption_requests ar
                  JOIN animals a ON ar.animal_id = a.id
                  JOIN users u ON u.id = ar.user_id
                  WHERE ar.user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function getAllRequests() {
        $query = "SELECT ar.request_id, ar.user_contact, ar.email, ar.vet_name, ar.exercise_plan, ar.emergency_care, ar.date, ar.status, a.name AS animal_name, u.username AS user_name
                  FROM " . $this->table . " ar
                  JOIN animals a ON ar.animal_id = a.id
                  JOIN users u ON u.id = ar.user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function updateRequestStatus($requestId, $status) {
        $query = "UPDATE " . $this->table . " SET status = :status WHERE request_id = :request_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':request_id', $requestId);
        return $stmt->execute();
    }
}

?>
