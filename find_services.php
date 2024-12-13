<?php
require_once 'dbConnect.php';

class PetServices {
    private $db;
    private $table = 'services';

    public function __construct() {
        $this->db = (new Database())->getConnect();
    }

    public function getServices($filters = []) {
        $query = "SELECT * FROM $this->table WHERE 1=1"; 
        $params = [];

        if (!empty($filters['category'])) {
            $query .= " AND category LIKE :category";
            $params['category'] = "%" . $filters['category'] . "%";
        }

        if (!empty($filters['location'])) {
            $query .= " AND location LIKE :location";
            $params['location'] = "%" . $filters['location'] . "%";
        }

        try {
            $stmt = $this->db->prepare($query);

            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Database query failed: " . $e->getMessage());
            return false;  
        }
    }
}
?>
