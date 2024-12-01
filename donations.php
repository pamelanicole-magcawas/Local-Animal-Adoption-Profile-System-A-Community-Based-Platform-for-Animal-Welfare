<?php

require_once 'db_donation.php';

class Donations {
    private $conn;
    private $tbl_name = "donationtable";

    public $donation_id;
    public $name;
    public $email;
    public $donation_amount;
    public $payment_method; 

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function processDonation()
    {

        $query = "INSERT INTO " . $this->tbl_name . " (name, email, donation_amount, payment_method) 
              VALUES (:name, :email, :donation_amount, :payment_method)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':donation_amount', $this->donation_amount);
        $stmt->bindParam(':payment_method', $this->payment_method);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function displayDonation()
    {
        $query = "SELECT * FROM " . $this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
