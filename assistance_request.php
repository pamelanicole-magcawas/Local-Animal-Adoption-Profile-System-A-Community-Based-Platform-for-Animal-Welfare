<?php

class AssistanceRequest
{
    private $conn;
    private $tbl_name = "emergency_requests";

    public $id;
    public $user_name;
    public $user_email;
    public $user_phone;
    public $emergency_message;

    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function createInquiry()
    {
        $query = "INSERT INTO " . $this->tbl_name . " (user_name, user_email, user_phone, emergency_message) 
                  VALUES (:user_name, :user_email, :user_phone, :emergency_message)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_name', $this->user_name);
        $stmt->bindParam(':user_email', $this->user_email);
        $stmt->bindParam(':user_phone', $this->user_phone);
        $stmt->bindParam(':emergency_message', $this->emergency_message);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function readInquiry()
    {
        $query = "SELECT * FROM " . $this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

?>
