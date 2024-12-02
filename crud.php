<?php

class Animal
{
    private $conn;
    private $tbl_name = "animaldata";

    public $id;
    public $name;
    public $age;
    public $sex;
    public $treatments;
    public $animal_type;
    public $size;
    public $energy_level;
    public $personality;
    public $rescue_date;
    public $status;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->tbl_name . " (name, age, sex, treatments, animal_type, size, energy_level, personality, rescue_date, status) VALUES (:name, :age, :sex, :treatments, :animal_type, :size, :energy_level, :personality, :rescue_date, :status)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':sex', $this->sex);
        $stmt->bindParam(':treatments', $this->treatments);
        $stmt->bindParam(':animal_type', $this->animal_type);
        $stmt->bindParam(':size', $this->size);
        $stmt->bindParam(':energy_level', $this->energy_level);
        $stmt->bindParam(':personality', $this->personality);
        $stmt->bindParam(':rescue_date', $this->rescue_date);
        $stmt->bindParam(':status', $this->status);

        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function update()
    {
        $query = "UPDATE " . $this->tbl_name . " SET name = :name, age = :age, sex = :sex, treatments = :treatments, animal_type = :animal_type, size = :size, energy_level = :energy_level, personality = :personality, rescue_date = :rescue_date, status = :status WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->age = htmlspecialchars(strip_tags($this->age));
        $this->sex = htmlspecialchars(strip_tags($this->sex));
        $this->treatments = htmlspecialchars(strip_tags($this->treatments));
        $this->animal_type = htmlspecialchars(strip_tags($this->animal_type));
        $this->size = htmlspecialchars(strip_tags($this->size));
        $this->energy_level = htmlspecialchars(strip_tags($this->energy_level));
        $this->personality = htmlspecialchars(strip_tags($this->personality));
        $this->rescue_date = htmlspecialchars(strip_tags($this->rescue_date));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":sex", $this->sex);
        $stmt->bindParam(":treatments", $this->treatments);
        $stmt->bindParam(":animal_type", $this->animal_type);
        $stmt->bindParam(":size", $this->size);
        $stmt->bindParam(":energy_level", $this->energy_level);
        $stmt->bindParam(":personality", $this->personality);
        $stmt->bindParam(":rescue_date", $this->rescue_date);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->tbl_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
}

?>
