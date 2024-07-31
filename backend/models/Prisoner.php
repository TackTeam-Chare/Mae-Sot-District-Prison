<?php
require_once './config/database.php';

class Prisoner {
    private $conn;
    private $table_name = "prisoners";

    public $id;
    public $name;
    public $image;
    public $create_at;
    public $gender;
    
    public $type;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT *  FROM ".$this->table_name." ORDER BY create_at ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_id(){
        $query = "SELECT * FROM " . $this->table_name.' where id=:id';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id',$this->id);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, image=:image,gender=:gender , type=:type";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->type = htmlspecialchars(strip_tags($this->type));
        
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":type", $this->type);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name=:name, image=:image , gender=:gender,type=:type WHERE id=:id;";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->nationality = htmlspecialchars(strip_tags($this->nationality)); // Sanitize nationality
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->type = htmlspecialchars(strip_tags($this->type));

        

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":type", $this->type);
        
        
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function count_prisoners()
    {
        $query = "select count(*) as countPris,gender from prisoners where type=0 GROUP BY gender";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function count_prisoners_other()
    {
        $query = "select count(*) as countPris,gender from prisoners where type=1 GROUP BY gender";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}
?>
