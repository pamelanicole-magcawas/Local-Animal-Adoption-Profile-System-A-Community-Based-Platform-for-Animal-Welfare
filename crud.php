<?php

class Animal {
    private $conn;
    private $tbl_name = "animaldata";

    public $id;
    public $name;
    public $age;
    public $sex;
    public $treatments;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query = "INSERT INTO " .$this->tbl_name . " (Name, Age, Sex, Treatments) VALUES (:name, :age, :sex, :treatments)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':sex', $this->sex);
        $stmt->bindParam(':treatments', $this->treatments);

        if($stmt->execute()){
            return true;
        }
        
        return false;
    }

    public function read(){
        $query = "SELECT * FROM " .$this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>